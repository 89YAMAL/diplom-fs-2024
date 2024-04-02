<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\Film;
use App\Models\Session;
use App\Http\Requests\HallRequest;
use App\Http\Requests\HallPriceRequest;
use App\Http\Requests\HallConfigRequest;

class HallsController extends Controller
{
    public function index() 
    {
        return view ('admin', [
        'halls'=>Hall::all(), 
        'films'=>Film::all(), 
        'sessions'=>Session::all()
        ]); 
    }

    public function indexClient() 
    {
        return view ('index', [
        'halls'=>Hall::all(), 
        'films'=>Film::all(), 
        'sessions'=>Session::where('active_hall', 'on')->get()
        ]); 
    }

    public function addHall(HallRequest $request) 
    {
       $hall = new Hall();
       $hall->name = $request->input('name');
       $hall->save();
       return redirect()->route('admin')->with('success', 'Зал успешно добавлен');
    }

    public function deleteHall($id) 
    {
        Hall::find($id)->delete();
        return redirect()->route('admin')->with('success', 'Зал успешно удалён');
    }

    public function price(Request $request) 
    {
        $data = Hall::where('id', $request->id)->get();
        return $data;
    }

    public function updatePrice(HallPriceRequest $request) 
    {
        $hall = Hall::where('id', $request->id)->first();
        $hall->standart_price = $request->input('standart_price');
        $hall->vip_price = $request->input('vip_price');
        $hall->save();
    }

    public function updateConfig(HallConfigRequest $request) 
    {
        if(Session::where('hall_id', $request->id)->exists()) {
            return response()->json(['code'=>200,'success' => 'Конфигурация зала не обновлена, так как в зале назначены сеансы']);
        }
        $hall = Hall::where('id', $request->id)->first();
        $hall->rows = $request->input('rows');
        $hall->seats = $request->input('seats');
        $hall->config = $request->input('config');
        $hall->save();
        return response()->json(['code'=>400,'success' => 'Конфигурация зала успешно обновлена']);
    }

    public function startSale(Request $request) 
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            $hall = Hall::findOrFail($key);
            $hall->active_hall = $value;
            $hall->save();
            $sessions = Session::where('hall_id', $key)->get();
            foreach ($sessions as $session) {
                $session->active_hall = $value;
                $session->save();
            }
        };
        return redirect()->route('admin')->with('success', 'Продажи открыты');
    }
}
