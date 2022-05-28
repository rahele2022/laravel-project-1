@if(auth()->check())
    <div class="container mt-3">
        <div class="col-md-10">
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="btn btn-danger">خروج</button>
    </form>
@else
<a href="{{ route('login') }}" class="btn-info">ورود</a>
@endif
        </div>
    </div>
