<div class="topbarhea">
  <div class="container">
     <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 d-none d-md-block">
           <div class="topbar-slogan">
              <svg class="topbar-ico" viewBox="0 0 24 24" aria-hidden="true">
                 <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
              </svg>
              <span>Chất lượng tạo nên đẳng cấp</span>
           </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 text-hea-right">
           <div class="box_top_hea">
              <a title="{{ $setting->phone1 }}" href="tel:{{$setting->phone1}}" class="opaci_href"></a>
              <svg class="topbar-ico" viewBox="0 0 24 24" aria-hidden="true">
                 <path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 011 1V20a1 1 0 01-1 1C10.4 21 3 13.6 3 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.46.57 3.58a1 1 0 01-.25 1.02l-2.2 2.19z"/>
              </svg>
              <span>Hotline: <b>{{$setting->phone1}}</b></span>
           </div>
        </div>
     </div>
  </div>
</div>

<header class="header header-luxury">
  <div class="container">
     <div class="row align-items-center header-main-row">
        <div class="col-lg-3 col-6 logo_mobile header-logo-col">
           <div class="menu-bar d-lg-none d-inline-block">
              <svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                 <path fill="currentColor"
                    d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"></path>
              </svg>
           </div>
           <a href="/" class="logo" title="{{ $setting->company }}">
              <img width="378" height="96"
                 src="{{$setting->logo}}"
                 alt="{{$setting->company}}">
           </a>
           <div class="box_poy_mb d-lg-none d-inline-block">
              <div class="item_poly_mb">
                 <a href="{{route('listCart')}}" title="Giỏ hàng" class="opaci_href"></a>
                 <svg class="header-action-ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14h9.45c.75 0 1.4-.41 1.74-1.03L21 6H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 16.37 5.48 18 7 18h12v-2H7.42l.74-1.34z"/>
                 </svg>
                 <span class="count count_item_pr">{{ collect($cartcontent ?? [])->sum('quantity') }}</span>
              </div>
           </div>
        </div>

        <div class="col-lg-5 d-none d-lg-block header-nav-col">
           <div class="header-menu header-menu-left">
              <div class="header-menu-des">
                 <nav class="header-nav">
                    <ul class="item_big">
                       <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                          <a class="a-img a-index " href="{{route('home')}}" title="Trang chủ">Trang chủ</a>
                       </li>
                       <li class="nav-item has-mega nav-item-products">
                          <a class="a-img a-index caret-down" href="javascript:;" title="Sản phẩm">
                             Sản phẩm
                          </a>
                          <div class="menu_mega indexs products-mega">
                             <div class="blog-aside">
                                <div class="aside-content">
                                   <div class="ul_menu">
                                      @foreach ($categoryhome as $item)
                                      <div class="nav_item nav-item lv1 li_check">
                                         <a href="{{route('allListProCate',['danhmuc'=>$item->slug])}}" title="{{languageName($item->name)}}"
                                            style="background-image: url('{{$item->avatar}}')">
                                            {{languageName($item->name)}}
                                            @if (count($item->typeCate) > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg>
                                            @endif
                                         </a>
                                         @if (count($item->typeCate) > 0)
                                         <div class="ul_content_right_1">
                                            <div class="row">
                                               @foreach ($item->typeCate as $type)
                                               <div class="nav_item nav-item lv2 col-lg-4 col-md-4">
                                                  <a href="{{route('allListType',['danhmuc'=>$item->slug,'loaidanhmuc'=>$type->slug])}}" title="{{languageName($type->name)}}">{{languageName($type->name)}}</a>
                                               </div>
                                               @endforeach
                                            </div>
                                         </div>
                                         @endif
                                      </div>
                                      @endforeach
                                   </div>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="nav-item {{ request()->routeIs('aboutUs') ? 'active' : '' }}">
                          <a class="a-img a-index" href="{{route('aboutUs')}}" title="Giới thiệu">Giới thiệu</a>
                       </li>
                       @foreach ($blogCate as $item)
                       <li class="nav-item {{ request()->is('tin-tuc*') ? 'active' : '' }}">
                          <a class="a-img a-index" href="{{route('listCateBlog',['slug'=>$item->slug])}}" title="{{languageName($item->name)}}">
                             {{languageName($item->name)}}
                          </a>
                       </li>
                       @endforeach
                       <li class="nav-item {{ request()->routeIs('lienHe') ? 'active' : '' }}">
                          <a class="a-img a-index" href="{{route('lienHe')}}" title="Liên hệ">Liên hệ</a>
                       </li>
                    </ul>
                 </nav>
              </div>
           </div>
        </div>

        <div class="col-lg-4 col-6 header-tools-col">
           <div class="header-menu header-menu-right">
              <div class="search-smart">
                 <form action="{{ route('search_result') }}" method="get" class="header-search-form input-group search-bar" role="search">
                    <input type="text" name="keyword" required
                       class="input-group-field form-control"
                       placeholder="Nhập tên sản phẩm..."
                       value="{{ request('keyword') }}">
                    <button type="submit" class="btn icon-fallback-text" aria-label="Tìm kiếm" title="Tìm kiếm">
                       <svg class="icon header-action-ico" viewBox="0 0 24 24" aria-hidden="true">
                          <path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                       </svg>
                    </button>
                 </form>
              </div>
              <div class="header-actions hid-mb">
                 <a href="{{route('listCart')}}" class="header-action-link text-gold header-cart-link" title="Giỏ hàng">
                    <svg class="header-action-ico" viewBox="0 0 24 24" aria-hidden="true">
                       <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14h9.45c.75 0 1.4-.41 1.74-1.03L21 6H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 16.37 5.48 18 7 18h12v-2H7.42l.74-1.34z"/>
                    </svg>
                    <span class="count count_item_pr">{{ collect($cartcontent ?? [])->sum('quantity') }}</span>
                 </a>
              </div>
           </div>
        </div>
     </div>
  </div>

  {{-- Mobile slide menu --}}
  <div class="header-menu">
     <div class="menu_mega indexs">
        <div class="menu_mobs">
           <ul id="nav-mobile" class="nav">
              <li class="nav-item">
                 <a href="{{route('home')}}" class="nav-link" title="Trang chủ">Trang chủ</a>
              </li>
              @foreach ($categoryhome as $item)
              <li class="nav-item has-childs">
                 <a href="{{route('allListProCate',['danhmuc'=>$item->slug])}}" class="nav-link navlink-level1"
                    title="{{languageName($item->name)}}"
                    style="background-image: url('{{$item->avatar}}')">{{languageName($item->name)}}</a>
                 @if (count($item->typeCate) > 0)
                 <i class="open_mnu down_icon"></i>
                 <ul class="dropdown-menu">
                    @foreach ($item->typeCate as $type)
                    <li class="nav-item-lv2">
                       <a class="nav-link" href="{{route('allListType',['danhmuc'=>$item->slug,'loaidanhmuc'=>$type->slug])}}"
                          title="{{languageName($type->name)}}">{{languageName($type->name)}}</a>
                    </li>
                    @endforeach
                 </ul>
                 @endif
              </li>
              @endforeach
              <li class="nav-item">
                 <a href="{{route('aboutUs')}}" class="nav-link" title="Giới thiệu">Giới thiệu</a>
              </li>
              @foreach ($blogCate as $item)
              <li class="nav-item">
                 <a href="{{route('listCateBlog',['slug'=>$item->slug])}}" class="nav-link" title="{{languageName($item->name)}}">{{languageName($item->name)}}</a>
              </li>
              @endforeach
              <li class="nav-item">
                 <a href="{{route('lienHe')}}" class="nav-link" title="Liên hệ">Liên hệ</a>
              </li>
           </ul>
        </div>
     </div>
     <nav class="header-nav header-nav-mobile">
        <ul class="item_big d-lg-none">
           <li class="nav-item">
              <a class="a-img" href="{{route('home')}}" title="Trang chủ">Trang chủ</a>
           </li>
           <li class="nav-item">
              <a class="a-img" href="javascript:;" title="Sản phẩm">Sản phẩm</a>
              <i class="fa fa-caret-down"></i>
              <ul class="item_small">
                 @foreach ($categoryhome as $item)
                 <li class="nav-item-lv2">
                    <a href="{{route('allListProCate',['danhmuc'=>$item->slug])}}" title="{{languageName($item->name)}}">{{languageName($item->name)}}</a>
                    @if (count($item->typeCate) > 0)
                    <i class="fa fa-caret-down"></i>
                    <ul>
                       @foreach ($item->typeCate as $type)
                       <li>
                          <a href="{{route('allListType',['danhmuc'=>$item->slug,'loaidanhmuc'=>$type->slug])}}" title="{{languageName($type->name)}}">{{languageName($type->name)}}</a>
                       </li>
                       @endforeach
                    </ul>
                    @endif
                 </li>
                 @endforeach
              </ul>
           </li>
           <li class="nav-item">
              <a class="a-img" href="{{route('aboutUs')}}" title="Giới thiệu">Giới thiệu</a>
           </li>
           @foreach ($blogCate as $item)
           <li class="nav-item">
              <a class="a-img" href="{{route('listCateBlog',['slug'=>$item->slug])}}" title="{{languageName($item->name)}}">{{languageName($item->name)}}</a>
           </li>
           @endforeach
           <li class="nav-item">
              <a class="a-img" href="{{route('lienHe')}}" title="Liên hệ">Liên hệ</a>
           </li>
        </ul>
     </nav>
  </div>
</header>
