<?php
namespace App\Repositories;

use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class CommonRepository
{
    public function storeTestimonial($request)
    {
        $user = Auth::user();
        $count = Review::where('reviewer_id', $user->id)->count();
        if ($count < 1) {

            $data = [
                'reviewer_id' => $user->id,
                'rating' => $request['rating'],
                'review' => $request['review'],
                'admin_id' => 1,
            ];

            if (!$user->hasRole('practitioner')) {
                $data['practitioner_id'] = $user->id;
            }
            if (!$user->hasRole('patient')) {
                $data['patient_id'] = $user->id;
            }
            $review = Review::create($data);
            return $review;
        } else {
            return 'You have already Given a Feedback.Thanks';
        }

    }

    public function getTestimonial()
    {
        $testimonial = Review::whereNotNull('admin_id')->get();
        return $testimonial;
    }
    public function updateProfile($request)
    {
        $user = auth()->user();
        $user = User::find($user->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->update;
        return $user;
    }
    public function updateProfilePhoto($request)
    {
        $user = auth()->user();
        $user = User::find($user->id);
      
        // Retrieve the uploaded file
        $image = $request->file('image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->putFileAs('images', $image, $filename);
        $url = Storage::disk('public')->url($path);
        $user->picture = $url;
        $user->update;
        return $user;
    }

}

?>