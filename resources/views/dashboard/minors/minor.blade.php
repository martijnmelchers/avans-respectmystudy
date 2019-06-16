@extends('layouts/dashboard')

@section("title", "Minor " . $minor->name)

@section('content')
    <div class="row">
        @if (!isset($published_version))
            <a href="{{route('dashboard-minor-edit', ["id"=>$minor->id, "v"=>$minor->version])}}" class="alert red">
                Deze minor heeft nog geen gepubliceerde versies. Klik hier om de laatste versie te bewerken en te
                publiceren.
            </a>
        @elseif ($minor->version != $published_version->version)
            <a href="{{route('dashboard-minor', ["id"=>$minor->id, "v"=>$published_version->version])}}"
               class="alert red">
                Dit is niet de gepubliceerde versie van deze minor Klik hier om de versie te bekijken die sitegebruikers
                zien.
            </a>
        @elseif ($versions->count() > 1 && $minor->version == $published_version->version)
            <a href="{{route('dashboard-minor-versions', $minor->id)}}" class="alert">
                Je kijkt nu naar de gepubliceerde versie van deze minor. Klik hier om voor een overzicht van alle
                minoren.
            </a>
        @endif

        <div class="col-12 box margin">
            <h1>{{$minor->name}}</h1>
            <ul>
                <li>Versie: {{$minor->version}}</li>
                <li>Contacturen: {{$minor->contact_hours}}</li>
                <li>Educatietype: {{$minor->education_type}}</li>
                <li>Taal: {{$minor->language}}</li>
                <li>Gepubliceerd: {{$minor->is_published ? "ja" : "nee"}}</li>
                <li>Inschrijfbaar: {{$minor->is_enrollable ? "ja" : "nee"}}</li>
                {{--<li>{{$minor->reviews->count()}} reviews</li>--}}
                <li>{{$minor->versions()->count()}} versies</li>
            </ul>
        </div>

        <div class="buttons">
            <a class="button blue" href="{{route('dashboard-minors')}}">Alle minoren</a>
            <a class="button blue" href="{{route('dashboard-minor-versions', $minor->id)}}">Alle versies bekijken</a>
            @if ($minor->organisation != null)
                <a class="button blue" href="{{route('dashboard-organisation', $minor->organisation->id)}}" class="">
                    Meer over {{$minor->organisation->name}}</a>
            @else
                <div class="button blue disabled">Deze minor heeft geen organisatie</div>
            @endif
            <a class="button blue" href="{{route('dashboard-minor-edit', ["id"=>$minor->id, "v"=>$minor->version])}}">Editen</a>
        </div>

        <div class="col-12 box margin">
            <h3>Onderwerp</h3>
            {!! $minor->subject !!}
        </div>

        <div class="col-12 box margin">
            <h3>Goals</h3>
            {!! $minor->goals !!}
        </div>

        <div class="col-12 box margin">
            <h3>Requirements</h3>
            {!! $minor->requirements !!}
        </div>

        <div class="col-12 box margin">
            <h3>Tags</h3>
            @if ($minor->tags->count() > 0)
                <ul>
                    @foreach ($minor->tags as $tag)
                        <li><a href="{{route('dashboard-minors', ['tags'=>[$tag->id]])}}">{{$tag->tag}}</a></li>
                    @endforeach
                </ul>
            @else
                <p>Deze minor heeft geen tags</p>
            @endif
        </div>

        <div class="col-12 box margin">
            <h3>Periodes</h3>
            @if ($minor->educationPeriods->count() > 0)
                @foreach ($minor->educationPeriods as $periods)
                    <h6>{{$periods->name}}</h6>
                    <ul class="list">
                        <li>Van {{$periods->start}}</li>
                        <li>Tot {{$periods->end}}</li>
                    </ul>
                @endforeach
            @else
                <p>Deze minor heeft geen periodes</p>
            @endif
        </div>

        <div class="col-12 box margin">
            <h3>Contact</h3>
            @if (isset($minor->contactGroup))
                <p>Het contactpersoon voor deze minor is <b>{{$minor->contactGroup->name}}</b>, te bereiken op
                    <b>{{$minor->contactGroup->email}}</b></p>
                @if (isset($minor->contactGroup->telephone) && $minor->contactGroup->telephone != "")
                    <p>Het telefoonnummer is {{$minor->contactGroup->telephone}}</p>
                @endif
                {{$minor->contactGroup->postaladdress}}

                <p>
                    <a class="active" href="{{route('dashboard-contactgroup', $minor->contactGroup->id)}}">Meer info</a>
                </p>
            @else
                <p>Geen contact gevonden</p>
            @endif
        </div>

        <div class="col-12 box margin">
            <h3>Docenten</h3>
            @if ($minor->contactPersons->count() > 0)
                <ul class="list">
                    @foreach ($minor->contactPersons as $contactperson)
                        <li>{{$contactperson->firstname}}
                            {{$contactperson->middlename}}
                            {{$contactperson->lastname}}
                            <b>{{(!empty($contactperson->email) ? $contactperson->email : "Geen email ingesteld")}}</b>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Geen docenten aan deze minor gekoppeld</p>
            @endif
        </div>

            <div class="col-12 box margin">
                <h3>Reviews</h3>
                @if ($reviews->count() > 0)
                    @foreach($reviews as $r)
                        <div class="box shadow mb-2 review-detail">
                            @if(!$r->admin_deleted)
                                <a href="/dashboard/review/{{$r->id}}/quarantine" class="button blue">Verwijderen</a>

                            @else
                                <a href="/dashboard/review/{{$r->id}}/recover" class="button blue">Herstellen</a>

                            @endif
                            <h5>{{__('minors.review_minor_title')}}</h5>
                            <p>{{$r->description}}</p>
                            <h5>{{__('minors.review_minor_comment')}}</h5>
                            <p>{{$r->comment}}</p>
                            <h5>{{__('minors.review_minor_rating')}}</h5>
                            <div class="d-flex flex-column flex-md-row justify-content-around stars">
                                <p class="d-flex flex-column">
                                <span class="d-flex flex-row justify-content-center">
                                    @for($i=0; $i<5; $i++)
                                        @if($i < $r->grade_quality)
                                            <i class="fas fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </span>
                                    <b>{{__('minors.review_quality')}}</b>
                                    <span class="description">{{$r->grade_quality}} {{__('minors.review_stars')}}</span>
                                </p>
                                <p class="d-flex flex-column">
                                <span class="d-flex flex-row justify-content-center">
                                    @for($i=0; $i<5; $i++)
                                        @if($i < $r->grade_studiability)
                                            <i class="fas fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </span>

                                    <b class="text-center">{{__('minors.review_studiability')}}</b>
                                    <span
                                        class="description">{{$r->grade_studiability}} {{__('minors.review_stars')}}</span>
                                </p>
                                <p class="d-flex flex-column">

                                <span class="d-flex flex-row justify-content-center">
                                    @for($i=0; $i<5; $i++)
                                        @if($i < $r->grade_content)
                                            <i class="fas fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </span>

                                    <b class="text-center">{{__('minors.review_content')}}</b>
                                    <span class="description">{{$r->grade_content}} {{__('minors.review_stars')}}</span>
                                </p>

                            </div>
                            @endforeach
                            @else
                                <p>Er zijn geen reviews op deze minor</p>
                            @endif
                        </div>
            </div>
    </div>
@endsection
