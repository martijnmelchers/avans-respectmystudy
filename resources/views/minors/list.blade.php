@extends('layouts/default')

@section("title", "Filter Minors")

@section('head')
    <link href="/css/minors.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
    <div class="row content">
        <div class="col-xl-3 mb-4">
            <div class="box">
                <h3 class="text-center text-uppercase w-700 f-primary">{{__('minors.filter')}}</h3>
                <p class="text-center w-500 f-primary c-primary">{{$total_minor_amount == 0 ? __('minors.none_found') : "{$total_minor_amount} " . __('minors.minors_found')  }}</p>

                <form method="get" autocomplete="off">
                    <div class="form-group">
                        <label for="name">{{__('minors.minor_name')}}</label>
                        <input type="text" id="name" name="name" value="{{$name}}"
                               placeholder="{{__('minors.minor_name')}}">
                    </div>

                    <div class="form-group">
                        <label for="ecs">{{__('minors.points')}}</label>
                        <input type="text" id="ecs" name="ects" value="{{$ects}}" placeholder="{{__('minors.points')}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('minors.organisation')}}</label>
                        <div class="collapse">
                            <div class="title">{{sizeof($selected_organisations)}} {{__('minors.selected')}}</div>
                            <div class="drop">
                                @foreach($organisations as $organisation)
                                    <div class="form-group">
                                        <input name="organisations[]"
                                               <?php if (in_array($organisation['id'], $selected_organisations)) echo "checked"; ?> type="checkbox"
                                               id="{{$organisation->id}}" value="{{$organisation->id}}">
                                        <label class="inline-block"
                                               for="{{$organisation->id}}">{{$organisation->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>{{__('minors.language')}}</label>
                        <div class="collapse">
                            <div class="title">{{sizeof($selected_languages)}} {{__('minors.selected')}}</div>
                            <div class="drop">
                                @foreach($languages as $language)
                                    <div class="formline">
                                        <input name="languages[]"
                                               <?php if (in_array($language, $selected_languages)) echo "checked"; ?> type="checkbox"
                                               id="{{$language}}" value="{{$language}}">
                                        <label class="inline-block" for="{{$language}}">{{$language}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>{{__('minors.tags')}}</label>
                        <div class="collapse">
                            <div class="title">{{sizeof($selected_tags)}} {{__('minors.selected')}}</div>
                            <div class="drop">
                                @foreach($tags as $tag)
                                    <div class="formline">
                                        <input name="tags[]"
                                               <?php if (in_array($tag->id, $selected_tags)) echo "checked"; ?> type="checkbox"
                                               id="{{$tag->id}}" value="{{$tag->id}}">
                                        <label class="inline-block" for="{{$tag->id}}">{{$tag->tag}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="orderby">{{__('minors.sort')}}</label>
                        <select name="orderby">
                            <option value="">{{__('minors.no_sort')}}</option>
                            <option
                                <?php if ($orderby == "name") echo "selected"; ?> value="name">{{__('minors.minor_name')}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="start_from">{{__('minors.start_from')}}</label>
                        <input type="date" id="start_from" name="start_from" value="{{$start_from}}"
                               placeholder="{{__('minors.start_from')}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button blue block">{{__('minors.buttons.search_button')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-6 offset-xl-1 mr-auto ml-auto col-11">
            <div class="row">
                @if (sizeof($minors) > 0)
                    @foreach ($minors as $minor)
                        <div class="box minor col-12">
                            <a href="minor/{{$minor->id}}">
                                <div class="row justify-content-between">
                                    <div class="col-md-10">
                                        <div>
                                            <h4 class="w-700 text-uppercase">{{$minor->name}}</h4>
                                            <p class="text-small text-lined f-secondary c-secondary">
                                                {{Strip_tags(substr($minor->subject, 0, 550))}}...
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        @if(!empty($organisation) && $organisation::find($minor->organisation_id)->organisation_image != null)
                                            <img class="organisation_img"
                                                 src="{{Storage::url($organisation::findOrFail($minor->organisation_id)->organisation_image)}}"/>
                                        @endif
                                        <h3 class="points text-center f-primary w-600">
                                            <span class="c-black">{{$minor->ects}},0</span>
                                            <span class="c-secondary">EC</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="row info-gray">
                                    <div class="col-md-3">
                                        <p class="mb-1"><b>{{__('minors.education_period')}}</b></p>
                                        <p class="mb-1"><i class="far fa-calendar-alt"></i>
                                            {{$minor->nextPeriod() ? Carbon\Carbon::parse($minor->nextPeriod()->start)->formatLocalized('%x') : "Geen onderwijsperiode"}}
                                        </p>
                                    </div>
                                    <div class="col-md-9">
                                        @if (sizeof($minor->averageReviews()) > 0)
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <h6 class="w-700">{{__('minors.student_rating')}}</h6>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="label float-right">
                                                        <i class="fas fa-comments"></i>&nbsp
                                                        {{ $minor->averageReviews()[3]}} {{trans_choice('minors.reviews', $minor->reviews()->count())}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row stars col-xl">
                                                <div class="col-4 text-center">
                                                    <div class="mb-2">
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
                                                    <br>
                                                    <p class="f-primary">
                                                        {{__('minors.reviews_content_and_quality')}}
                                                    </p>
                                                </div>


                                                <div class="col-4 text-center">
                                                    <div class="mb-2">

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
                                                    <br>
                                                    <p class="f-primary">
                                                        {{__('minors.reviews_quality_teachers')}}
                                                    </p>

                                                </div>


                                                <div class="col-4 text-center">
                                                    <div class="mb-2">

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
                                                    <br>
                                                    <p class="f-primary">
                                                        {{__('minors.reviews_studiability')}}
                                                    </p>
                                                </div>


                                            </div>
                                        @else
                                            <div class="no-reviews">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <h3 class="w-700 text-uppercase">
                                                    {{__('minors.no_reviews')}}
                                                </h3>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach

                    <div class="pagenav col-12">
                        <div class="text">Pagina</div>
                        <div class="pages">
                            @if ($page > 0)
                                <a href="{{$request->fullUrlWithQuery(["page"=>$page - 1])}}"
                                   class="previous block"><i class="fas fa-arrow-left"></i> {{$page}}</a>
                            @endif

                            <div class="current block">{{$page + 1}}</div>

                            @if ($page + 1 < $pages)
                                <a href="{{$request->fullUrlWithQuery(["page"=>$page + 1])}}"
                                   class="next block">{{$page+2}} <i class="fas fa-arrow-right"></i></a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-12 box">
                        <p>{{__('minors.none_found')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
