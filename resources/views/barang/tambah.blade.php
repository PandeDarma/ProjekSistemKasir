@extends('templates.home1')

@section('title',"Tambah Barang")

      @section('role')
        @include('templates.admin')
      @endsection

@section('container')
<input type="hidden" name="" id="nav" value="Tambah">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="style-5 text-center">Tambah Barang</h1>
            <form action="/barang" method="post" class="mt-3">
                @csrf
                @method('patch')
                  <div class="form-group">
                    <label for="nama">Nama Barang</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{old('nama')}}" placeholder="buku" autocomplete="off">
                    @error('nama')
                  <small class="text-danger">{{$message}}</small>
                  @enderror
                  </div>
                  <div class="form-group">
                    <label for="barcode">Barcode Barang</label>
                  <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" value="{{old('barcode')}}" placeholder="53423523" autocomplete="off">
                    @error('barcode')
                  <small class="text-danger">{{$message}}</small>
                  @enderror
                  </div>
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori">
                    @foreach ($kategori as $k)
                    <option value="{{$k->id}}" class="text-capitalize">{{$k->nama}}</option>  
                    @endforeach                      
                    </select>
                  </div>
                  <div class="form-row">
                    @foreach ( $lokasi as $l)
                    <div class="col">
                    <label for="{{$l->nama}}" class="text-capitalize">{{$l->nama}}</label>
                    <input type="text" class="form-control  @error($l->nama) is-invalid @enderror" value="{{old($l->nama)}}" id="{{$l->nama}}" name="{{$l->nama}}" placeholder="contoh: 5" autocomplete="off">
                    @error($l->nama)
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                    @endforeach 
                  </div>
                  <div class="form-group mt-2">
                    <label for="harga">Harga Barang</label>
                  <input type="text" class="form-control @error('harga') is-invalid @enderror" value="{{old('harga')}}" id="harga" name="harga" placeholder="50000" autocomplete="off">
                    @error('harga')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-success ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection