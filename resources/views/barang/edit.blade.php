@extends('templates/home1')

@section('title',"Edit Barang")

{{-- side bar --}}

    @section('role')
       @include('templates.admin')
    @endsection


@section('container')
<input type="hidden" name="" id="nav" value="Daftar Barang">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
       
            <h1 class="style-5 text-center">Edit Barang</h1>
        <form action="/barang/{{$barang->id}}" method="post" class="mt-3">
                @method('put')
                @csrf

                  <div class="form-group">
                    <label for="nama">Nama Barang</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{$barang->nama}}" placeholder="buku">
                    @error('nama')
                  <small class="text-danger">{{$message}}</small>
                  @enderror
                  </div>
                  <div class="form-group">
                    <label for="barcode">Barcode Barang</label>
                  <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" value="{{$barang->barcode}}" placeholder="53423523">
                    @error('barcode')
                  <small class="text-danger">{{$message}}</small>
                  @enderror
                  </div>
                  <div class="form-group">
                    
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori">
                    @foreach ($kategori as $k)
                    @if ($k->id==$barang->kategori_id)                    
                    <option value="{{$k->id}}" class='text-capitalize' selected>{{$k->nama}}</option>  
                    @else
                    <option value="{{$k->id}}" class='text-capitalize' >{{$k->nama}}</option>                          
                    @endif
                    @endforeach                      
                    </select>
                  </div>
                  <div class="form-row">
                    @foreach ( $lokasi as $l)
                    <div class="col">
                    <label for="{{$l->nama}}" class="text-capitalize">Tambah Stock: {{$l->nama}}</label>
                    
                    <input type="text" class="form-control  @error($l->nama) is-invalid @enderror"  id="{{$l->nama}}" name="{{$l->nama}}" placeholder="">
                    @error($l->nama)
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                    @endforeach 
                  </div>
                  <div class="form-group mt-2">
                    <label for="harga">Harga Barang</label>
                  <input type="text" class="form-control @error('harga') is-invalid @enderror" value="{{$barang->harga}}" id="harga" name="harga" placeholder="50000">
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