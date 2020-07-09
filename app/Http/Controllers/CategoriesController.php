<?php

namespace App\Http\Controllers;
use App\Categories;
use App\Products;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        return $categories->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ],
        [
            'name.required'=>'Chưa nhập tên danh mục!',
            'description.required'=>'Chưa nhập thông tin danh mục!',
            'image.required'=>'Chưa chỉ định hình ảnh!'
        ]);

        $category = new Categories();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->save();

        return response()->json('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::with('Products')->find($id);

        $products = $category->products;

        return $products->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Categories::find($id);

        return $categories->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ],
        [
            'name.required'=>'Chưa nhập tên danh mục!',
            'description.required'=>'Chưa nhập thông tin danh mục!',
            'image.required'=>'Chưa chỉ định hình ảnh!'
        ]);

        $category = Categories::find($id);
        $category->name = $request->name?$request->name:$category->name;
        $category->description = $request->description?$request->description:$category->description;
        $category->image = $request->image?$request->image:$category->image;
        $category->update();

        
        return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->isActived = 0;
        $category->update();

        return response()->json('Deactived success!');
    }

    public function changeStatus($id)
    {
        $category = Categories::find($id);
        $category->isActived = $category->isActived?0:1;
        $category->update();

        return response()->json("Status change success!");
    }
}
