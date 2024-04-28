@extends('welcome')
@section('content')
<section class="content">
    <div class="continer">
      <h1 class="head">START YOUR DAILY <span>TASKS</span></h1>
     <div class="signin">
       <form action="{{route('Create_page')}}" method="post" >
        @csrf
        <h1>SIGN UP</h1>
        <div class="info">
            <div class="wrap">
              @error('email')
                <span class="text-danger" style="color:red; text-align: center;">{{ $message }}</span>
              @enderror
                <label>Name</label>
                <input type="text" name="name" id="" required>
              </div>
          <div class="wrap">
            <label>Email</label>
            <input type="email" name="email" id="" required>
          </div>
          <div class="wrap">
            <label>Password</label>
            <input type="password" name="password" id="" required>
          </div>
          <button type="submit">SIGN UP</button>
        </div>
       </form>
     </div>
    </div>
  </section>
@endsection