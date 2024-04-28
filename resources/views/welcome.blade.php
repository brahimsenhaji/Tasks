<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>Document</title>
</head>
<body>
    <main>
        @include('components.header')
        @if (Request::is('/'))
            <section class="content">
              <div class="continer">
                <h1 class="head">START YOUR DAILY <span>TASKS</span></h1>
               <div class="signin">
                 <form action="{{route('singin_page')}}" method="post">
                  @csrf
                  <h1>SIGN IN</h1>
                  <div class="info">
                    @error('email')
                        <span class="text-danger" style="color:red; display: flex; justify-content: center;">{{ $message }}</span>
                    @enderror
                    <div class="wrap">
                      <label>Email</label>
                      <input type="email" name="email" id="">
                    </div>
                    <div class="wrap">
                      <label>Password</label>
                      <input type="password" name="password" id="">
                    </div>
                    <button type="submit">SIGN IN</button>
                  </div>
                 </form>
               </div>
              </div>
            </section>
        @endif
        @yield('content')
    </main>
</body>
</html>