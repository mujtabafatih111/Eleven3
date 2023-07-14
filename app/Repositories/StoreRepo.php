<?php

namespace App\Repositories;

use App\Models\Category;

Class StoreRepo{

    public function add($request){
        $categ=new Category();
        $categ->name="tke";
        $categ->slug="dfdsfsd";
        $categ->status="1";
        $categ->save();


    }


    public function del($id){
        $delete=Category::find($id);
        $delete->delete();
    }
}

