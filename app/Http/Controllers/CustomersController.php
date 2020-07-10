<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::all();

        return response()->json($customers, 200);
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
        //
        $this->validate($request,
        [
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ],
        [
            'name.required'=>'Chưa nhập tên khách hàng!',
            'address.required'=>'Chưa nhập địa chỉ nhận hàng!',
            'phone_number.required'=>'Chưa nhập số điện thoại liên lạc!'
        ]);

        $customer = new Customers();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->gender = $request->gender?$request->gender:'3';
        $customer->email = $request->email?$request->email:null;
        $customer->note = $request->note?$request->note:null;
        $customer->save();

        return response()->json($customer, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customers::findOrFail($id);

        return response()->json($customer, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customers::findOrFail($id);

        return response()->json($customer, 200);
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
            'address' => 'required',
            'phone_number' => 'required'
        ],
        [
            'name.required'=>'Chưa nhập tên khách hàng!',
            'address.required'=>'Chưa nhập địa chỉ nhận hàng!',
            'phone_number.required'=>'Chưa nhập số điện thoại liên lạc!'
        ]);

        $customer = Customers::findOrFail($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->gender = $request->gender?$request->gender:'3';
        $customer->email = $request->email?$request->email:null;
        $customer->note = $request->note?$request->note:null;
        $customer->update();

        return response()->json($customer, 200);
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
}
