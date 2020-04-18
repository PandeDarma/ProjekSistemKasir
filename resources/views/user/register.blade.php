@extends('templates.home1')

@section('title','Register')
@section('container')
<input type="hidden" name="" id="nav" value="Manipulasi">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 bg-white">
                <h1 class="style-4 text-center my-2 mb-5">Register</h1>
            <form action="{{url('/manageakun/tambah')}}" method="post">
                    @csrf
                    <div class="form-group">               
                    
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Nama Lengkap" id="name" name="name">                      
                    </div>
                    <div class="form-group">               
                
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" placeholder="alamat" id="alamat" name="alamat">                      
                    </div>
                    <div class="form-group">
                 
                        <input type="date" name="tahunlahir" min="1000-01-01"
                               max="3000-12-31" class="form-control" value="{{old('tahunlahir')}}">
                       </div>

                    <div class="form-group pb-0">
                      
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                      
                        <select name="role" id="role"  class="form-control">
                            @foreach ($roles as $r)
                                @if ($r->id !=1)
                                    <option value="{{$r->id}}" class="text-capitalize">{{$r->namaRole}}</option>
                                @endif                           
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-row pb-3">
                        <div class="col">
                    
                        <input type="password" class="form-control  @error('password1') is-invalid @enderror" placeholder="password" id="password1" name="password1">
                        </div>
                        <div class="col text-right">
                      
                        <input type="password" class="form-control  @error('password2') is-invalid @enderror" placeholder="Ulang Password" id="password2" name="password2">
                        </div>
                    </div>
                    <div class="text-center py-4 mb-5">
                        <button type="submit" class="btn btn-success btn-block">Daftar</button>
                    </div>

                </form>
    </div>
</div>
</div>

@endsection