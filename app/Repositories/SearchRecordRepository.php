<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\User;

class SearchRecordRepository
{
    public function search($request)
    {
        $perPage = 10;
        $holisticPractitioner = User::with('categories')
            ->where('first_name', 'LIKE', '%' . $request->input('first_name') . '%')
            ->orWhere('last_name', 'LIKE', '%' . $request->input('last_name') . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->input('phone') . '%')
            ->orWhere('email', 'LIKE', '%' . $request->input('email') . '%')
            ->role('practitioner')
            ->paginate($perPage);

            return $holisticPractitioner;
    }

    public function categoryList()
    {
        $categories = Category::select('id','name')->get();
        
        return $categories;
    }


    public function Practitionersearch($request)
    {
        $locationName = $request->location;
        $category = $request->message; 

        $users = User::whereHas('city', function ($query) use ($locationName) {
            $query->where('name', $locationName);
        })
        ->whereHas('category', function ($query) use ($category) {
            $query->where('name', $category);
        })->get();

        return $users;
    }
   
}

?>