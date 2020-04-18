@extends('templates\home1')

@section('title',"Laporan Transaksi")


@section('container')

<input type="hidden" name="" id="nav" value="Laporan">
<div class="container">
    <div class="row ">
        <div class="col-md-12 ">
          
            @if (session('flash'))
            <div class="alert alert-success" role="alert">
                {{session('flash')}}
              </div>                    
            @endif
            <h1 class="style-3">Laporan Transaksi</h1>
        <div class="row justify-content-end">
               
                <div class="col-lg-6 col-md-12 ">
                    <form action="{{url('/owner/laporan')}}" method="get">
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
                        <th scope="col">Tanggal</th>
                        <th scope="col">Id Nota</th>
                        <th scope="col">Total</th>
                        <th scope="col">Detail Transaksi</th>
                    </tr>
                </thead>
              
                <tbody>
                    @if ($transaksi->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        Data Tidak Ditemukan
                      </div>  
                    @endif
                    @foreach ($transaksi as $t)
                    <tr>
                
                    <td > {{$t->date}}</td>
                    <td scope="row"> {{$t->id}}</td>
                    <td>{{$t->total}}</td>
                    <td> 
                    <form action="{{url('/owner/laporan\/').$t->id}}">
                      <button type="submit" class="btn btn-success py-1 role-id"  >
                        Detail
                    </button>
                  </form></td>                
                    </tr>
              @endforeach
                </tbody>
                
            </table>           

            {{$transaksi->links()}}
        </div>
        </div>
        
    </div>
</div>


@endsection