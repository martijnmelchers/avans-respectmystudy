@extends('layouts/default')

@section("title", "Minor")

@section('head')
    <link href="/css/minors.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
<div class="row content justify-content-center minor">
    <div class="col-10">
        <div class="col box">
            <h1>{{$minor->name}}</h1>
            <p>{!! $minor->subject !!}
            </p>
        </div>
    </div>

    <div class="col-10 row buttons">
        <div class="col-xl">
            <a href="/" class="button block red">Home</a>
        </div>
        <div class="col-xl">
            <a href="{{route('minors')}}" class="button block red">{{__('minors.all_minors')}}</a>
        </div>
        <div class="col-xl">
            <a href="{{route('organisation', $minor->organisation->id)}}" class="button block red">{{__('minors.all_minors_for')}} {{$minor->organisation->name}}</a>
        </div>
    </div>

    <div class="col-10">
        <div class="col-12 box">
            <h3>{{__('minors.minor_goals')}}</h3>
            <p>{!! $minor->goals !!}</p>

            <h3>{{__('minors.minor_requirements')}}</h3>
            <p>{!! $minor->requirements !!}</p>

            <h3>{{__('minors.minor_examination')}}</h3>
            <p>{!! $minor->examination !!}</p>
        </div>
    </div>

    <div class="col-10">
        @if ($minor->locations->count() > 0)
            <div class="col-12 box">
                <h3>{{__('minors.minor_location')}}</h3>
                <p>{{__('minors.minor_location_info')}}</p>
            </div>
            <div class="col-12 box">
                @foreach ($minor->locations as $location)
                    <a class="button blue" href="{{route('location', $location->id)}}">{{$location->name}}</a>
                @endforeach
            </div>
        @else
            <div class="col-12 box">
                <h3>{{__('minors.minor_location')}}</h3>
                <p>{{__('minors.minor_no_locations')}}</p>
            </div>
        @endif
    </div>

    <div class="col-10">
        <div class="col-12 box">
            <h3>{{__('minors.new_review')}}</h3>
            @if (Session::has('flash_message'))
                <div class="alert">{{ Session::get('flash_message') }}
                    <span class="closebutton dark" onclick="this.parentElement.style.display='none';">&times;</span>
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
                {{ csrf_field() }}
                <div class="form-group">
                    <input class="titlefield" type="text" name="title" placeholder="{{__('minors.review_title_placeholder')}}">
                </div>
                <div class="form-group">
                    <textarea name="message" required placeholder="{{__('minors.review_content_placeholder')}}"
                              type="message"></textarea>
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
                <input class="button blue" type="submit" value="{{__('minors.buttons.post_button')}}">
            </form>
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
        <div id="overlay">
            <div class="d-flex flex-column box overlay-container">
                <div class="d-flex flex-row-reverse">
                    <span class="d-flex"></span>
                    <span class="closebutton dark" onclick="hideOverlay(true)">&times;</span>
                </div>
                <div class="d-flex flex-column">

                    <h3>{{__('minors.review_remove_warning')}}</h3>
                    <div class="d-flex flex-row justify-content-center overlay-buttons">
                        <div class="button red" onclick="hideOverlay(false)">{{__('minors.review_remove')}}</div>
                        <div class="button grey" onclick="hideOverlay(true)">{{__('minors.review_remove_cancel')}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 box">
            <h3>Reviews</h3>
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
                            <b>{{__('minors.review_studiability')}}</b>
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
                            <b>{{__('minors.review_content')}}</b>
                            <span class="description">{{$r->grade_content}} {{__('minors.review_stars')}}</span>
                        </p>
                    </div>
                    <h6>{{__('minors.review_published_on')}}{{$r->created_at}}</h6>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection