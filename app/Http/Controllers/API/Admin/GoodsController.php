<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\GoodsResource;
use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goods = Goods::latest()->paginate(10);

        return new GoodsResource(true, 'get all goods', $goods);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        if  ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $goods = Goods::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return new GoodsResource(true, 'create goods success', $goods);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $goods = Goods::find($id);

        return new GoodsResource(true, 'show goods success', $goods);
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
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        if  ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $goods = Goods::find($id);
        $goods->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return new GoodsResource(true, 'update goods success', $goods);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $goods = Goods::find($id);
        $goods->delete();

        return new GoodsResource(true, 'delete goods success', $goods);
    }
}
