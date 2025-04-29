@extends('layouts.master') 

@section('title') 
    Assessment 
@endsection

@section('content')
<div class="d-flex flex-row">
    <h3>{{$assessment->title}}</h3>
    <p class="opacity-75 ms-2">Due: {{$assessment->due_dateTime}}</p>
    <p class="opacity-75 ms-5">Reviews required:{{$assessment->require_number}}<p>
</div>
<p>{{$assessment->instruction}}<p>

@if ($groups->isEmpty())
    <p>No groups have been created for this assessment yet.</p>
@else
@if (session('group-success'))
    <div class="text-danger">
        {{ session('group-success') }}
    </div>
@endif
@if (session('group-error'))
    <div class="text-danger">
        {{ session('group-error') }}
    </div>
@endif
@if (session('review-success'))
    <div class="text-danger">
        {{ session('review-success') }}
    </div>
@endif
@if (session('rate-success'))
    <div class="text-danger">
        {{ session('rate-success') }}
    </div>
@endif
@if (session('rate-error'))
    <div class="text-danger">
        {{ session('rate-error') }}
    </div>
@endif
@if (session('group_change-error'))
    <div class="text-danger">
        {{ session('group_change-error') }}
    </div>
@endif
@if(session('review-alert'))
    <div class="text-danger">
        {{ session('review-alert') }}
    </div>
@endif
    <div class="d-flex flex-column">
        @foreach($groups as $group) 
            <div class="d-flex flex-row ms-5">
                <strong>Group{{ $group->group_name }}: </strong>
                @foreach($group->students as $student)    
                    <div class="ms-2">{{$student->name}}</div>
                @endforeach
                <!-- form to join the group -->
                <form method="GET" action="{{route('join.group')}}">
                @csrf
                    <input type="hidden" name="group_id" value="{{$group->id}}">
                    <button class="opacity-75 ms-5 btn btn-sm btn-outline-secondary" type="submit">Join</button>
                </form>
                <!-- form to create a review -->
                <form method="GET" action="{{route('review.create')}}" class="ms-5" style="display:inline;">
                @csrf
                    <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                    <label for="create_review">Create a Review</label>
                    <select id="create_review" name="student_id">
                        @foreach($group->students as $student)
                            <option value="{{$student->id}}">{{$student->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-outline-secondary ms-2" type="submit">Create</button>
                </form>
            </div>
            <div>        
                @foreach($group->students as $student) 
                    @foreach($student->reviews->where('assessment_id', $assessment->id) as $review)
                    <!-- retrieve the reviews from students that have the same assessment_id with current page's assessment_id -->
                        <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-3 align-items-center justify-content-center" style="width:90%">
                            <div class="list-group" style="width:100%">
                                <div class="d-flex gap-2 justify-content-between list-group-item" style="width:100%">
                                    <div class="d-flex flex-column" style="width:25%">
                                        <p><strong>Reviewer: </strong>{{$review->reviewer->name}}</p>
                                        <p><strong>Reviewee: </strong>{{$review->reviewee->name}}</p>
                                        <!-- reviewer, reviewee seen in Model of Review.php -->
                                        <form method="POST" action="{{route('review.update', $review->id)}}">
                                            <!-- update the column 'review_rate' in table reviews -->
                                            @csrf      
                                            @method('PUT')                   
                                            <input type="hidden" name="reviewer_id" value="{{$review->reviewer_id}}">
                                            <input type="hidden" name="reviewee_id" value="{{$review->reviewee_id}}">
                                            <label for="rating">Rate this review:</label>
                                            <div id="rating">
                                                <input type="radio" id="rate1" name="rating" value="1">
                                                <label for="rate1">1</label>

                                                <input type="radio" id="rate2" name="rating" value="2">
                                                <label for="rate2">2</label>

                                                <input type="radio" id="rate3" name="rating" value="3">
                                                <label for="rate3">3</label>

                                                <input type="radio" id="rate4" name="rating" value="4">
                                                <label for="rate4">4</label>

                                                <input type="radio" id="rate5" name="rating" value="5">
                                                <label for="rate5">5</label>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Rate</button>
                                        </form>
                                    </div>

                                    
                                    <div class="d-flex flex-column" style="width:90%;">
                                        <p class="mb-0 opacity-75">{{$review->text}}</p> 
                                        @if($review->review_rate)
                                            <p>Review rate: {{ $review->review_rate }}</p>
                                            <p>Rated by: {{ $review->reviewee->name }}</p>
                                        @else
                                            <p>No review rate yet!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                @endforeach
            </div>
            <hr>
        @endforeach
    </div>
@endif

@endsection