@extends('layouts.master') 

@section('title') 
    Course_details
@endsection

@section('content')
<div class="container my-3 d-flex flex-column " style="width:60%;">
    <div>  
        <h3>{{ $course->course_name }}</h3>
    </div>
    <div class="d-flex flex-row ms-5">
        <p>The team of teachers:</p>
        <ul class="list-unstyled d-flex flex-wrap">
            @foreach($teachers as $teacher)
                <li class="d-flex align-items-center mb-2" style="margin-left: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                    <span>{{ $teacher->name }}</span>
                </li>
            @endforeach
        </ul>           
    </div>
    @if (session('edit-success'))
        <div class="text-danger">
            {{ session('edit-success') }}
        </div>
    @endif
    @if (session('edit-alert'))
        <div class="text-danger">
            {{ session('edit-alert') }}
        </div>
    @endif
    @if (session('assign-success'))
        <div class="text-danger">
            {{ session('assign-success') }}
        </div>
    @endif
    @if (session('assign-error'))
        <div class="text-danger">
            {{ session('assign-error') }}
        </div>
    @endif
</div>
    <!-- assessments that are related with the course -->
@foreach ($assessments as $assessment)
    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-3 align-items-center justify-content-center">
        <div class="list-group w-50">
            <a href="{{ route('assessment.show', $assessment->id) }}" class="list-group-item list-group-item-action d-flex gap-3 py-3 mx-auto" aria-current="true">
            <div class="d-flex gap-2 w-100 justify-content-between W-100">
                <div class="d-flex flex-column">
                    <h6 class="mb-0">{{ $assessment->title }}</h6>
                </div>
                <div class="d-flex flex-column justify-content-end">
                    <p class="mb-0 opacity-75 text-end">Due: {{ \Carbon\Carbon::parse($assessment->due_dateTime)->format('Y-m-d H:i') }}</p>
                </div> 
            </div>
            </a>
        </div>
        @if(Auth::user()->user_type == 'teacher')
            <button type="button" class="btn btn-outline-secondary" onclick="toggleUpdate_assessment({{ $assessment->id }}, '{{ $course->course_code }}')">Edit</button>
            <button type="button" class="btn btn-outline-secondary" onclick="toggleAssign_student({{ $assessment->id }}, '{{ $course->course_code }}')">Assign student</button>
        @endif
    </div>
    @if(Auth::user()->user_type == 'teacher')
        <div id="update-form-{{$assessment->id}}-{{$course->course_code}}" class="update-form" style="display: none;">
            <div class="col-md-9 col-lg-10 mx-auto p-1">
                <div class="col-md-9 col-lg-11 mx-auto">
                    <hr>
                    <!-- form to update specific assessment -->
                    <form method="POST" action="{{ route('assessment.update', $assessment->id) }}">
                        @csrf
                        <input type="hidden" name="assessment_id" value="{{$assessment->id}}">
                        <input type="hidden" name="course_code" value="{{$course->course_code}}">
                        <div class="d-flex flex-row mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" value="{{$assessment->title}}"class="form-control style-input ms-2" style="width:150px;">
                            <label for="require_number" class="form-label ms-4">Required number:</label>
                            <input type="text" name="require_number" value="{{$assessment->require_number}}" class="form-control style-input ms-2" style="width:60px;">
                            <label for="max_score" class="form-label ms-4">Max score:</label>
                            <input type="text" name="max_score" value="{{$assessment->max_score}}" class="form-control style-input ms-2" style="width:60px;">
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <label for="due_dateTime" class="form-label">Due date&time:</label>
                            <input type="datetime-local" name="due_dateTime" value="{{$assessment->due_dateTime}}" class="form-control style-input" style="width:200px;">
                            <label for="group_number" class="form-label ms-4">Number of Groups:</label>
                            <input type="number" name="group_number" class="form-control style-input ms-2" style="width:60px;" min="1" value="3">
                        </div>
                        <label for="instruction" class="form-label">Instruction:</label>
                        <textarea type="text" class="form-control style-input" id="instruction" name="instruction" rows="8" cols="30" required>{{ old('instruction', $assessment->instruction)}}</textarea>
                        <div class="col-md-10 col-lg-11 mr-auto d-flex justify-content-end"> 
                            <button type="submit" class="btn btn-outline-secondary">Update</button>
                        </div>
                    </form> 
                    <hr>
                </div>
            </div>
        </div>
        <div id="assign-form-{{$assessment->id}}-{{$course->course_code}}" class="assign-form" style="display: none;">
            <div class="col-md-9 col-lg-10 mx-auto p-1">
                <div class="col-md-9 col-lg-11 mx-auto">
                    <hr> 
                    <!-- form to assign student to a group -->
                    <form method="POST" action="{{ route('updateGroup_type') }}">
                        @csrf
                        <input type="hidden" name="course_code" value="{{$course->course_code}}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="student_name" class="form-label">Student name: </label>
                                <input type="text" name="student_name" class="form-control style-input ms-2" required>
                            </div>
                            <div class="col-md-4">
                                <label for="student_number" class="form-label">Student number: </label>
                                <input type="text" name="student_number" class="form-control style-input ms-2" required>
                            </div>
                            <div class="col-md-3">
                                <label for="group_id" class="form-label">Select group: </label>
                                <select name="group_id" class="form-select">
                                    @foreach ($assessment->groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Assign</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    @endif
@endforeach

<!-- form to create new assessment (peer review) for teacher -->
@if(Auth::user()->user_type == 'teacher')
    @if(session('assessment-success'))
        <div class="text-danger">
            {{ session('assessment-success') }}
        </div>
    @endif
    <div class="col-md-9 col-lg-10 mx-auto bg-body-tertiary p-1" style="margin-top:20px;">
        <div class="col-md-9 col-lg-11 mx-auto"> 
            <h5 class="mt-2 mb-3">Create a new assessment: </h5>  
            <form class="needs-validation" method="POST" action="{{route('assessment.store')}}" novalidate> 
            @csrf
                <!-- pass course_code -->
                <input type="hidden" name="course_code" value="{{$course->course_code}}">
                <div class="d-flex flex-row mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control style-input ms-2" style="width:150px;">
                    <label for="require_number" class="form-label ms-4">Required number:</label>
                    <input type="text" name="require_number" class="form-control style-input ms-2" style="width:60px;">
                    <label for="max_score" class="form-label ms-4">Max score:</label>
                    <input type="text" name="max_score" class="form-control style-input ms-2" style="width:60px;">
                </div>
                <div class="d-flex flex-row mb-3">
                    <label for="due_dateTime" class="form-label">Due date&time:</label>
                    <input type="datetime-local" name="due_dateTime" class="form-control style-input" style="width:200px;">
                    <label for="group_number" class="form-label ms-4">Number of Groups:</label>
                    <input type="number" name="group_number" class="form-control style-input ms-2" style="width:60px;" min="1" value="3">
                </div>
                <label for="instruction" class="form-label">Instruction:</label>
                <textarea type="text" class="form-control style-input" id="instruction" name="instruction" rows="8" cols="30" required></textarea>
                <div class="col-md-10 col-lg-11 mr-auto d-flex justify-content-end"> 
                    <button type="submit" class="btn btn-outline-secondary">Add</button>
                </div>  
            </form>
        </div> 
    </div>
@endif

@endsection