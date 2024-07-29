<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#import model
use App\Models\Customer;


class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::paginate(10);
        return view('backend.content.customer.list',compact('customer'));
    }

    public function create(){
        return view('backend.content.customer.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'member_id' => 'required',
            'name' => 'required',
            'dob' => 'required',
        ]);

        $customer = new Customer();
        $customer->member_id = $request->member_id;
        $customer->name = $request->name;
        $customer->dob = $request->dob;

        try {
            $customer->save();
            return redirect(route('customer.index'))->with('msg', ['success','Berhasil tambah customer']);
        }catch (\Exception $e){
            return redirect(route('customer.index'))->with('msg', ['danger','Gagal tambah customer']);
        }
    }

    public function destroy($id){
        $customer = Customer::findOrFail($id);

        try {
            $customer->delete();
            return redirect(route('customer.index'))->with('msg', ['success','Berhasil hapus customer']);
        }catch (\Exception $e){
            return redirect(route('customer.index'))->with('msg', ['danger','Gagal hapus customer']);
        }
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        return view('backend.content.customer.edit', compact('customer'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'dob' => 'required',
        ]);

        $customer = Customer::findOrFail($request->id);
        $customer->name = $request->name;
        $customer->dob = $request->dob;

        try {
            $customer->save();
            return redirect(route('customer.index'))->with('msg', ['success','Berhasil ubah customer']);
        }catch (\Exception $e){
            return redirect(route('customer.index'))->with('msg', ['danger','Gagal ubah customer']);
        }
    }
}
