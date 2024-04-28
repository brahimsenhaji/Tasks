<header>
    <div class="logo"><h1>任務</h1></div>
    <nav>
        <ul>
            <li><a href="">CONTACT</a></li>
            @if (!Request::is('/'))
            <li><a href="{{route('home_page')}}">SIGN IN</a></li>
            @else
            <li><a href="{{route('signup_page')}}">SIGN UP</a></li>
            @endif
        </ul>
    </nav>
</header>