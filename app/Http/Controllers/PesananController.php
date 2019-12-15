<?php


namespace App\Http\Controllers;

use App\Pesanan;
use Illuminate\Http\Request;
use Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_pesanan = $request->id_pesanan;
        $pesanan = Pesanan::where('id_pesanan','=',$id_pesanan);
        return view('payment',['pesanan'=>$pesanan]);


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
    }

    public function confirmation(Request $request){

            $pesanan = new Pesanan();
            $pesanan->id_pesanan = request('id_pesanan');
            $pesanan->nama_homestay = request('nama_homestay');
            $pesanan->tanggal_masuk = request('tanggal_masuk');
            $pesanan->tanggal_keluar = request('tanggal_keluar');
            $pesanan->pembayaran = 'Midtrans';
            $pesanan->status_pembayaran = false;
            $pesanan->total_harga = request('total_harga');
            $pesanan->wisatawan_id = Auth::user()->id_wisatawan;
            $pesanan->save();
            //$id_pesanan = $request->id_pesanan;
            $tpesanan = Pesanan::where('id_pesanan','=',$pesanan->id_pesanan);
            return view('payment',['pesanan'=>$pesanan,'harga_homestay' => $pesanan->total_harga]);
           // dd($tpesanan);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
