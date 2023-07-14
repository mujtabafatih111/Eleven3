<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Delete;

class DeleteController extends Controller
{
    protected $Delete;
    public function __construct(Delete $Delete)
    {
        $this->Delete=$Delete;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $delete=$this->Delete->delete($id);
        return response()->json([
            'status'=>true,
            'message'=>'Data delete successfully!',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
