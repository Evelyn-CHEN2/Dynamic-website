@extends('layouts.master') 

@section('title') 
    Review_create form
@endsection

@section('content')
<div class="col-md-9 col-lg-10 mx-auto bg-body-tertiary" style="margin-top:70px;">
    <div class="col-md-8 col-lg-9 mx-auto">   
        <form class="needs-validation" method="POST" action="{{route('review.store')}}" novalidate> 
        @csrf
            <!-- pass reviewer_id, reviewee_id and assessment_id to review.store -->
            <input type="hidden" name="reviewer_id" value="{{$reviewer->id}}">
            <strong>Hi: {{$reviewer->name}},</strong>
            <input type="hidden" name="reviewee_id" value="{{$reviewee->id}}">
            <p>you are reviewing for: <strong>{{$reviewee->name}}</strong></p>
            <input type="hidden" name="assessment_id" value="{{$assessment_id}}">
            <label for="review_text" class="form-label">Write your review here:</label>
            <textarea type="text" class="form-control" id="review_text" name="text" rows="10" cols="50" required></textarea>
            <div class="invalid-feedback">
                Review text is required.
            </div>
            <div class="col-md-10 col-lg-11 mr-auto d-flex justify-content-end"> 
                <button type="submit" class="btn btn-outline-secondary">Submit</button>
            </div>  
        </form>
    </div> 
</div>

@endsection