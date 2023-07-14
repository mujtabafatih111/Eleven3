<?php
namespace App\Repositories;

use App\Models\Category;

class Read{

    public function create(){
        $categ=new Category();
        $categ->name="tke this ssd";
        $categ->slug="dfdsfsd full calling";
        $categ->status="1";
        $categ->save();

    }
}
