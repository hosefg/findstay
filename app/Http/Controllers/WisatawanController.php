<?php

namespace App\Http\Controllers;

use App\Wisatawan;
use Illuminate\Http\Request;
use Auth;

class WisatawanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('login_traveler');
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
            'email' => 'required|email|unique:wisatawans,email_wisatawan',
            'password'=>'required|min:6|required_with:repeat_password|same:repeat_password',
            'repeat_password'=>'min:6|required'
        ]);

        $request['password'] = bcrypt($request->password);
        $wisatawan = new Wisatawan();
        $wisatawan->id_wisatawan = request('id_wisatawan');
        $wisatawan->email_wisatawan = request('email');
        $wisatawan->nama_depan_wisatawan = request('nama_depan');
        $wisatawan->nama_belakang_wisatawan = request('nama_belakang');
        $wisatawan->password_wisatawan= request('password');
        $wisatawan->save();

        return redirect('login_traveler')->with('status','Anda berhasil terdaftar sebagai wisatawan');
    }

    public function login(Request $request)
    {
        $data = request()->validate([
            'email_wisatawan' => 'required|email',
            'password_wisatawan'=>'required|min:6',
        ]);

        //$credentials = $request->only('email_wisatawan', 'password_wisatawan');
        if (Auth::attempt(['email_wisatawan' => $request->email_wisatawan, 'password_wisatawan' => $request->password_wisatawan])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return redirect('login_traveler')->with('status','Password atau email anda salah!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wisatawan  $wisatawan
     * @return \Illuminate\Http\Response
     */
    public function show(Wisatawan $wisatawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wisatawan  $wisatawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Wisatawan $wisatawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wisatawan  $wisatawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wisatawan $wisatawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wisatawan  $wisatawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wisatawan $wisatawan)
    {
        //
    }
}
