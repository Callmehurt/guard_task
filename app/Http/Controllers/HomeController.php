<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function registerSeller(Request $request){
        dd('ok');
    }

    public function uploadDoc(Request $request){
        $file = $request->file('document');
        $filename = time().'_'.$file->getClientOriginalName();
        $destinationPath = 'uploads';
        $file->move($destinationPath,$filename);
        // $url = URL::asset('uploads/'.$filename);

        $seller = User::find(Auth::guard('web')->id());
        $seller->document = '/uploads/'.$filename;
        $seller->save();
        return redirect()->back()->with('success', 'Doc uploaded successfully');
    }

    public function logoutSeller(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
