<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('css/index.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>
  <main>
    <i class="fa-solid fa-bars"></i>
    <i class="fa-solid fa-ellipsis"></i>
    <div class="theSlidenav">
      @include('components.sideNav')
    </div>
    @include('components.CreateTask')
      @include('components.Tasks')
    <div class="theStatus">
      @include('components.Status')
    </div>
  </main>
  <script>
    let SideNav = document.querySelector('.SideNav');
    let bars = document.querySelector('.fa-bars');

    bars.addEventListener('click', () => {
      SideNav.classList.toggle('ShowNav');
    });

    let Status = document.querySelector('.Status');
    let ellipsis = document.querySelector('.fa-ellipsis');

    ellipsis.addEventListener('click', () => {
      Status.classList.toggle('Showstatus');
    });

  </script>
</body>
</html>