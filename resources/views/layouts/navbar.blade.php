        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="https://www.google.com/maps/place/Santhia/@24.0550773,89.5282274,13.91z/data=!4m6!3m5!1s0x39fe79aea0223033:0x2c68f5b9c88b5d91!8m2!3d24.0555192!4d89.5492126!16s%2Fg%2F12q4xvkq3?entry=ttu&g_ep=EgoyMDI0MTIwOS4wIKXMDSoASAFQAw%3D%3D" class="text-white" target="blank">Santhia, Pabna</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=new"  target="blank" class="text-white">mdabirhossain.bd.info@gmail.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                        <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="{{ route('home') }}" class="navbar-brand"><h1 class="text-primary display-6">ShopSmart</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{route('home')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>

                            <a href="{{route('shop')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'shop' ? 'active' : '' }}">Shop</a>

                            <a href="{{route('product.details')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'product.details' ? 'active' : '' }} ">Shop Detail</a>

                            <a href="{{route('contact')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="{{ route('cart') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1 cart_counter" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ $cart_count }}</span>
                            </a>
                            <a href="{{ route('login') }}" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->
