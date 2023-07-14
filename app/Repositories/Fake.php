<?php
namespace App\Repositories;

use App\Models\Category;

class Fake{

public function store(){

    $cate=new Category();
    $cate->name='add new record';
    $cate->slug='add new record';
    $cate->status=0;
    $cate->save();

}
}

