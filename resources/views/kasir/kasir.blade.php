@extends('templates/home1')

@section('title',"Kasir")


@section('container')
    <input type="hidden" id="nav" value="Transaksi">
    <div class="container">
        <h1 class="style-4">Kasir</h1>
        <div class="row">
            <div class="col-5">
                <form action="">
                <p>waktu: {{date('l d F Y h:i a',time()+(60*60*8))}}</p>
                    <div class="form-group">                        
                    <input class="form-control" type="text" name="idnota" id="idnota" value="{{$latest->id + 1}}" readonly>
                    </div>
                    <div class="form-group">
                    <input class="form-control" type="text" name="nama" id="nama" value="{{Auth::user()->name}}" readonly>
                    </div>
                </form>
            </div>
            <div class="col-7 border  bg-light  " style="border-radius:2rem">
               <h1 class="style-4 mt-5 ml-4">Rp. <span id="total">0</span> </h1>
            </div>
        </div>

        <div class="row mt-1">
            
            <div class="col-3">
                <form action="">
                
                <div class="form-group row">
                    <label for="barcode" class="col-3">Barcode</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="barcode" id="barcode" value="" >
                     </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group row">
                    <label for="barcode" class="col-3">Nama</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="namabarang" id="namabarang" value="" readonly >
                     </div>
                </div>
            </div>
            
            <div class="col-3">
                <div class="form-group row">
                    <label for="barcode" class="col-3">Harga</label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="harga" id="harga" value="" readonly >
                     </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group row">
                    <label for="barcode" class="col-4">Jumlah</label>
                    <div class="col-8">
                        <input type="number" class="form-control" name="kuantiti" id="kuantiti" value="0" min="0">
                     </div>
                </div>
            </div>
            <div class="col-1">
                <div class="row" style="cursor: grab;"> <p id="batal" class="badge badge-danger w-100">Batal</p> </div>
                <div class="row" style="cursor: grab;"> <p class="badge badge-success w-100" id="oke">simpan</p> </div>
                </div>
        </form>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                    <table class="table table-bordered  mb-0">
                      <thead>
                        <tr>
                          <th scope="col">Nama Barang</th>
                          <th scope="col">Kuantiti</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                    </table>
                  
                  </div>

            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <form action="">
                
                        <div class="form-group">   
                            <label for="bayar">Bayar:</label>                     
                            <input class="form-control" type="text" name="bayar" id="bayar" value="" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="kembalian">Kembalian:</label>
                            <input class="form-control" type="text" name="kembalian" id="kembalian" value="" readonly>
                        </div>
                    </form>
            </div>
            <div class="col-4">
                <div class="row justify-content-center mt-5">
                    <p class="badge badge-danger w-75 p-2"  style="cursor: grab;" onclick="return confirm('Yakin?')" id="batall">Batal</p>
                </div>
                <div class="row justify-content-center">
                    <p class="badge badge-success w-75 p-2"  style="cursor: grab;" id= "simpann">Simpan</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>

    $(document).ready(function(){

            // untuk menampilkan nama barang dan harga
            function tampilbarang(keyword = ''){
                $.ajax({
                    //                 headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //   },
                url: "{{route('kasir.action')}}",
                    method: "GET",
                    data: {keyword:keyword},
                    dataType: "json",
                    success: function(data){
                        $('#harga').val(data.harga)
                        $('#namabarang').val(data.namabarang) 
                        
                    }
                });
            }

            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //ajax untuk mengintup detail transaksi dan menampilkan di table
            function inputdetail(transId ,barcode,kuantiti,harga,namabarang){
                $.ajax({     
            
                method: 'post',
                url: "{{route('kasir.detail')}}",
                    dataType: 'json',
                    data:{_token:CSRF_TOKEN,
                        transId:transId,
                            barcode:barcode,
                            kuantiti:kuantiti,
                            harga:harga,
                            namabarang:namabarang
                    },
                    success: function(data){
                        $('tbody').append(data.output)
                    }
                });
            }
            // ajax untuk menghapus salah satu detial transaksi
            function deletedetail(barcode, transId,total){
                $.ajax({
                    url:"{{route('kasir.hapus')}}",
                    method: 'post',
                    dataType: 'json',
                    data:{barcode:barcode,_token:CSRF_TOKEN, transId:transId,total:total},
                    success:function(data){
                        $('tr').remove('.'+data.bar);
                        $('#total').text(data.harga);
                    
                    }
                });
            }
            // ajax untuk menyimpan transaksi
            function tambahtransaksi(nama,harga){
                $.ajax({
                    url:"{{route('kasir.tambah')}}",
                    method: "post",
                    dataType: 'json',
                    data: {
                        _token:CSRF_TOKEN,
                        nama:nama,
                        harga:harga
                    },
                    success: function(data){
                    }
                });
            }
            // ajax untuk menghapus semua detail transaksi / bertujuan untuk membatalkan transaksi
            function batalbelanja(nota){
                $.ajax({
                    url: "{{route('kasir.batal')}}",
                    method: 'post',
                    dataType:'json',
                    data:{
                        _token:CSRF_TOKEN,
                        nota:nota
                    },
                    success: function(data){

                    }
                });
            }
            //ajax tambah satu 
            function tambahsatu(nota, barcode){
                $.ajax({
                    url:"{{route('kasir.tambahsatu')}}",
                    method: 'post',
                    dataType: 'json',
                    data:{
                        _token:CSRF_TOKEN,
                        nota:nota,
                        barcode:barcode                    
                    },
                    success: function(data){
                        
                    }
                });
            }
            function kurangsatu(nota, barcode){
                $.ajax({
                    url:"{{route('kasir.kurangsatu')}}",
                    method: 'post',
                    dataType: 'json',
                    data:{
                        _token:CSRF_TOKEN,
                        nota:nota,
                        barcode:barcode                    
                    },
                    success: function(data){

                    }
                });
            }
            // menghapus 1 kuantiti menggunakan ajax
            $(document).on('click','.kurang',function(){
                let barcode = $(this).val();

                let kuantiti = $('.kuantiti.'+barcode).text();
                let harga = $('.harga.'+barcode).text();
                let total=$('#total').text();
                let hasil = total - harga;
                let akhirkuantiti = kuantiti -1;
                let nota = $('#idnota').val();
                
            kurangsatu(nota,barcode);

                kuantiti = $('.kuantiti.'+barcode).text(akhirkuantiti);
                total=$('#total').text(hasil);
            
            })
            $(document).on('click','.tambah',function(){
                let barcode = $(this).val();

                let kuantiti =parseInt($('.kuantiti.'+barcode).text());
                let harga =parseInt( $('.harga.'+barcode).text());
                let total=parseInt($('#total').text());
                let hasil = total + harga;

                let akhirkuantiti = kuantiti +1;
                let nota = $('#idnota').val();
                tambahsatu(nota,barcode);

                kuantiti = $('.kuantiti.'+barcode).text(akhirkuantiti);
                total=$('#total').text(hasil);
            
            })

            // menjalankan ajax tambah transaksi
            $(document).on('click','#simpann',function(){

                let harga =parseInt( $('#total').text());
                let nama = $('#nama').val();

                if(harga != 0){
                tambahtransaksi(nama,harga);
            
                window.location.href ="{{url('/kasir')}}"
                }
                
            })
            //menjalankan ajax membatalkan semua detail transaksi
            $(document).on('click','#batall',function(){
                let nota = $('#idnota').val();

                batalbelanja(nota);
                $('#total').text('0');
                $('#barcode').val('');
                $('#harga').val('');
                $('#namabarang').val('');
                $('#kuantiti').val(0);
                $('tr').remove('.rowo')
            })


            // menjalankan ajax saat barcode di isi
            $(document).on('keyup',"#barcode",function(){          
                    let keyword = $(this).val();
                
                    tampilbarang(keyword);
            })
        
            // membatalkan barang
            $("#batal").on('click',function(){
                    
                    $('#barcode').val('');
                    $('#harga').val('');
                    $('#namabarang').val('');
                    $('#kuantiti').val(0);
            })

            //menghapus salah satu detail barang
            $(document).on('click','.batal2',function(){
                let barcode = $(this).val();
                let transId = $('#idnota').val();

                let total = parseInt($('#total').text()); 
            
            deletedetail(barcode,transId,total);
            
            })

            // menyimpan detail barang
            $(document).on('click','#oke',function(){
                // mengambil data harga
                let harga =parseFloat($('#harga').val());
                // mengambil data kuantiti
                let kuantiti = parseInt($('#kuantiti').val());
                // mengambil data total
                let total = parseInt($('#total').text())
                // mengambil data nota
                let transId = parseInt($('#idnota').val())
                // mengambil data barcode
                let barcode = String($('#barcode').val())
                // mengambi data nama barang
                let namabarang = $('#namabarang').val();

                let sementara = harga*kuantiti;
                // && Number.isInteger(barcode)
                if(kuantiti != 0 ){

                    inputdetail(transId,barcode,kuantiti,harga,namabarang);
                    total = total + sementara;
                    $('#total').text(total);

                    $('#barcode').val('');
                    $('#harga').val('');
                    $('#namabarang').val('');
                    $('#kuantiti').val(0);
                }
            })

            // mencari total pengembalian
                $(document).on('keyup','#bayar',function(){
                        let bayar = $(this).val();
                        let total = $('#total').text();           
                        let kembalian = bayar - total
                        $('#kembalian').val(kembalian)
                    })     



    });


       
     

    

</script>
    
@endsection