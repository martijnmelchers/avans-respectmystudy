<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts/default')

@section("title", "Minor")

@section('head')
    <link href="/css/minors.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-md-10 col-12">
            <div class="col box">

                @if(Auth::check())
                    <div class="minor_like">
                        <a href="{{route('minor-like', $minor->id)}}">

                            @if($minor->userHasLike())
                                <i class="fas fa-heart"></i>
                            @else
                                <i class="far fa-heart"></i>
                            @endif
                        </a>
                    </div>
                @endif
                <h1>{{$minor->name}}</h1>
                @if (!empty($minor->averageReviews()))
                    <div class="row stars col-xl">
                        <div class="col-md-4 text-center">
                            <div class="starwrapper">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($minor->averageReviews()[0] > $i)
                                        <i class="fas fa-star star"></i>
                                    @else
                                        <i class="far fa-star star"></i>
                                    @endif
                                @endfor
                            </div>
                            <b class="f-primary w-600 c-primary">
                                {{$minor->averageReviews()[0]}} {{__('minors.reviews_average')}}
                            </b>
                            <p class="f-primary">
                                {{__('minors.reviews_content_and_quality')}}
                            </p>
                        </div>

                        <div class="col-md-4 text-center">
                            <div class="starwrapper">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($minor->averageReviews()[1] > $i)
                                        <i class="fas fa-star star"></i>
                                    @else
                                        <i class="far fa-star star"></i>
                                    @endif
                                @endfor
                            </div>
                            <b class="f-primary w-600 c-primary">
                                {{$minor->averageReviews()[1]}} {{__('minors.reviews_average')}}
                            </b>
                            <p class="f-primary">
                                {{__('minors.reviews_quality_teachers')}}
                            </p>
                        </div>


                        <div class="col-md-4 text-center">
                            <div class="starwrapper">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($minor->averageReviews()[2] > $i)
                                        <i class="fas fa-star star"></i>
                                    @else
                                        <i class="far fa-star star"></i>
                                    @endif
                                @endfor
                            </div>
                            <b class="f-primary w-600 c-primary">
                                {{$minor->averageReviews()[2]}} {{__('minors.reviews_average')}}
                            </b>
                            <p class="f-primary">
                                {{__('minors.reviews_studiability')}}
                            </p>
                        </div>
                    </div>
                @else
                    {{__('minors.no_reviews')}}
                @endif
            </div>
        </div>

        <div class="col-md-10 col-12">
            <div class="box mb-1">
                <p>{!! $minor->subject !!}</p>
                <ul>
                    {{__('minors.minor_language')}} <b>{{$minor->language}}</b>
                </ul>
            </div>
        </div>

        <div class="col-md-10 col-12 mb-1">
            <div class="buttons stretch">
                <a href="/" class="button red">Home</a>
                <a href="{{route('minors')}}" class="button red">{{__('minors.all_minors')}}</a>
                @if($minor->organisation)
                    <a href="{{route('organisation', $minor->organisation->id)}}"
                       class="button red">{{__('minors.all_minors_for')}} {{$minor->organisation->name}}</a>
                @endif
            </div>
        </div>

        <div class="col-md-10 col-12">
            <div class="box">
                <h3>{{__('minors.minor_goals')}}</h3>
                <p>{!! $minor->goals !!}</p>

                <h3>{{__('minors.minor_requirements')}}</h3>
                <p>{!! $minor->requirements !!}</p>

                <h3>{{__('minors.minor_examination')}}</h3>
                <p>{!! $minor->examination !!}</p>
            </div>
        </div>

        <div class="col-md-10 col-12">
            @if ($minor->locations->count() > 0)
                <div class="box mb-0">
                    <h3>{{__('minors.minor_location')}}</h3>
                    <p>{{__('minors.minor_location_info')}}</p>
                </div>
                <div class="buttons stretch">
                    @foreach ($minor->locations as $location)
                        <a class="button blue" href="{{route('location', $location->id)}}">{{$location->name}}</a>
                    @endforeach
                </div>
            @else
                <div class="box">
                    <h3>{{__('minors.minor_location')}}</h3>
                    <p>{{__('minors.minor_no_locations')}}</p>
                </div>
            @endif
        </div>

        <div class="col-md-10 col-12">
            @if ($minor->educationPeriods->count() > 0)
                <div class="box">
                    <h3>{{__('minors.educationperiod.periods')}}</h3>
                    <p>{{__('minors.educationperiod.info')}}</p>

                    @foreach ($minor->educationPeriods->where('start', '>', date('Y-m-d')) as $period)
                        <h6 class="mt-3">{{$period->name}}</h6>
                        <p>{{__('minors.educationperiod.from')}} {{date("m-d-Y", strtotime($period->start))}}</p>
                        <p>{{__('minors.educationperiod.until')}} {{date("m-d-Y", strtotime($period->end))}}</p>
                    @endforeach
                </div>
            @else
                <div class="box">
                    <h3>{{__('minors.educationperiod.periods')}}</h3>
                    <p>{{__('minors.educationperiod.no_periods')}}</p>
                </div>
            @endif
        </div>

        <div class="col-md-10 col-12">
            @if (empty($minor->yourReview()))
                <div class="box">
                    <h3>{{__('minors.new_review')}}</h3>
                    @if (Session::has('flash_message'))
                        <div class="alert">{{ Session::get('flash_message') }}
                            <span class="closebutton dark"
                                  onclick="this.parentElement.style.display='none';">&times;</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post">
                        @csrf

                        <div class="form-group">
                            <input value="{{old('title')}}" class="titlefield" type="text" name="title"
                                   placeholder="{{__('minors.review_title_placeholder')}}">
                        </div>
                        <div class="form-group">
                    <textarea name="message" required placeholder="{{__('minors.review_content_placeholder')}}"
                              type="message">{{old('message')}}</textarea>
                        </div>
                        <div class="d-flex flex-column flex-md-row justify-content-around stars">
                            <div class="rating">
                                <input type="radio" id="star5_1" name="rating_1" value="5"/>
                                <label class="full"
                                       for="star5_1"
                                       title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4_1" name="rating_1" value="4"/>
                                <label class="full" for="star4_1"
                                       title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3_1" name="rating_1" value="3"/>
                                <label class="full" for="star3_1"
                                       title="Meh - 3 stars"></label>
                                <input type="radio" id="star2_1" name="rating_1" value="2"/>
                                <label class="full" for="star2_1"
                                       title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1_1" name="rating_1" value="1"/>
                                <label class="full" for="star1_1"
                                       title="Sucks big time - 1 star"></label>
                                <b>{{__('minors.review_quality')}}</b>
                            </div>
                            <div class="rating">
                                <input type="radio" id="star5_2" name="rating_2" value="5"/>
                                <label class="full"
                                       for="star5_2"
                                       title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4_2" name="rating_2" value="4"/>
                                <label class="full"
                                       for="star4_2"
                                       title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3_2" name="rating_2" value="3"/>
                                <label class="full"
                                       for="star3_2"
                                       title="Meh - 3 stars"></label>
                                <input type="radio" id="star2_2" name="rating_2" value="2"/>
                                <label class="full"
                                       for="star2_2"
                                       title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1_2" name="rating_2" value="1"/>
                                <label class="full"
                                       for="star1_2"
                                       title="Sucks big time - 1 star"></label>
                                <b>{{__('minors.review_studiability')}}</b>
                            </div>
                            <div class="rating">
                                <input type="radio" id="star5_3" name="rating_3" value="5"/>
                                <label class="full"
                                       for="star5_3"
                                       title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4_3" name="rating_3" value="4"/>
                                <label class="full"
                                       for="star4_3"
                                       title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3_3" name="rating_3" value="3"/>
                                <label class="full"
                                       for="star3_3"
                                       title="Meh - 3 stars"></label>
                                <input type="radio" id="star2_3" name="rating_3" value="2"/>
                                <label class="full"
                                       for="star2_3"
                                       title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1_3" name="rating_3" value="1"/>
                                <label class="full"
                                       for="star1_3"
                                       title="Sucks big time - 1 star"></label>
                                <b>{{__('minors.review_content')}}</b>
                            </div>
                        </div>
                        <input class="button blue mt-2" type="submit" value="{{__('minors.buttons.post_button')}}">
                    </form>
                </div>
            @endif
        </div>

        <div id="overlay">
            <div class="d-flex flex-column box overlay-container">
                <div class="d-flex flex-row-reverse">
                    <span class="d-flex"></span>
                    <span class="closebutton dark" onclick="hideOverlay(true)">&times;</span>
                </div>
                <div class="d-flex flex-column">

                    <h3>{{__('minors.review_remove_warning')}}</h3>
                    <div class="d-flex flex-row justify-content-center overlay-buttons">
                        <div class="button red"
                             onclick="hideOverlay(false)">{{__('minors.review_remove')}}</div>
                        <div class="button grey"
                             onclick="hideOverlay(true)">{{__('minors.review_remove_cancel')}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10 col-12">
            <div class="box">
                <h3>Reviews</h3>
            </div>

            @foreach($reviews as $r)
                <div class="box shadow mb-2 review-detail">
                    @if($r->user_id == $user_id)
                        <form method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input type="hidden" name="review" value="{{$r->id}}"/>
                            <span class="closebutton dark" onclick="showOverlay(this)">&times;</span>
                        </form>
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
                            <span class="description">{{$r->grade_studiability}} {{__('minors.review_stars')}}</span>
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
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function showOverlay(button) {
            window.currentDeleteReviewForm = button.parentElement;
            document.getElementById('overlay').style.display = 'flex';
        }

        function hideOverlay(cancel) {
            if (!cancel && window.currentDeleteReviewForm) {
                window.currentDeleteReviewForm.submit();
            }
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
@endsection