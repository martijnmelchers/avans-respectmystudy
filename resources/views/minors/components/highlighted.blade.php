<?php
    use Illuminate\Support\Facades\Storage;
?>


<div class="news-articles">
<div class="row">
    @if (sizeof($minors) > 0)
        @foreach ($minors as $minor)
            <div class="box minor col-12">
                <a href="minor/{{$minor->id}}">

                    <div class="row justify-content-between">
                        <div class="col-10">
                            <div>
                                <h4 class="w-700 text-uppercase">{{$minor->name}}</h4>
                                <p class="text-small text-lined f-secondary c-secondary">
                                    {{Strip_tags(substr($minor->subject, 0, 550))}}...
                                </p>
                            </div>
                        </div>
                        <div class="col-2">
                            @if($organisation::findOrFail($minor->organisation_id)->organisation_image != null)
                            <img class="organisation_img"
                                    src="{{Storage::url($organisation::findOrFail($minor->organisation_id)->organisation_image)}}"/>
                            @else

                            @endif
                            <h3 class="points text-center f-primary w-600">
                                <span class="c-black">{{$minor->ects}},0</span>
                                <span class="c-secondary">EC</span>
                            </h3>
                        </div>
                    </div>
                    <br>
                    <div class="row info-gray">
                        <div class="col-4">
                            <p class="mb-1"><b>{{__('minors.education_period')}}</b></p>
                            <p class="mb-1"><i class="far fa-calendar-alt"></i>
                                {{$minor->nextPeriod() ? date("Y-m-d", strtotime($minor->nextPeriod()->start)) : "Geen onderwijsperiode"}}
                            </p>
                            {{--<p><i class="far fa-edit"></i> Geen inschrijfdatum</p>--}}
                        </div>
                        <div class="col-8">
                            @if (sizeof($minor->averageReviews()) > 0)
                                <div class="row">
                                    <div class="col-xl-8">
                                        <h6 class="w-700">{{__('minors.student_rating')}}</h6>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="label float-right">
                                            <i class="fas fa-comments"></i>&nbsp
                                            {{ $minor->averageReviews()[3]}} reviews
                                        </div>
                                    </div>

                                </div>
                                <div class="row stars col-xl">

                                    <div class="text-center">
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


                                    <div class="text-center">
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


                                    <div class="text-center">
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
                                    <p>
                                        content
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
</div>
</div>
