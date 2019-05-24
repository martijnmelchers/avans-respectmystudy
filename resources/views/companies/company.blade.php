@extends('layouts/default')

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <article>
                <h1>{{$c->company_name}}</h1>
            </article>

            <div class="buttons">
                <a href="/" class="button">Home</a>
                <a href="{{route('companies')}}" class="button">Alle minors</a>
            </div>

            <article>
                <h3>Doelen</h3>
                <p>{{$c->company_description}}</p>
            </article>

            <article>
                <h3>Requirements</h3>
                <p>{{$c->extra_information}}</p>
            </article>
        </div>
    </div>
@endsection