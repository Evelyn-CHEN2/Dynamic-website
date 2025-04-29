<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use App\Models\Assessment;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $reviewer = Auth::user();
        $reviewer_id = $reviewer->id;
        $reviewee_id = $request->input('student_id');
        $reviewee = User::find($reviewee_id);
        $assessment_id = $request->input('assessment_id');
        //check if the review already exists for the top reviewer and reviewee within the same assessment
        $exist_review = Review::where('reviewer_id', $reviewer_id)
                              ->where('reviewee_id', $reviewee_id)
                              ->where('assessment_id', $assessment_id)
                              ->exists();
        if ($exist_review) {
            //if there's already a review from the user and the reviewee, go back the assessment page with alert message
            return redirect()->back()->with('review-alert', 'You have already reviewed this student for this assessment, please choose another student!');
        }
        if ($reviewee_id == $reviewer_id){
            //check if the user is choosing own's name
            return redirect()->back()->with('review-alert', 'Your can not review for yourself!');
        }
        return view('review_create_form')->with('reviewer', $reviewer)->with('reviewee', $reviewee)->with('assessment_id', $assessment_id);
    }

    public function store(Request $request)
    {
        // validate the text of review to be more than 5 words
        $validate = $request->validate([
            'text' => 'required|string|min:5',
        ]);
        // create a new review with value that are passed by the review_form
        $review = new Review();
        $review->text = $request->text;
        $review->reviewer_id = $request->reviewer_id;
        $review->reviewee_id = $request->reviewee_id;
        $review->assessment_id = $request->assessment_id;
        $review->save();
        return redirect()->route('assessment.show', $review->assessment_id)->with('review-success', 'Review created sucessfully!');
    }

    public function update(Request $request, string $id)
    {
        // validate the number of review_rate to be 1 to 5
        $validate = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviewee_id' => 'required|exists:users,id',
        ]);
        $review = Review::find($id);
        //check if the user is the reviewee
        $user = Auth::user();
        $user_id = $user->id;
        if($user_id == $request->input('reviewee_id')){ //only the reviewee of this review can rate for this review
            $review = Review::find($id);
            $review->review_rate = $request->input('rating');
            $review->save();
            // update avg_rate for the reviewer of the specific review every time a new 'rating' is submitted
            $reviewer = User::find($review->reviewer_id); //retrieve the user who wrote this review
            $reviews = $reviewer->reviews;
            $filteredReviews = $reviews->filter(function ($review) {
                return $review->review_rate != null; //only retrieve the review who's review_rate is not null
            });
            $sum_review_rate = $filteredReviews->sum('review_rate');
            $total_number_rate = $filteredReviews->count();
            $avg_rate = $total_number_rate >0 ? $sum_review_rate/$total_number_rate : 0;
            $reviewer->avg_rate = $avg_rate;
            $reviewer->save();
            return redirect()->back()->with('rate-success', 'Your review rate is submitted successfully!');
        }
        return redirect()->back()->with('rate-error', 'You can not rate for this review!');
    }
}
