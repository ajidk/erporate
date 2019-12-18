@extends('layouts.layout')

@section('content')
{{dd($pariwisata)}};
    <form action="{{ url('basic/'.$pariwisata->id.'/update') }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama :</strong>
                    <input type="text" name="pariwisata_nama" value="{{$pariwisata->pariwisata_nama}}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Alamat :</strong>
                    <input type="text" name="pariwisata_alamat" value="{{$pariwisata->pariwisata_alamat}}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail :</strong>
                    <textarea name="pariwisata_detail" style="height:150px" class="form-control" placeholder="detail">{{$pariwisata->pariwisata_detail}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>        
    </form>
@endsection
