<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <div class="block_login"> <a href="{{ route('admin') }}" class="link_login font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a></div>
  </header>
 
  
  <nav class="page-nav">
  @foreach($sessions->groupby('date') as $date => $date_value)
        <a class="page-nav__day" href="#">
          <span class="page-nav__day-week">{{ strftime("%a", strtotime($date)) }}</span><span class="page-nav__day-number">{{ date('d.m', strtotime($date)) }}</span>
        </a>
    @endforeach
    <!-- <a class="page-nav__day page-nav__day_today" href="#">
      <span class="page-nav__day-week">Вт</span><span class="page-nav__day-number">1</span>
    </a>
    <a class="page-nav__day page-nav__day_chosen" href="#">
      <span class="page-nav__day-week">Ср</span><span class="page-nav__day-number">2</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Чт</span><span class="page-nav__day-number">3</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Пт</span><span class="page-nav__day-number">4</span>
    </a>
    <a class="page-nav__day page-nav__day_weekend" href="#">
      <span class="page-nav__day-week">Сб</span><span class="page-nav__day-number">5</span>
    </a>
    <a class="page-nav__day page-nav__day_next" href="#">
    </a> -->
  </nav>
  
  @foreach($sessions->groupby('date') as $date => $date_value)
    <main class="hidden" style="display:none">
      @foreach($date_value->groupby('name_film') as $movie => $movies)
      <section class="movie">
        <div class="movie__info">
          <div class="movie__poster">
            <img class="movie__poster-image" alt="poster" src="{{ asset('/storage/' . $movies[0]->film->image) }}">
          </div>
          <div class="movie__description">
            <h2 class="movie__title">{{ $movie }}</h2>
            <p class="movie__synopsis">{{ $movies[0]->film->description }}</p>
            <p class="movie__data">
              <span class="movie__data-duration">{{ $movies[0]->film->duration }} минут</span>
              <span class="movie__data-origin">{{ $movies[0]->film->country }}</span>
            </p>
          </div>
        </div>  
        
        @foreach($movies->groupby('name_hall') as $hall => $hall_value)
        <div class="movie-seances__hall">
          <h3 class="movie-seances__hall-title">{{ $hall }}</h3>
          <ul class="movie-seances__list">
            @foreach($hall_value->sortby('session_start') as $val)
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="{{ route('bookingHall', $val->id) }}">{{ $val->session_start }}</a></li>
            @endforeach
          </ul>
        </div>
        @endforeach
      </section>  
      @endforeach
    </main>
  @endforeach


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/client.js"></script>
</body>
</html>