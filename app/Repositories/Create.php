<?php
namespace App\Repositories;

use App\Models\Category;

class Create{

public function store($request){

    $categ=new Category();
    $categ->name="tke";
    $categ->slug="dfdsfsd";
    $categ->status="1";
    $categ->save();


}


function delete($id){
    $dele=Category::find($id);
    $dele->delete();

}
}

?>
