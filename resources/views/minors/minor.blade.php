@extends('layouts/default')

@section("title", "Minor")

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <article>
                <h1>{{$minor->name}}</h1>
                <p>{!! $minor->subject !!}
                </p>
            </article>

            <div class="buttons">
                <a href="/" class="button">Home</a>
                <a href="{{route('minors')}}" class="button">Alle minors</a>
            </div>

            <article>
                <h3>Doelen</h3>
                <p>{!! $minor->goals !!}</p>
            </article>

            <article>
                <h3>Requirements</h3>
                <p>{!! $minor->requirements !!}</p>
            </article>

            <article>
                <h3>Toetsing</h3>
                <p>{!! $minor->examination !!}</p>
            </article>

            @if ($minor->locations->count() > 0)
                <article>
                    <h3>Locaties waar deze minor wordt gegeven:</h3>
                    <p>Klik op een locatie om er meer over te zien.</p>
                </article>
                <div class="buttons">
                    @foreach ($minor->locations as $location)
                        <a href="{{route('location', $location->id)}}">{{$location->name}}</a>
                    @endforeach
                </div>
            @else
                <article>
                    <h3>Locaties waar deze minor wordt geven:</h3>
                    <p>We hebben geen locaties gevonden waar deze minor wordt gegeven.</p>
                </article>
            @endif

            <div class="buttons" style="margin-bottom: 50px;">
                <a href="{{route('minors', ["organisations"=>[$minor->organisation->id]])}}" class="button blue">Alle
                    minors
                    van {{$minor->organisation->name}}</a>
            </div>
            <article>
                <h3>Voeg een nieuwe review toe</h3>
                @if (Session::has('flash_message'))
                    <div class="alert">{{ Session::get('flash_message') }}
                        <span class="closebutton" onclick="this.parentElement.style.display='none';">&times;</span>
                    </div>
                @endif
                <form method="post">
                    {{ csrf_field() }}
                    <div class="formline">
                        <input class="titlefield" type="text" name="title" placeholder="Vul hier de titel in...">
                    </div>
                    <div class="formline">
                        <textarea name="message" required placeholder="Typ hier uw review..." type="message"></textarea>
                    </div>
                    <div class="stars">
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
                            <input type="radio" required id="star1_1" name="rating_1" value="1"/>
                            <label class="full" for="star1_1"
                                   title="Sucks big time - 1 star"></label>
                            <b>kwaliteit</b>
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
                            <input type="radio" required id="star1_2" name="rating_2" value="1"/>
                            <label class="full"
                                   for="star1_2"
                                   title="Sucks big time - 1 star"></label>
                            <b>Studeerbaarheid</b>
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
                            <input type="radio" required id="star1_3" name="rating_3" value="1"/>
                            <label class="full"
                                   for="star1_3"
                                   title="Sucks big time - 1 star"></label>
                            <b>Inhoud</b>
                        </div>
                    </div>
                    <input type="submit" value="Plaats review">
                </form>
            </article>
            <style>
                #overlay {
                    position: fixed;
                    display: none;
                    flex: 1;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: rgba(0,0,0,0.5);
                    z-index: 2;
                    justify-content: center;
                    align-items: center;
                }
                .overlay-container {
                    max-width: 300px;
                    padding: 12px;
                }
                .overlay-buttons {
                    display: flex;
                    flex-direction: row;
                    margin-top: 8px;
                }
                .overlay-buttons .button {
                    margin: 8px;
                }
            </style>
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
                <article class="overlay-container">
                    <span class="closebutton dark" onclick="hideOverlay(true)">&times;</span>

                    <h3>Weet je zeker dat je deze review wilt verwijderen?</h3>
                    <div class="overlay-buttons">
                        <div class="button" onclick="hideOverlay(false)">Verwijder</div>
                        <div class="button gray" onclick="hideOverlay(true)">Annuleer</div>
                    </div>
                </article>
            </div>
            <article>
                <h3>Reviews</h3>
                @foreach($reviews as $r)
                    <div class="review_detail">
                        @if($r->user_id == $user_id)
                            <form method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="review" value="{{$r->id}}" />
                                <span class="closebutton dark" onclick="showOverlay(this)">&times;</span>
                            </form>
                        @endif
                        <h5>Titel</h5>
                        <p>{{$r->description}}</p>
                        <h5>Comment</h5>
                        <p>{{$r->comment}}</p>
                        <h5>Rating</h5>
                        <div class="stars">
                            <p>
                                <span class="row">
                                    @for($i=0; $i<5; $i++)
                                        @if($i < $r->grade_quality)
                                            <i class="fas fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <b>Kwaliteit</b>
                                <span class="description">{{$r->grade_quality}} Sterren</span>
                            </p>
                            <p>
                                <span class="row">
                                    @for($i=0; $i<5; $i++)
                                        @if($i < $r->grade_studiability)
                                            <i class="fas fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <b>Studeerbaarheid</b>
                                <span class="description">{{$r->grade_studiability}} Sterren</span>
                            </p>
                            <p>
                                <span class="row">
                                    @for($i=0; $i<5; $i++)
                                        @if($i < $r->grade_content)
                                            <i class="fas fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <b>Inhoud</b>
                                <span class="description">{{$r->grade_content}} Sterren</span>
                            </p>
                        </div>
                        <h6>Gepubliceerd op: {{$r->created_at}}</h6>
                    </div>
                @endforeach
            </article>
        </div>
    </div>




@endsection