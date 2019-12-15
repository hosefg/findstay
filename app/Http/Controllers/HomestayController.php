<?php

namespace App\Http\Controllers;

use App\Homestay;
use Illuminate\Http\Request;
use Auth;

class HomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('owner')->check()){
        $id_owner = Auth('owner')->user()->id_owner;
        }
        $homestay = Homestay::where('owner_id','=',$id_owner)->get();
        return view('homestay',['homestay' => $homestay]);
    }

    public function showSignUpForm(){
        return view('/signup_homestay');
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
            'nama_homestay' => 'required',
            'harga_homestay' => 'required',
            'deskripsi_homestay' => 'required',
            'foto_homestay'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'alamat_homestay'=>'required'
        ]);

        if ($request->hasFile('foto_homestay')){

			$file = $request->file('foto_homestay');
			$nama_file = $file->getClientOriginalName();
            $file->move('images',$nama_file);
        }
        $homestay = new Homestay();
        $homestay->id_homestay = request('id_homestay');
        $homestay->owner_id = request('id_owner');
        $homestay->nama_homestay = request('nama_homestay');
        $homestay->harga_homestay = request('harga_homestay');
        $homestay->deskripsi_homestay = request('deskripsi_homestay');
        $homestay->foto_homestay = '/images/'. $file->getClientOriginalName();
        $homestay->alamat_homestay = request('alamat_homestay');
        $homestay->latitude_homestay = request('latitude');
        $homestay->longitude_homestay = request('longitude');
        $homestay->save();
        if(Auth::guard('owner')->check()){
            return redirect('homestay');
        } else {
        return redirect('login_pemilik')->with('status','Anda berhasil terdaftar sebagai pemilik homestay');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function show(Homestay $homestay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function edit(Homestay $homestay)
    {
        $id_owner = Auth('owner')->user()->id_owner;
        return view('edit_homestay',['homestay' => $homestay, 'id_owner' => $id_owner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homestay $homestay)
    {
        if ($request->hasFile('foto_homestay')){

			$file = $request->file('foto_homestay');
			$nama_file = $file->getClientOriginalName();
            $file->move('images',$nama_file);
        }
        Homestay::where('id_homestay',$homestay->id_homestay)
                    ->update([
                        'nama_homestay' => $request->nama_homestay,
                        'harga_homestay' => $request->harga_homestay,
                        'deskripsi_homestay' => $request->deskripsi_homestay,
                        'foto_homestay' => '/images/'.$file->getClientOriginalName(),
                        'alamat_homestay' => $request->alamat_homestay,
                        'latitude_homestay' => $request->latitude,
                        'longitude_homestay' => $request->longitude

                    ]);
         return redirect('homestay');
    }

    public function search(Request $request){

        $search = $request->search;
        $homestay = Homestay::where('nama_homestay','like',"%".$search."%")->get();
        return view('homestay',['homestay'=> $homestay]);

    }

    public function showHomestay(Homestay $homestay){
        return view('homestay_single',['homestay'=>$homestay]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homestay $homestay)
    {
        Homestay::destroy($homestay->id_homestay);
        return redirect('/homestay')->with('status','Homestay berhasil dihapus!');
    }
}
