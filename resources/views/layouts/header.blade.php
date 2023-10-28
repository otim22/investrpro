<header class="fixed-top bg-body shadow">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <h3>InvestrPro</h3>
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2">Features</a></li>
                <li><a href="#" class="nav-link px-2">Pricing</a></li>
                <li><a href="#" class="nav-link px-2">FAQs</a></li>
                <li><a href="#" class="nav-link px-2">About</a></li>
            </ul>

                @if (Route::has('login'))
                    <div class="col-md-3 text-end">
                        @auth
                            <a href="{{ url('/home') }}" type="button" class="btn btn-outline-primary me-2">Home</a>
                        @else
                            <a href="{{ route('login') }}" type="button" class="btn btn-outline-primary me-2">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" type="button" class="btn btn-primary">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div> 
</header>