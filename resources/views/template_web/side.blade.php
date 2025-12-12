 <!-- slide-bar start -->
 <aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);"><i class="fal fa-times"></i></a>
    </div>

    <!-- sidebar-info start -->
    @include('page_web.keranjang.keranjang')
    <!-- sidebar-info end -->

    <!-- side-mobile-menu start -->
    <nav class="side-mobile-menu">
        <div class="header-mobile-search">
            <form role="search" method="get" action="#">
                <input type="text" placeholder="Search Keywords">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
        <ul id="mobile-menu-active">
            <li class="dropdown"><a href="index.html">Home</a>
                <ul class="sub-menu">
                    <li><a href="index.html">Home One</a></li>
                    <li><a href="home-2.html">Home Two</a></li>
                    <li><a href="home-3.html">Home Three</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Shop</a>
                <ul class="sub-menu">
                    <li><a href="shop.html">Shop Default</a></li>
                    <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                    <li><a href="shop-single.html">Shop Single</a></li>
                    <li><a href="cart.html">Shop Cart</a></li>
                    <li><a href="checkout.html">Shop Checkout</a></li>
                    <li><a href="account.html">Account</a></li>
                </ul>
            </li>
            <li><a href="shop.html">Accesories</a></li>
            <li class="dropdown">
                <a href="#!">Blog</a>
                <ul class="sub-menu">
                    <li><a href="news.html">Blog</a></li>
                    <li><a href="news-single.html">Blog Details</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#!">Pages</a>
                <ul class="submenu">
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="about.html">Account</a></li>
                    <li><a href="404.html">404</a></li>
                </ul>
            </li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
    

    <!-- side-mobile-menu end -->
</aside>