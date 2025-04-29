@extends('layouts.master') 

@section('title') 
    List of students from the course
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6"> 
            <ul>
                @foreach ($enrolled_students as $student)
                    <p><strong><a href="{{ route('score.create', ['student_id' => $student->id, 'assessment_id' => $assessment_id, 'course_code' => $course_code]) }}" class="text-dark">{{$student->name}}</a></strong></p>
                    <li>Number of reviews submitted:{{$student->reviews ? $student->reviews->count() : 0}}</li>       
                    <li>Number of reviews received:{{$student->reviewsReceived ? $student->reviewsReceived->count() : 0}}</li>
                    @foreach ($student->enrollments->where('course_code', $course_code) as $enrollment)
                        @php 
                            $score = $enrollment->scores()->where('assessment_id', $assessment_id)->first();
                        @endphp
                        @if (isset($score))  
                            <p>Score: {{$score->score}}</p>
                        @else
                            <p>No score released yet.</p>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            @if (session('enroll-success'))
                <div class="text-danger">
                    {{ session('enroll-success') }}
                </div>
            @endif
            @if (session('enroll-alert'))
                <div class="text-danger">
                    {{ session('enroll-alert') }}
                </div>
            @endif
            @if (session('file-success'))
                <div class="text-danger">
                    {{ session('file-success') }}
                </div>
            @endif
            @if (session('file-alert'))
                <div class="text-danger">
                    {{ session('file-alert') }}
                </div>
            @endif
            <form method="POST" action="{{ route('enrollment.enroll') }}">
                @csrf
                <input type="hidden" name="course_code" value="{{$course_code}}">
                <label for="enroll_student">Enroll a student: </label>
                <select id="enroll_student" name="student_id">
                    @foreach ($notenrolled_students as $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-sm btn-outline-secondary">Enroll</button>
            </form>
            <form method="POST" action="{{ route('upload_file') }}" style="margin-top:50px;" enctype="multipart/form-data">
                @csrf
                <label>Upload a file: </label>
                <input type="file" name="file">
                <button type="submit" class="btn btn-sm btn-outline-secondary">Upload</button>
            </form>
        </div>
    </div>
</div>

@endsection