@extends('templates.home1')

@section('title',"Tambah Barang")

@section('container')

<div class="container">
    <h1 class="style-4 my-3">Profile</h1>
    <div class="row">
        <div class="col-6">
    @if (session('flash'))
        <div class="alert alert-success" role="alert">
            {{session('flash')}}
          </div>                    
        @endif
    </div>
    </div>
    <div class="row">
        
        <div class="col-2 mt-4">
        <img src="{{asset('assets/foto/'.Auth::user()->img)}}" alt="" class="img-thumbnail h-100">
        </div>
        <div class="col-4 mt-4">
        <form action="{{url('profile/'.Auth::user()->id.'/edit')}}" method="post" enctype="multipart/form-data" >
            @csrf
                <div class="form-row mb-3">
                    <div class="col">
                        <input class="form-control" type="text" name="first_name" id="first_name" value="{{Auth::user()->name}}">
                    </div>
                
                </div>
                <div class="form-group">
                <input type="email" name="email" class="form-control" readonly value="{{Auth::user()->email}}">
                </div>
                <div class="form-group">
                    <input class="form-control" type="file" name="foto" id="foto">
                </div>
                <button class="btn btn-success" type="submit">Simpan</button>
            </form>
        </div>
    </div>

    {{-- <div class="row">

        <div class="col">
            <h3 class="stlye-5">Biodata</h3>
                <div class="row">
                    <div class="col-4">
                        <ul class="list-group ">
                            <li class="list-group-item borderless ">Nama</li>
                            <li class="list-group-item borderless">NIM</li>
                            <li class="list-group-item borderless">Prodi</li>                   
                          </ul>
                    </div>
                    <div class="col-8">
                        <ul class="list-group">
                            <li class="list-group-item borderless ">A.A Adi Rama Anggrapana</li>
                            <li class="list-group-item borderless">1815051022</li>
                            <li class="list-group-item borderless" >Pendidikan Teknik Informatika</li>                   
                          </ul>
                    </div>
                </div>
        </div>

    </div>
            <div class="row mt-5">
        </div>
        <div class="col">
            <h3 class="stlye-5">Studi Kasus</h3>
            <div class="row">
                <div class="col-4">
                    <ul class="list-group ">
                        <li class="list-group-item borderless ">Judul</li>
                        <li class="list-group-item borderless">Keterangan</li>
                                        
                      </ul>
                </div>
                <div class="col-8">
                    <ul class="list-group">
                        <li class="list-group-item borderless ">Sistem Kasir</li>
                        <li class="list-group-item borderless">Transaksi yang awalnya ditulis menjadi automatis tersimpan pada sistem dan pendataan barang yang lebih efisien</li>
                                     
                      </ul>
                </div>
            </div>
        </div>
    </div>
    </div> --}}
</div>
    
@endsection