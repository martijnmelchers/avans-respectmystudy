@extends('layouts/dashboard')
@section('content')
    <div class="row">
        <div class="buttons mb-2">
            <a href="{{route('assessable')}}" class="button blue"><i></i>Assessbare minoren</a>
            <a href="{{route('assessed')}}" class="button blue"><i></i>Assessed minoren</a>
        </div>
        @if (sizeof($assessed_minors) > 0)
            <div class="blocks">
                @foreach ($assessed_minors as $minor)
                    <a href="{{route('dashboard-minor-reviews', $minor->id)}}" class="item">
                        <h4>{{$minor->name}}</h4>
                        <div class="description">
                            <p>Versie {{$minor->version}}</p>
                            <p>Gepubliceerd {{$minor->is_published ? "Ja" : "Nee"}}</p>
                            <p>{{$minor->contactGroup ? $minor->contactGroup->name : "Geen contactpersoon"}}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            {{--<div class="pagenav col-12">--}}
            {{--<div class="text">Pagina</div>--}}
            {{--<div class="pages">--}}
            {{--@if ($page > 0)--}}
            {{--<a href="{{$request->fullUrlWithQuery(["page"=>$page - 1])}}"--}}
            {{--class="previous block"><i class="fas fa-arrow-left"></i> {{$page}}</a>--}}
            {{--@endif--}}

            {{--<div class="current block">{{$page + 1}}</div>--}}

            {{--@if ($page + 1 < $pages)--}}
            {{--<a href="{{$request->fullUrlWithQuery(["page"=>$page + 1])}}"--}}
            {{--class="next block">{{$page+2}} <i class="fas fa-arrow-right"></i></a>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}
        @else
            <div class="col-12 mb-2 mt-2 box">
                <p>Geen minoren gevonden.</p>
            </div>
        @endif
    </div>
@endsection