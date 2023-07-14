<?php
namespace App\Repositories;

use App\Models\Category;

class Show{

    public function show(){
        $category=Category::get();

    }
}

