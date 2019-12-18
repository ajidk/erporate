@extends('layouts.layout')

@section('content')
<div class="container text-center">
    <div class="d-inline">
        <h1 class="text-center mx-auto">Pariwisata</h1>

        <a href="{{ url('/basic/create') }}" class="btn btn-primary">
            Add New
        </a>
    </div>
    <hr />

    <div id="content" class="row">
        @foreach($pariwisata as $item)
        <div class="col-12 col-md-4">
            <div class="card mb-2">
                <img src="{{ asset('img'.'/'.$item->pariwisata_gambar) }}" height="350px" class="card-img-top">
                <div class="card-body">
                    <h1 class="card-title">{{ $item->pariwisata_nama }}</h1>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-primary w-100" href="{{ url('basic/'.$item->id.'/edit') }}">Edit</a>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-danger w-100" href="#">delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
