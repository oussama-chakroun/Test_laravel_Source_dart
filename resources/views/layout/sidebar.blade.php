<div class="l-navbar show" id="nav-bar">
    {{-- setup routes for navigation --}}
    <nav class="nav">
        <div> <a href="{{ route('dashboard') }}" class="nav_logo"> <img id="logo-source-dart" src="{{ asset('assets/img/logo-source-dart.png') }}" /> <span
                    class="nav_logo-name">Source d'art</span> </a>
            <div class="nav_list">
                <a href="{{ route('dashboard') }}" class="nav_link {{ Request::is('/') ? 'active' : '' }}"> <i
                    class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                         
                <a href="{{ route('product.index') }}" class="nav_link {{ str_contains(url()->current(), '/product') ? 'active' : '' }}"> <i class='bx bx-store-alt'></i> <span
                    class="nav_name">Product</span> </a> 
                
                <a href="{{ route('category.index') }}" class="nav_link {{ str_contains(url()->current(), '/category') ? 'active' : '' }}"> <i class='bx bx-duplicate' ></i>
                     <span class="nav_name">Category</span>
                </a> </div>
        </div>
    </nav>
</div>
