@extends('templates.home1')

@section('title',"Barang")


@section('container')
<input type="hidden" name="" id="nav" value="Daftar Barang">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 ">
              
                @if (session('flash'))
                <div class="alert alert-success" role="alert">
                    {{session('flash')}}
                  </div>                    
                @endif
                <h1 class="style-3">Daftar Barang</h1>
            <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                            <a href="{{url('/barang/tambah')}}" class="btn btn-success mt-3">Tambah Barang</a>
                     </div>
                    <div class="col-lg-6 col-md-12 mr-auto">
                        <form action="{{url('/barang')}}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" autocomplete="off" aria-label="Dollar amount (with dot and two decimal places)">
                            <div class="input-group-append">
                             <button type="submit"class="btn btn-primary">Cari</button>
                            </div>
                          </div>
                        </form>
                    </div>
            </div>
            <div class="table-responsive table-sm">
                <table class="table table-hover mt-1">
                    <thead class="thead-light">
                        <tr>
                         
                            <th scope="col">Nama</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            @foreach ($lokasi as $l)
                        <th scope="col" class="text-capitalize">Stock {{$l->nama}}</th>
                            @endforeach
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                  
                    <tbody>
                        @if ($barang->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            Data Tidak Ditemukan
                          </div>  
                        @endif
                        @foreach ($barang as $b)
                       
                        <tr>                                                    
                        <td scope="row">{{$b->nama}}</td>  
                            <td class="text-capitalize">
                                 @if (!$b->kategorinama)
                                    {{$b->kategori->nama}}                           
                                        
                                    @else
                                        {{$b->kategorinama}}
                        
                                @endif
                        </td>                            
                        <td>{{$b->harga}}</td> 
                        @foreach ($lokasi as $l)
                            <td>
                                @foreach ($stock as $s)
                                    @if ($b->barcode==$s->barcode&&$l->id==$s->lokasi_id)
                                        {{$s->stock}}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach                       
                        <td> 
                            <form action="barang/{{$b->id}}" method="post" class="d-inline">
                                @method("delete")
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin?')">Delete</button>
                             </form>
                            <a href="barang/{{$b->id}}/edit" class='btn btn-warning'>Edit</a>
                           
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                {{-- {{$barang->links()}} --}}
            </div>
            </div>
            
        </div>
    </div>
    
@endsection

