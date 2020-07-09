<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Products::paginate(10);

        if($request->id_category) {
            $products = $products->where('id_category', $request->id_category);
        }


        return response()->json($products, 200);
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
            'unit_price' => 'required',
            'image' => 'required',
            'stock' => 'required'
        ],
        [
            'name.required'=>'Chưa nhập tên danh mục!',
            'description.required'=>'Chưa nhập thông tin danh mục!',
            'unit_price.required'=>'Chưa nhập thông tin giá tiền!',
            'image.required'=>'Chưa chỉ định hình ảnh!',
            'stock.required'=>'Chưa nhập thông tin tồn kho!',
        ]);

        $product = new Products();
        $product->name = $request->name;
        $product->id_category = $request->id_category;
        $product->unit_price = $request->unit_price;
        $product->discount_price = $request->discount_price?$request->discount_price:null;
        $product->hot = $request->hot;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->stock = $request->stock;
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);

        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product = Products::find($id);

        return response()->json($product, 200);
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
            'unit_price' => 'required',
            'image' => 'required',
            'stock' => 'required'
        ],
        [
            'name.required'=>'Chưa nhập tên danh mục!',
            'description.required'=>'Chưa nhập thông tin danh mục!',
            'unit_price.required'=>'Chưa nhập thông tin giá tiền!',
            'image.required'=>'Chưa chỉ định hình ảnh!',
            'stock.required'=>'Chưa nhập thông tin tồn kho!',
        ]);

        $product = Products::find($id);
        $product->name = $request->name;
        $product->id_category = $request->id_category;
        $product->unit_price = $request->unit_price;
        $product->discount_price = $request->discount_price?$request->discount_price:null;
        $product->hot = $request->hot;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->stock = $request->stock;
        $product->update();

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showDiscount()
    {
        $products = Products::whereNotNull('discount_price')->get();

        return response()->json($products, 200);
    }

    public function showHot()
    {
        $products = Products::where('hot',1)->get();

        return response()->json($products, 200);
    }

    public function showNew()
    {
        $products = Products::orderBy('created_at','desc')->take(10)->get();

        return response()->json($products, 200);
    }
    
}
