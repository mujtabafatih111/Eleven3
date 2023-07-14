<?php
namespace App\Repositories;

use App\Models\Review;
use Carbon\Carbon;
use Auth;
use Illuminate\Console\View\Components\TwoColumnDetail;

class ReviewRepository
{
    public function StoreReview($request)
    {
        $user = Auth::user();
   
        $data = [
            'reviewer_id' => $user->id,
            'rating' => $request->rating,
            'review' => $request->review,
            'sub_category_id' => $request->sub_category_id,
        ];
        
        if ($request->has('patient_id')) {
            $data['patient_id'] = $request->patient_id;
        } elseif ($request->has('practitioner_id')) {
            $data['practitioner_id'] = $request->practitioner_id;
        }
        
      
        Review::create($data);
        return true;
    }

    public function practitionerReviewData($request)
    {
        $review = Review::with('user')
            ->where('practitioner_id', $request->practitioner_id)
            ->get();

        return $review;
    }

    public function practitionerRatingData($request)
    {
        $review = Review::where('practitioner_id', $request->practitioner_id)->get();

        // Calculate the average rating
        $averageRating = $review->avg('rating');
        return $averageRating;
    }
    public function practitionerSubCategoryRating($request)
    {

        $review = Review::where('practitioner_id', $request->practitioner_id)->where('sub_category_id', $request->sub_category_id)->get();
        // Calculate the average rating
        $averageRating = $review->avg('rating');
        return $averageRating;
    }

    public function updateReview($request)
    {
        $user = auth()->user();
        $twoMinutesAgo = Carbon::now()->subMinutes(2);
        $checkRecordTime = Review::whereId($request->review_id)
            ->where('created_at', '>=', $twoMinutesAgo)
            ->where('reviewer_id', $user->id)
            ->count();
        if ($checkRecordTime == 1) {
            Review::whereId($request->review_id)->update([
                'rating' => $request->rating,
                'review' => $request->review
            ]);

            return 'Review updated successfully';
        } else {
            return 'The record can only be updated if created at less than 2 minutes ago.';
        }
    }


     // get patient review and rating
    public function patientReviewData($request)
    {
         $user = Auth::user();
      
        if (!$user->hasRole('practitioner')) {
            abort(403, 'Unauthorized');
        }
        $review = Review::with('user')
            ->where('patient_id', $request->patient_id)
            ->get();
        return $review;
    }

    public function patientRatingData($request)
    {
         $user = Auth::user();

        if (!$user->hasRole('practitioner')) {
            abort(403, 'Unauthorized');
        }
        $review = Review::where('patient_id', $request->patient_id)->get();

        // Calculate the average rating
        $averageRating = $review->avg('rating');
        return $averageRating;
    }
}

?>