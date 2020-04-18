<html lang="en"><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  
    <title>Login</title>
  
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
  
  </head>
  <body class="bg-gradient-light">
    <div style="position: absolute; bottom:40; left:30;">
      <a href="{{url('/')}}"><p class="badge badge-primary p-3"><<<<</p></a>
    </div>
    <div class="container">
      
      <!-- Outer Row -->
      <div class="row justify-content-center ">
       
  
        <div class="col-xl-10 col-lg-12 col-md-9 ">
          
          <div class="card o-hidden border-0 shadow-lg my-5 ">
            @if (session('flash'))
          <div class="alert alert-success text-center" role="alert">
              {{session('flash')}}
            </div>        
          @endif
            <div class="card-body p-0 ">
             
              <!-- Nested Row within Card Body -->
              <div class="row justify-content-center">
                
                <div class="col-lg-6">
                
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                    </div>
                    @error('email')
                    <div class="alert alert-danger text-center pt-3a" role="alert">
                        {{$message}}
                      </div>                    
                    @enderror
                <form class="user" method="post" action="{{route('login')}}">
                    @csrf
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="masukkan email" value="{{old('email')}}">
                        
                    </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                      </div>
                     
                      <div class="text-center">
                        <button type="submit" class="btn text-center btn-primary btn-block btn-user">Login</button>
                      </div>
                                                              
                    </form>
                    <hr>
                    {{-- <div class="text-center">
                    <a class="small" href="{{url('/forgotpassword')}}">Forgot Password?</a>
                    </div> --}}
                    {{-- <div class="text-center">
                      <a class="small" href="{{route('register')}}">Create an Account!</a>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
  
        </div>
  
      </div>
  
    </div>
  
    
  
  
  
  
  </body></html>