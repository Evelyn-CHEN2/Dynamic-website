@extends('layouts.master') 

@section('title') 
    Home 
@endsection

@section('content')

<div class="container my-3">
  <div class="position-relative p-3 text-start">
    @auth
    <div class="d-flex flex-row">  
        <h5>Hi:{{Auth::user()->name}}</h5>
    </div>
    @endauth
    @if(Auth::user()->user_type == 'student')
        The courses you're enrolled:
    @endif
    @if(Auth::user()->user_type == 'teacher')
        The courses you're teaching:
    @endif
  </div>
</div>

@foreach($courses as $course)
    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-3 align-items-center justify-content-center">
        <div class="list-group w-100">
            <a href="{{ route('course.show', $course->course_code) }}" class="list-group-item list-group-item-action d-flex gap-3 py-3 mx-auto" aria-current="true">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                <h6 class="mb-0">{{$course->course_code}}</h6>
                <p class="mb-0 opacity-75">{{$course->course_name}}</p>
                <p class="mb-0 opacity-50">{{$course->course_content}}</p>
                </div> 
            </div>
            </a>
        </div>
    </div> 
@endforeach













@endsection
