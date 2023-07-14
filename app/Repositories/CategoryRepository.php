<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        $perPage = 10;
        $category = Category::with('categories')->paginate($perPage);
        return $category;
    }

    public function getById($id)
    {
        $category = Category::with('categories')->whereId($id)->first();
        return $category;
    }

    public function create($request, $imageName = null)
    {
        $categorySlug = Str::slug($request->category_name, '-'); //convert category name to slug

        $category = Category::create([ //insert record in DB
            'name' => $request->category_name,
            'slug' => $categorySlug,
            'image' => $imageName,
            'status' => Category::STATUS_ACTIVE
        ]);

        foreach ($request->sub_category as $subCategory) {
            $subCategorySlug = Str::slug($subCategory, '-'); //convert sub category name to slug

            SubCategory::create([
                'category_id' => $category->id,
                'name' => $subCategory,
                'slug' => $subCategorySlug
            ]);
        }
        return true;
    }

    public function update($id, $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id)
    {
        $category = Category::whereId($id)->delete();
        if ($category) {
            $category->delete();
            return true;
        }
        return false;
    }
}
?>