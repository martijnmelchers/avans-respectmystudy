@extends('layouts/default')

@section("title", "Student")

@section('head')
@endsection

@section('content')
    <div class="row content justify-content-center">
        <div class="col-10 box">
            <h1>{{$student->name}}</h1>
            <ul>
            </ul>
        </div>
        <div class="buttons stretch col-10">
            <a href="/" class="button red">{{__('students.buttons.home_button')}}</a>
            <a href="{{route('students')}}" class="button red">{{__('students.buttons.students_button')}}</a>
        </div>
    </div>
@endsection