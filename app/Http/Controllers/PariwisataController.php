<?php

namespace App\Http\Controllers;

use App\Pariwisata;
use Illuminate\Http\Request;

use Storage;
use Carbon\Carbon;

class PariwisataController extends Controller
{
    public function index()
    {
        $pariwisata = Pariwisata::orderBy('created_at', 'desc')->get();
        dd($pariwisata);
        return view('index', compact('pariwisata'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pariwisata_nama' => ['required', 'string'],
            'pariwisata_alamat' => ['required', 'string'],
            'pariwisata_detail' => ['required', 'string'],
            'pariwisata_gambar' => ['required', 'mimes:jpg,jpeg,png'],
        ]);

        $gambar = $this->imageUpload($request);
        dd($gambar);
        $store = Pariwisata::create([
            'pariwisata_nama' => $request->pariwisata_nama,
            'pariwisata_alamat' => $request->pariwisata_alamat,
            'pariwisata_detail' => $request->pariwisata_detail,
            'pariwisata_gambar' => $gambar,
        ]);

        return redirect('/basic');
    }

    public function show($id)
    {
        // 
    }

    public function edit(Pariwisata $pariwisata)
    {
        return view('edit', compact('pariwisata'));
    }

    public function update(Request $request, Pariwisata $pariwisata)
    {
        $request->validate([
            'pariwisata_nama' => ['required', 'string'],
            'pariwisata_alamat' => ['required', 'string'],
            'pariwisata_detail' => ['required', 'string'],
            'pariwisata_gambar' => ['required', 'mimes:jpg,jpeg,png'],
        ]);
        $gambar = $this->imageUpload($request);
        $store = Pariwisata::create([
            'pariwisata_nama' => $request->pariwisata_nama,
            'pariwisata_alamat' => $request->pariwisata_alamat,
            'pariwisata_detail' => $request->pariwisata_detail,
            'pariwisata_gambar' => $gambar,
        ]);

        return redirect()->url('/basic');
    }

    public function destroy($id)
    {
        //
    }

    private function imageUpload($request, $location = 'img')
    {
        $uploadedFile = $request->file('pariwisata_gambar');        
        $filename = strtolower(str_replace(' ', '_', $request->pariwisata_nama)).'-'.(Carbon::now()->timestamp+rand(1,1000));
        $path = $uploadedFile->storeAs($location, $filename.'.'.$uploadedFile->getClientOriginalExtension());
        
        return $filename.'.'.$uploadedFile->getClientOriginalExtension();
    }
}
