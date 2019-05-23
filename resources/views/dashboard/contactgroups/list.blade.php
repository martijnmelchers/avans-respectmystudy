@extends('layouts/dashboard')

@section("title", "Contactgroepen")

@section('content')
    <div class="col-12 box mb-2">
        <h1>Contactgroepen</h1>
    </div>

    {{--<article>--}}
        {{--<h3>Filter contactgroepen</h3>--}}
        {{--<form method="get" style="margin: 15px auto 0 auto;">--}}
            {{--<div class="formline">--}}
                {{--<label for="name">Naam</label>--}}
                {{--<input type="text" name="name" value="{{$search['name']}}" id="name" placeholder="Naam">--}}
            {{--</div>--}}

            {{--<input type="submit" class="button blue">--}}
        {{--</form>--}}
    {{--</article>--}}

    <div class="blocks mb-2">
        @foreach ($contactgroups as $contactgroup)
            <a class="item" href="{{route('dashboard-contactgroup', $contactgroup->id)}}">
                <h6>{{$contactgroup->name}}</h6>
                <ul>
                    <li>{{$contactgroup->minors->count()}} minoren</li>
                </ul>
            </a>
        @endforeach
    </div>

    <div class="row">
        <a class="button red col" href="{{route('dashboard')}}">Dashboard home</a>
        <a class="button red col" href="{{route('import')}}">Contactgroepen importeren</a>
    </div>
@endsection