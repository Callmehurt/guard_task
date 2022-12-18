<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index(){
        $sellers = User::all();
        return view('admin.sellerManagement', compact('sellers'));
    }

    public function createSeller(Request $request){
        $name = $request->name;
        $address = $request->address;
        $email = $request->email;
        $password = Hash::make('password');

        User::create([
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'password' => $password,
        ]);

        return redirect()->back()->with('success', 'Created successfully');
    }

    public function edit($id){
        $seller = User::find($id);
        if(!$seller){
            return redirect()->back()->with('error', 'Record not found');
        }
        return view('admin.edit', compact('seller'));
    }

    public function delete($id){
        $seller = User::find($id);

        if(!$seller){
            return redirect()->back()->with('error', 'Record not found');
        }

        $seller->delete();

        return redirect()->back()->with('success', 'Deleted successfully');

    }

    public function update(Request $request, $id){

        $name = $request->name;
        $address = $request->address;
        $email = $request->email;
        $status = $request->status;

        User::where('id', $id)->update([
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'status' => $status,
        ]);
        return redirect()->route('admin.seller')->with('success', 'updated successfully');
    }

    public function updateStatus($id){
        $seller = User::find($id);
        $seller->is_active = !$seller->is_active;
        $seller->save();
        return redirect()->back()->with('success', 'Status successfully');
    }

    public function downloadDoc($id){
        $user = User::find($id);
        $file = public_path().$user->document;
        return response()->download($file);
    }
}
