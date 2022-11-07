<nav class="navbar navbar-light navbar-expand-md py-3" style="background-color: rgb(171, 245, 171)">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon" style="height: 50px; width: 10px; margin-right: 10px">
                <img src="/picture/PalawanSeal.png" class="block fill-current text-gray-600" style="height: 70px; width: 70px; margin-right: 10px">
            </span>
            
            <span class="font-semibold text-xl text-gray-800 leading-tight" style="margin-left: 25px">
                {{ __('Palawan Decision Support System') }}
            </span>
        </a>
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2">
                    <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
                </button>
        <div class="collapse navbar-collapse" id="navcol-2">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                        {{ Auth::user()->name }} 
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}"                                    
                        onclick="event.preventDefault();                                                     
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#">Second Item</a>
                        <a class="dropdown-item" href="#">Third Item</a>
                        <a class="dropdown-item" href="#">Menu Item</a></div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>