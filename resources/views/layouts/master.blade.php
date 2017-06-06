<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{URL::to('css/styles.css')}}">
</head>
<body>
  <section>
    <aside class="left">
      @foreach($groups as $group)
        <h1>GRUPA {{$group->id}}</h1>

        @foreach($group->subgroups() as $subgroup)
          <h2>{{$subgroup->name}}</h2>
          <ul class="submenu">
          @foreach($subgroup->postcodes as $psc)
            <li><a href="{{URL::to('details/'.$psc->id)}}">{{$psc->postcode}}</a></li>
          @endforeach
          </ul>
        @endforeach

      @endforeach
    </aside>

    <main class="right">
      @yield('main')
    </main>
  </section>
</body>
</html>