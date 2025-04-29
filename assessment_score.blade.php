@extends('layouts.master') 

@section('title') 
    Mark for assessment
@endsection

@section('content')

<p>Student Name: <b>{{$student->name}}</b></p>

<p>Reviews submitted by <u>{{$student->name}}: </u></p>
<ul>
    @forelse ($student->reviews as $review)
        <li>{{ $review->text}}</li>
    @empty
        <li>No reviews submitted yet.</li>
    @endforelse
</ul>

<p>Reviews received by <u>{{$student->name}}: </u></p>
<ul>
    @forelse ($student->reviewsReceived as $review)
        <li>{{ $review->text}}</li>
    @empty
        <li>No reviews submitted yet.</li>
    @endforelse
</ul>
@if (session('score-success'))
    <div class="text-danger">
        {{ session('score-success') }}
    </div>
@endif
@if (session('score-alert'))
    <div class="text-danger">
        {{ session('score-alert') }}
    </div>
@endif
<form method="POST" action="{{ route('score.store') }}">
    @csrf
    <input type="hidden" name="student_name" value="{{$student->name}}">
    <input type="hidden" name="assessment_id" value="{{$assessment_id}}">
    <input type="hidden" name="enrollment_id" value="{{$enrollment_id}}">
    <label for="score">Score for this student: </label>
    <input type="text" name="score" style="width:60px;">
    <button type="submit" class="btn btn-outline-secondary">Submit</button>
</form>
<form method="GET" action="{{ route('assessment.show', ['id' => $assessment_id]) }}">
    <input type="hidden" name="course_students_list" value="{{ url()-> previous() }}">
    <button type="submit" class="btn btn-outline-secondary">Go back to last page &laquo</button>
</form>

@endsection