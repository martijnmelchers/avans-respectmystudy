@extends('layouts/default')

@section("title", __('students.students_title'))

@section('head')
    <link href="/css/students.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
    <div class="row content justify-content-center">
        <div class="col-10">
            <div class="box">
                <h1>{{__('students.students_title')}}</h1>
                <p>{{__('students.students_description')}}</p>
            </div>

            <div class="box">
                <h3>{{__('students.students_filter')}}</h3>
                <form method="get">
                    <div class="form-group">
                        <label for="name">{{__('students.name')}}</label>
                        <input type="text" name="name" value="{{$search['name']}}" id="name" placeholder="{{__('students.name')}}">
                    </div>

                    <input type="submit" class="button blue small">
                </form>
            </div>

            <div class="blocks">
                @foreach ($students as $student)
                    <a class="item" href="{{route('student', $student->id)}}">{{$student->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection


