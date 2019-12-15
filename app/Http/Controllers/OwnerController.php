<?php

namespace App\Http\Controllers;

use App\Owner;
use Illuminate\Http\Request;
use Auth;

class OwnerController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
   //     $this->middleware('auth:owner');
   // }

    public function showLoginForm(){
        return view('login_owner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = request()->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:owners,email_owner',
            'password'=>'required|min:6|required_with:repeat_password|same:repeat_password',
            'repeat_password'=>'min:6|required'
        ]);

        $request['password'] = bcrypt($request->password);
        $owner = new Owner();
        $owner->id_owner = request('id_owner');
        $owner->email_owner = request('email');
        $owner->nama_depan_owner = request('nama_depan');
        $owner->nama_belakang_owner = request('nama_belakang');
        $owner->password = request('password');
        $owner->save();

        return view('signup_homestay')->with('id_owner',$owner->id_owner);
    }

    public function login(Request $request)
    {

        if (Auth::guard('owner')->attempt(['email_owner' => $request->email, 'password_wisatawan' => $request->password ])) {
            return redirect()->intended('/');
        } else {
            return redirect('login_pemilik')->with('status','Password atau email anda salah!');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }
}
