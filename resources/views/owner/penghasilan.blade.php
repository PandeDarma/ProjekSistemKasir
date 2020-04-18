@extends('templates.home1')

@section('title',"Penghasilan Kotor")

@section('container')
<input type="hidden" name="" id="nav" value="Pendapatan Kotor">
<div class="container">
    <h1 class="style-4">Penghasilan Kotor</h1>
    <div class="row mt-3 justify-content-end">
        <div class="col-7">
        <form action="{{url('/owner/pendapatan')}}" method="get">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <select class="form-control" id="bulan" name="bulan">
                                @if (isset($bulan))
                                    @foreach ($listbulan as $lb)
                                        @if($bulan==$lb["no"])
                                         <option value="{{$lb["no"]}}" selected>{{$lb['value']}}</option>
                                        @endif
                                         <option value="{{$lb["no"]}}">{{$lb['value']}}</option>
                                    @endforeach
                                    @else
                                        @foreach ($listbulan as $lb)
                                        <option value="{{$lb["no"]}}">{{$lb['value']}}</option>
                                        @endforeach
                                @endif                            
                              </select>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <select name="tahun" id="tahun" class="form-control">
                                @if (isset($tahun))
                                    @if($tahun!=null)
                                     <option value="{{$tahun}}">{{$tahun}}</option>
                                    @endif
                                @endif
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@if (!$transaksi->isEmpty())

    <div class="row">
        <div class="col">
            <div class="table-responsive table-sm">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <th scope="col">Tanggal</th>
                        <th scope="col">Id Nota</th>
                        <th scope="col">Total</th>
                    </thead>

                    <tbody>
                        <?php $pengtol=0 ?>
                        @foreach ($transaksi as $t)
                            <tr>
                            <td scope="row">{{$t->date}}</td>
                            <td>{{$t->id}}</td>
                            <td>Rp. {{$t->total}}
                                <?php $pengtol = $pengtol + $t->total  ?>
                            </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="bg-success text-bold">Penghasil Total</td>
                        <td class="text-bold text-black-50 bg-success">Rp. {{$pengtol}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
      
    @endif
</div>
    
@endsection