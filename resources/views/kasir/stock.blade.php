@extends('templates/home1')

@section('title',"Stock")


    @section('role')
       @include('templates.admin')
    @endsection



    
@section('container')

<input type="hidden" name="" id="nav" value="Stock">
<div class="container">
    <div class="row ">
        <div class="col-md-12 ">
                   
            <h1 class="style-3">Stock Barang</h1>
        <div class="row justify-content-end">
       
                <div class="col-lg-6 col-md-12 ">
                    <form action="{{url('/stock')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" autocomplete="off">
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
                        @if ($l->nama=='showcase')
                            <td class="text-success text-center">  
                                @else
                                <td>
                        @endif
                            
                                @foreach ($stock as $s)
                                    @if ($b->barcode==$s->barcode&&$l->id==$s->lokasi_id)
                                        {{$s->stock}}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach                       
                    @endforeach
                </tbody>
                
            </table>
            {{$barang->links()}}
        </div>
        </div>
        
    </div>
</div>
@endsection