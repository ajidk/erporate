<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Pariwisata;
use Illuminate\Http\Request;

use Storage;
use Carbon\Carbon;

class PariwisataController extends Controller
{
    public function index()
    {
        $pariwisata = Pariwisata::orderBy('created_at', 'desc')->get()->map(function($data, $index){
            $data->pariwisata_gambar = url('/img'.'/'.$data->pariwisata_gambar);

            return $data;
        });
        return response()->json([
            'result' => true,
            'message' => 'Data Fetched',
            'data' => $pariwisata
        ]);
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
        $store = Pariwisata::create([
            'pariwisata_nama' => $request->pariwisata_nama,
            'pariwisata_alamat' => $request->pariwisata_alamat,
            'pariwisata_detail' => $request->pariwisata_detail,
            'pariwisata_gambar' => $gambar,
        ]);

        $store->pariwisata_gambar = url('img'.'/'.$store->pariwisata_gambar);

        return response()->json([
            'status' => true,
            'message' => 'Data successfully added',
            'data' => $store
        ]);
    }

    public function show($id)
    {
        $pariwisata = Pariwisata::findOrFail($id);
        $pariwisata->pariwisata_gambar = url('img'.'/'.$pariwisata->pariwisata_gambar);
        return response()->json([
            'status' => true,
            'message' => 'Data Fetched',
            'data' => $pariwisata
        ]);
    }

    public function update(Request $request, $id)
    {
        //
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
