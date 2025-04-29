@extends('layouts.master') 

@section('title') 
    Reviewer rates
@endsection

@section('content')

@foreach($sortedStudents as $sortedStudent)
    <p>Reviewer name: <b>{{ $sortedStudent->name }}</b></p>
    <p>Average review rate: 
        @if($sortedStudent->avg_rate)
            {{ $sortedStudent->avg_rate }}
        @else
            No reviews yet!
        @endif
    </p>
@endforeach

@endsection