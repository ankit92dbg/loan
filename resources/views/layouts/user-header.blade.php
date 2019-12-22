<header>
    <div class="container">
        <a href="javascript:void(0);" class="mobileNavIcon"><i class="fa fa-bars" aria-hidden="true"></i></a>
        <a href="{{url('/')}}" class="logo"><img src="{{url('/images/fabwedding-header-logo.svg')}}" alt="Fab Weddings" class="logo" scale="0" /></a>
        <ol class="search-signup">
            <li class="loginSignup">
                @guest
                <a href="javascript:void(0);"><span>login / singup</span></a>
                @else
                <a href="javascript:void(0)"><span>logged in</span></a>
                <div class="MyAaccount">
                    <ul>
                        <li><a href="{{url('/dashboard')}}" class=""><img src="{{url('/images/dashboard.png')}}" alt="" /> Dashboard</a></li>
                        <li><a href="{{url('/profile')}}" class=""><img src="{{url('/images/profile.png')}}" alt="" /> Profile</a></li>
                        <li><a href="{{url('/listings')}}" class=""><img src="{{url('/images/listing.png')}}" alt="" /> Listings</a></li>
                        <li><a href="{{url('/notifications')}}" class=""><img src="{{url('/images/notifications.png')}}" alt="" /> Notifications</a></li>
                        <li><a href="{{url('/messages')}}" class=""><img src="{{url('/images/messages.png')}}" alt="" /> Messages</a></li>
                        <li><a href="{{url('/billings')}}" class=""><img src="{{url('/images/billing.png')}}" alt="" /> Billings</a></li>
                        <li><a href="{{url('/favorites')}}" class=""><img src="{{url('/images/favorites.png')}}" alt="" /> Favorites</a></li>
                        <li><a href="#" class=""><img src="{{url('/images/logout.png')}}" alt="" /> Logout</a></li>
                    </ul>
                </div>
                @endguest
            </li>
            <li>
                <a href="tel:+919016540186" class="callNo"><i class="fa fa-mobile" aria-hidden="true" style="font-size: 27px; vertical-align: -4px;"></i> &nbsp; 901 654 0186</a>
            </li>
        </ol>
        <nav>
            <div class="closeMobileNav">FAB MENU <i class="fa fa-times" aria-hidden="true"></i></div>
            <ul>
                <li class="filterTopBlk" style="position: relative;">
                    <form>
                        <input type="text" name="search" placeholder="Photographers, Makeup, Venues etc">
                        <button class="searchBtnFilter"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </li>
                <li><a href="#">Vendor <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <div class="subNav">
                        <ul>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Photographers</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Bridal Makeup</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Mehndi</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Videography</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Venue</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Planner</a></li>

                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Gifts</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Jewellery</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Bridal Wear</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Catering</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding DJ</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Cakes</a></li>

                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Card</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Groom Wear</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Accessories</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Trousseau Packers</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Decorators</a></li>
                            <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> Wedding Cakes</a></li>
                        </ul>

                        <div class="vendorRegister">
                            Are you a vendor ? <a href="#" class="registerNow">register now</a>
                        </div>
                    </div>
                </li>
                <li><a href="#">Compare</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="{{url('/photos')}}">Photos</a></li>
            </ul>
        </nav>

        <div class="mobileNav">
            <ul>
                <li>
                    <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>

                </li>
                <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</header>