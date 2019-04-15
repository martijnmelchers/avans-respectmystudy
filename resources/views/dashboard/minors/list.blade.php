@extends('layouts/dashboard')

@section("title", "Dashboard")

@section('content')
<article>
    <h1>Minors</h1>
</article>

<div class="buttons">
    <a href="{{route('import')}}" class="">Importeren</a>
</div>
@endsection