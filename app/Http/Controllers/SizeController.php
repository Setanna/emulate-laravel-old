<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\SizeResource;
use App\Http\Resources\TypeResource;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SizeResource::collection(Type::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeRequest $request)
    {
        $size = Size::create($request->all());

        return new SizeResource($size);
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return new SizeResource($size);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $size->update($request->all());

        return new SizeResource($size);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();

        return response()->json(["Size deleted"]);
    }
}
