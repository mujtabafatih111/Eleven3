<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Fake;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FakeController extends Controller
{
  protected $Fake;


    public function __construct(Fake $Fake)
    {
        $this->Fake=$Fake;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->Fake->store();

        return response()->json([
            'status'=>true,
            'message'=>"Data added successfully!",
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
