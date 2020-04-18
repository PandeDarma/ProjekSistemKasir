@extends('templates.home1')


@section('title',"Detail Transaksi")

@section('container')
<input type="hidden" name="" id="nav" value="Laporan">
<div class="row ml-5">
    <div class="col-3">
    <a href="{{url('/owner/laporan')}}" class="badge badge-primary p-2">{{"< "}}Back</a>
    </div>
</div>
<div class="container">
   
    <div class="row ">
        <div class="col ">
          
     
            <h1 class="style-3">Detail Transaksi</h1>
 
        <div class="table-responsive table-sm">
            <table class="table table-hover mt-1">
                <thead class="thead-light">
                    <tr>                     
                        <th scope="col">Nama</th>
                        <th scope="col">Kuantiti</th>
                        <th scope="col">Harga</th>
                     
                    </tr>
                </thead>
                        @foreach ($detail as $d)
                            <tr>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->kuantiti}}</td>
                            <td>{{$d->harga}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                       
                            <td></td>
                            <td class="text-success">TOTAL</td>
                        <td class="text-success">{{$transaksi}}</td>
                        
                        </tr>
                <tbody>
                  
                </tbody>
                
            </table>           

         
        </div>
        </div>
        
    </div>
</div>
@endsection