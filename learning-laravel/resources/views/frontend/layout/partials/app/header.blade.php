<div id="preloder">
    <div class="loader"></div>
</div>
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    vietd8k11@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    0971046025
                </div>
            </div>
            <div class="ht-right">
                <a href="" class="login-panel"><i class="fa fa-user"></i>Login</a>
                <div class="lan-selector">
                    <select class="language_drop" name="countries" id="countries" style="width:300px;">
                        <option value='yt' data-image="frontend/assets/img/flag-1.jpg" data-imagecss="flag yt"
                            data-title="English">English</option>
                        <option value='yu' data-image="frontend/assets/img/flag-2.jpg" data-imagecss="flag yu"
                            data-title="Bangladesh">German </option>
                    </select>
                </div>
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="#">
                            <img src="frontend/assets/img/text.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <button type="button" class="category-btn">All Products</button>
                        <form class="input-group" action="{{ route('fr.home') }}" method="GET">
                            <input type="text" name="key" placeholder="What do you need?">
                            <button type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="heart-icon"><a href="#">
                                <i class="icon_heart_alt"></i>
                                <span></span>
                            </a>
                        </li>
                        <li class="cart-icon"><a href="#">
                                <i class="icon_bag_alt"></i>
                                <span>{{ \Cart::count() }}</span>
                            </a>
                            {{-- <div class="cart-hover">
                        <div class="select-items">
                            <table>
                                @foreach ($products as $key => $item)
                                <tbody>
                                    <tr>
                                        <td class="si-pic"><img class="card-img-top" width="30%" height="30%"src="{{ asset('storage/images/'.$item->image) }}" alt=""></td>
                                        <td class="si-text">
                                            <div class="product-selected">
                                                <p>{{$item->price}}$</p>
                                                <h6>{{$item->name}}</h6>
                                            </div>
                                        </td>
                                        <td class="si-close">
                                            <i class="ti-close"></i>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div class="select-total">
                            <span></span>
                            <h5></h5>
                        </div>
                        <div class="select-button">
                            <a href="" class="primary-btn view-card">VIEW CARD</a>
                            <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                        </div>
                    </div> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>All Category</span>
                    <ul class="depart-hover">
                        @foreach ($categories as $key => $item)
                            <li class="active">
                                <a href="{{ route('fr.view', ['id' => $item->id]) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Brand</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="{{ route('fr.contact') }}">Contact</a></li>
                    <li><a href="{{ route('fr.create') }}">Đăng ký</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>

