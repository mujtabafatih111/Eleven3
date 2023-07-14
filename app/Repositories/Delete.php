<?php
namespace App\Repositories;

use App\Models\Category;

class Delete{

    public function delete($id){
        Category::find($id)->delete($id);
    }
}
