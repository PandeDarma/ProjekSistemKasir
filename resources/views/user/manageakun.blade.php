@extends('templates.home1')

@section('title','Manage Akun')

@section('container')
<input type="hidden" name="" id="nav" value="Manipulasi">
    <div class="container">
        <h1 class="style-4">Manage Akun</h1>
        <div class="row">
            <div class="col-10">
                @if (session('flash'))
                <div class="alert alert-success" role="alert">
                    {{session('flash')}}
                  </div>                    
                @endif
               <div class="table-responsive">
                <table class="table table-fixed table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="col-3">Nama</th>
                            <th scope="col" class="col-3">Role</th>
                            <th scope="col" class="col-3">Status</th>
                            <th scope="col" class="col-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user1 as $u)
                            @if ($u->role_id !=1 && $u->role_id != 2)                      
                            <tr>                
                            <th scope="row" class="col-3">{{$u->name}}</th>
                            <td class="col-3">{{$u->role->namaRole}}</td>
                                <td class="col-3">Aktif</td>
                            <td class="col-3"><form action="{{url('manageakun/'.$u->id.'/delete')}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger p-0 w-25" onclick=" return confirm('Yakin?')">Hapus</button>
                                </form>
                            
                            </tr>
                            @endif
                        @endforeach
                              
                       
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection