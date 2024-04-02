<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SessionsRequest;
use App\Models\Session;
use App\Models\Hall;
use App\Models\Film;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SessionController extends Controller
{
    public function index($id) 
    {
        return view ('hall', ['sessions'=>Session::find($id)]); 
    }

    public function addSession(SessionsRequest $request) 
    {
        $session = new Session();
        $session->date = $request->input('date');
        $session->session_start = $request->input('time');
        $session->hall_id = $request->input('id');
        $session->name_film = $request->input('film');
        $hall_name = Hall::where('id', $request->id)->first()->name;
        $hall_config = Hall::where('id', $request->id)->first()->config;
        $active_hall = Hall::where('id', $request->id)->first()->active_hall;
        $session->name_hall = $hall_name;
        $session->config_hall = $hall_config;
        $session->active_hall = $active_hall;
        $id_film = Film::where('title', $request->film)->first()->id;
        $session->film_id = $id_film;
        $time = $request->input('time');
        $stime = explode(':', $time);
        $minute_start = round((($stime[0] * 60) + $stime[1]) / 2);
        $session->minute_start = $minute_start;
        $duration_film = Film::where('title', $request->film)->first()->duration;
        $session->duration = round($duration_film / 2);
        $minute_finish = round($minute_start + ($duration_film / 2));
        $session->minute_finish = $minute_finish;

        if (!Session::where('hall_id', $request->id)
            ->where('date', $request->date)
            ->where('minute_start', '<=', $minute_start)
            ->where('minute_finish', '>=', $minute_start)->first()) {
                $session->save();
                return redirect()->route('admin')->with('success', 'Сессия успешно добавлена');
            } else {
                return redirect()->route('admin')->with('alert-danger', 'Время сеансов совпадает');
            } 
    }

    public function deleteSession($id) 
    {
        Session::find($id)->delete();
        return redirect()->route('admin')->with('success', 'Фильм успешно удалён из сетки сеансов');
    }

    public function updateSession(Request $request) 
    {
        $session = Session::where('id', $request->id)->first();
        $session->config_hall = $request->input('config');
        $session->save();
        $film_name = Session::where('id', $request->id)->first()->name_film;
        $hall_name = Session::where('id', $request->id)->first()->name_hall;
        $session_start = Session::where('id', $request->id)->first()->session_start;
        $session_date = Session::where('id', $request->id)->first()->date;
        $placeArr = [];
        $priceSum = 0;
        for ($i = 0; $i < count($request->orders); $i++) {
            $row = (string)$request->orders[$i]['row'];
            $place = (string)$request->orders[$i]['seat'];
            $price = (int)$request->orders[$i]['price'];
            $string = $row . ' ряд / ' . $place . ' место';
            $placeArr[] = $string;
            $priceSum += $price;
        }
        $places = implode(', ', $placeArr);
        return route('payment', [
            'film_name' => $film_name, 
            'hall_name' => $hall_name, 
            'session_start' => $session_start,
            'session_date' => $session_date,
            'places' => $places,
            'priceSum' => $priceSum
        ]);
    }

    public function payment(Request $request) 
    {
        return view ('payment', [ 
            'film_name' => $request->input('film_name'), 
            'hall_name' => $request->input('hall_name'), 
            'session_start' => $request->input('session_start'), 
            'session_date' => $request->input('session_date'), 
            'places' => $request->input('places'), 
            'priceSum' => $request->input('priceSum') 
        ]); 
    }

    public function ticket(Request $request) 
    {
        $QRvalue = 'На фильм: ' . $request->input('film_name') . PHP_EOL . 'Места: ' . $request->input('places') . PHP_EOL . 'В зале: ' . $request->input('hall_name') . PHP_EOL . 'Начало сеанса: ' . $request->input('session_start') . ' ' . date('d.m.Y', strtotime($request->input('session_date'))) . PHP_EOL . 'Стоимость: ' . $request->input('priceSum');
        $QR = QrCode::encoding('UTF-8')->size(200)->generate($QRvalue);
        return view ('ticket', [ 
            'film_name' => $request->input('film_name'), 
            'hall_name' => $request->input('hall_name'), 
            'session_start' => $request->input('session_start'),  
            'session_date' => $request->input('session_date'),
            'places' => $request->input('places'), 
            'priceSum' => $request->input('priceSum'),
            'QR' => $QR
        ]); 
    }
}
