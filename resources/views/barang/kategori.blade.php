@extends('templates.home1')

@section('title','Tambah Kategori')

    @section('role')
       @include('templates.admin')
    @endsection

@section('container')
<input type="hidden" name="" id="nav" value="Tambah">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="style-5 text-center">Tambah Kategori</h1>

            <form action="/barang/kategori" method="post" class="mt-4">

                @csrf
                
                <div class="form-group text-center">
                  <input type="text" class="form-control @error('nama')is-invalid @enderror" id="nama" name="nama" placeholder="jika bisa menggunakan huruf kecil" autocomplete="off">
                  @error('nama')
                <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>    
            </div>
        </form>
        </div>
    </div>
</div>
    
@endsection