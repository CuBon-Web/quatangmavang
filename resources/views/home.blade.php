@extends('layouts.main.master')
@section('title')
{{ trim(($setting->webname ?: '') . (($setting->webname && $setting->company) ? ' | ' : '') . ($setting->company ?: '')) ?: config('app.name') }}
@endsection
@section('description')
@php
    $homeDescParts = array_filter([
        $setting->webname ?? null,
        $setting->company ?? null,
        !empty($setting->address1) ? ('Địa chỉ: ' . $setting->address1) : null,
        !empty($setting->phone1) ? ('Hotline: ' . $setting->phone1) : null,
    ]);
    $homeDescription = seo_plain_text(implode('. ', $homeDescParts), 160);
@endphp
{{ $homeDescription }}
@endsection
@section('canonical')
{{ route('home') }}
@endsection
@section('image')
    @php
        $ogBanner = $banner->first();
        $ogImage = $ogBanner && $ogBanner->image ? url($ogBanner->image) : url($setting->logo ?? '');
    @endphp
    {{ $ogImage }}
@endsection
@section('css')

@endsection
@section('js')
@endsection
@section('content')
<div class="bodywrap">
  <h1 class="d-none">{{ $setting->company }} - {{ $setting->webname }}</h1>
  <div class="container">
     <div class="box_slide_banner">
        <div class="home-slider swiper-container">
           <div class="swiper-wrapper">
            @foreach ($banner as $item)
            <div class="swiper-slide">
              <a href="{{$item->link}}" class="clearfix" title="{{$item->title}}">
                 <picture>
                    <source media="(min-width: 1200px)"
                       srcset="{{url($item->image)}}">
                    <source media="(min-width: 992px)"
                       srcset="{{url($item->image)}}">
                    <source media="(min-width: 991px)"
                       srcset="{{url($item->image)}}">
                    <source media="(max-width: 767px)"
                       srcset="{{url($item->image)}}">
                    <img width="870" height="445"
                       src="{{url($item->image)}}"
                       alt="Slider 1" class="img-responsive" />
                 </picture>
              </a>
           </div>
            @endforeach
           </div>
        </div>
        <div class="banner_slide">
          @foreach ($bannerads as $item)
          <a href="{{$item->link}}" title="{{$item->title}}">
            <img width="418" height="240"
               src="{{url($item->image)}}"
               alt="Banner" />
            </a>
          @endforeach 
        </div>
     </div>
  </div>
  <script>
     var swiper = new Swiper('.home-slider', {
         loop: true,
         autoplay: {
             delay: 4500,
         }
     });
  </script>
  <section class="section_cate container">
     <h2 class="title-module">
        <a href="{{route('allProduct')}}" title="Danh mục sản phẩm">
          DANH MỤC SẢN PHẨM
           <span class="icon_title">
              <svg height="512" viewBox="0 0 24 24" width="512"
                 xmlns="http://www.w3.org/2000/svg">
                 <g id="_19" data-name="19">
                    <path
                       d="m12 19a1 1 0 0 1 -.71-1.71l5.3-5.29-5.3-5.29a1 1 0 0 1 1.41-1.41l6 6a1 1 0 0 1 0 1.41l-6 6a1 1 0 0 1 -.7.29z" />
                    <path
                       d="m6 19a1 1 0 0 1 -.71-1.71l5.3-5.29-5.3-5.29a1 1 0 0 1 1.42-1.42l6 6a1 1 0 0 1 0 1.41l-6 6a1 1 0 0 1 -.71.3z" />
                 </g>
              </svg>
           </span>
        </a>
     </h2>
     <div class="box_cate_index">
        @php
           $categoryProductCounts = \App\models\product\Product::where('status', 1)
              ->whereIn('category', $categoryhome->pluck('id'))
              ->groupBy('category')
              ->selectRaw('category, COUNT(*) as total')
              ->pluck('total', 'category');
           $lazyPlaceholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC';
        @endphp
        @foreach ($categoryhome as $item)
        @php
           $cateName = languageName($item->name);
           $cateUrl = route('allListProCate', ['danhmuc' => $item->slug]);
           $cateImages = [];
           if (!empty($item->imagehome)) {
              $decoded = is_string($item->imagehome) ? json_decode($item->imagehome, true) : $item->imagehome;
              if (is_array($decoded)) {
                 $cateImages = array_values(array_filter($decoded, function ($url) {
                    return is_string($url) && trim($url) !== '';
                 }));
              } elseif (is_string($item->imagehome) && trim($item->imagehome) !== '') {
                 $cateImages = [$item->imagehome];
              }
           }
           if (count($cateImages) < 3) {
              foreach ($item->product as $pro) {
                 $proImgs = json_decode($pro->images, true) ?? [];
                 $thumb = $proImgs[0] ?? '';
                 if ($thumb !== '') {
                    $cateImages[] = $thumb;
                 }
                 if (count($cateImages) >= 3) {
                    break;
                 }
              }
           }
           if (empty($cateImages) && !empty($item->avatar)) {
              $cateImages = [$item->avatar];
           }
           $cateImages = array_slice($cateImages, 0, 3);
           $productCount = (int) ($categoryProductCounts[$item->id] ?? 0);
        @endphp
        <div class="item-cate">
           <a href="{{ $cateUrl }}" title="{{ $cateName }}" class="opaci_href"></a>
           <h3 class="text-gold">{{ $cateName }}</h3>
           <span>( {{ $productCount }} sản phẩm )</span>
           <div class="item-pro-cate">
              @foreach ($cateImages as $image)
              <div class="box_img_cate">
                 <img width="480" height="480" class="lazyload"
                    src="{{ $lazyPlaceholder }}"
                    data-src="{{ url($image) }}"
                    alt="{{ $cateName }}" />
              </div>
              @endforeach
           </div>
        </div>
        @endforeach
     </div>
  </section>
  <section class="section_flash_sale container">
     <div class="title">
        <h2 class="title-module-flash">
           <a href="san-pham-khuyen-mai" title="Khuyến mãi đặc biệt">
           <img width="20" height="36"
              src="https://bizweb.dktcdn.net/100/509/495/themes/943203/assets/flash.svg?1781227749084"
              alt="Khuyến mãi đặc biệt" />Sản phẩm nổi bật
           </a>
        </h2>
     </div>
     <div class="box_flash_sale">
        <div class="row">
           <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="product-flash-swiper swiper-container">
                 <div class="swiper-wrapper load-after" data-section="section_flash_sale">
                    @forelse ($homePro as $item)
                    <div class="swiper-slide">
                       @include('layouts.product.item', ['pro' => $item])
                    </div>
                    @empty
                    <div class="swiper-slide">
                       <p>Chưa có sản phẩm khuyến mãi.</p>
                    </div>
                    @endforelse
                 </div>
                 <div class="swiper-button-prev"></div>
                 <div class="swiper-button-next"></div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <script>
     $(document).ready(function($) {
         function runSwiperSale() {
             var swi_deal_pro = null;
     
             function initSwiperSale() {
                 swi_deal_pro = new Swiper('.product-flash-swiper', {
                     slidesPerView: 4,
                     loop: false,
                     grabCursor: true,
                     roundLengths: true,
                     slideToClickedSlide: false,
                     spaceBetween: 15,
                     autoplay: false,
                     navigation: {
                         nextEl: '.product-flash-swiper .swiper-button-next',
                         prevEl: '.product-flash-swiper .swiper-button-prev',
                     },
                     breakpoints: {
                         300: {
                             slidesPerView: 2,
                             spaceBetween: 15
                         },
                         500: {
                             slidesPerView: 2,
                             spaceBetween: 15
                         },
                         640: {
                             slidesPerView: 2,
                             spaceBetween: 15
                         },
                         768: {
                             slidesPerView: 3,
                             spaceBetween: 15
                         },
                         991: {
                             slidesPerView: 3,
                             spaceBetween: 15
                         },
                         1200: {
                             slidesPerView: 4,
                             spaceBetween: 15
                         }
                     }
                 });
             }
     
             function destroySwiperSale() {
                 if (swi_deal_pro) {
                     swi_deal_pro.destroy(true, true);
                     swi_deal_pro = null;
                 }
             }
     
             function toggleSwiperPro1() {
                 if ($(window).width() <= 767 && swi_deal_pro) {
                     destroySwiperSale();
                 } else if ($(window).width() > 767 && !swi_deal_pro) {
                     initSwiperSale();
                 }
             }
             toggleSwiperPro1();
             $(window).resize(toggleSwiperPro1);
         }
         lazyBlockProduct('section_flash_sale', '0px 0px -250px 0px', runSwiperSale);
     });
  </script>
  @foreach ($categoryhome as $category)
  @if ($category->product->isNotEmpty())
    @include('layouts.product.home_category_tabs', ['category' => $category])
  @endif
  @endforeach

  
  
  <section class="section_why_choose">
     <div class="container">
        <div class="why-choose-panel">
           <div class="why-choose-media">
              <div class="img_thm">
                 <div class="box_img">
                    <img width="720" height="400" class="lazyload"
                       src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                       data-src="{{url(json_decode($gioithieu->image)[0] ?? '')}}"
                       alt="{{ $setting->company }}" />
                 </div>
              </div>
           </div>
           <div class="why-choose-content">
              <h2 class="title_choose_2">{{ $setting->company }}</h2>
              <div class="content_choose">{!! $gioithieu->description !!}</div>
              <div class="why-choose-stats">
               <div class="why-stat-card">
                  <strong>10+</strong>
                  <span>Năm kinh nghiệm</span>
               </div>
               <div class="why-stat-card">
                  <strong>5000+</strong>
                  <span>Khách hàng tin tưởng</span>
               </div>
               <div class="why-stat-card">
                  <strong>1000+</strong>
                  <span>Sản phẩm đa dạng</span>
               </div>
               <div class="why-stat-card">
                  <strong>99%</strong>
                  <span>Khách hàng hài lòng</span>
               </div>
            </div>
              <a class="why-choose-btn" title="Tìm hiểu thêm" href="{{ route('aboutUs') }}">
                 Tìm hiểu thêm <span>→</span>
              </a>
           </div>
           
        </div>
     </div>
  </section>
  <script>
     let videos = document.querySelectorAll('.open_video');
     let popupVideo = document.querySelector('.popup_video');
     let close_vd = document.querySelectorAll('.close_video');
     var dataset = '5RCh8JzLL5Y';
     videos.forEach(v => v.addEventListener('click', function(e) {
         e.preventDefault();
         e.target.dataset.video = dataset;
         popupVideo.classList.add('open');
         popupVideo.querySelector('.b_video').innerHTML =
             `<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/${e.target.dataset.video}?enablejsapi=1" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>`
     }));
     close_vd.forEach(v => v.addEventListener('click', function(e) {
         e.preventDefault();
         popupVideo.classList.remove('open');
         setTimeout(function() {
             popupVideo.querySelector('.b_video').innerHTML = ``
         }, 500);
     }))
     $('.faq li h3').on('click', function(e) {
         e.preventDefault();
         var $this = $(this);
         $this.parents('li').find('.content-faq').slideToggle();
         $this.parents('li').toggleClass('active');
         return false;
     });
  </script>
  <section class="section_danh_gia lazyload"
     data-src="/frontend/images/bg_danh_gia.jpg">
     <div class="container">
        <h2 class="title_danh_gia">Đánh giá khách hàng</h2>
        <p class="content_danh_gia">Những lời đánh giá chân thật từ những khách hàng đã tin tưởng vào chúng
           tôi.
        </p>
        <div class="swiper_feedback swiper-container control-top">
           <div class="swiper-wrapper">
            @foreach ($ReviewCus as $item)
            <div class=" swiper-slide">
               <div class="review_box">
                  <p class="content_review">{!!languageName($item->content)!!}
                  </p>
                  <div class="review_img">
                     <img width="200" height="200" class="lazyload"
                        src="/frontend/images/lazy.png"
                        data-src="{{url($item->avatar)}}"
                        alt="{{languageName($item->name)}}" />
                  </div>
                  <h3 class="name_review">{{languageName($item->name)}}</h3>
                  <div class="icon_gach">
                     <img width="167" height="25" class="lazyload"
                        src="/frontend/images/lazy.png"
                        data-src="/frontend/images/gach2.png"
                        alt="{{languageName($item->position)}}" />
                  </div>
                  <p class="job_review">{{languageName($item->position)}}</p>
               </div>
            </div>
            @endforeach
           </div>
           <div class="swiper-pagination"></div>
        </div>
     </div>
  </section>
  <script>
     var swiper_feedback = new Swiper('.swiper_feedback', {
         slidesPerView: 1,
         spaceBetween: 15,
         watchOverflow: true,
         slidesPerGroup: 1,
         grabCursor: true,
         pagination: {
             el: '.swiper_feedback .swiper-pagination',
             clickable: true
         },
         breakpoints: {
             640: {
                 slidesPerView: 1,
                 spaceBetween: 15
             },
             768: {
                 slidesPerView: 2,
                 spaceBetween: 20
             },
             992: {
                 slidesPerView: 3,
                 spaceBetween: 20
             },
             1024: {
                 slidesPerView: 3,
                 spaceBetween: 20
             },
             1200: {
                 slidesPerView: 4,
                 spaceBetween: 20
             },
             1500: {
                 slidesPerView: 4,
                 spaceBetween: 20
             }
         }
     });
  </script>

  <section class="section_blog">
     <div class="container">
        <h2 class="title-module">
           <a href="tin-tuc" title="Tin tức mới nhất">
              Tin tức mới nhất
              <span class="icon_title">
                 <svg height="512" viewBox="0 0 24 24" width="512"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="_19" data-name="19">
                       <path
                          d="m12 19a1 1 0 0 1 -.71-1.71l5.3-5.29-5.3-5.29a1 1 0 0 1 1.41-1.41l6 6a1 1 0 0 1 0 1.41l-6 6a1 1 0 0 1 -.7.29z" />
                       <path
                          d="m6 19a1 1 0 0 1 -.71-1.71l5.3-5.29-5.3-5.29a1 1 0 0 1 1.42-1.42l6 6a1 1 0 0 1 0 1.41l-6 6a1 1 0 0 1 -.71.3z" />
                    </g>
                 </svg>
              </span>
           </a>
        </h2>
        <div class="swiper_blogs swiper-container">
           <div class="swiper-wrapper load-after" data-section="section_blog">
            @foreach ($hotnews as $item)
            <div class="swiper-slide">
               <div class="item-blog item-blog-horizontal">
                  <div class="block-thumb">
                     <a class="thumb" href="{{route('detailBlog',['slug'=>$item->slug])}}"
                        title="{{languageName($item->title)}}">
                     <img width="600" height="380" class="lazyload"
                        src="/frontend/images/lazy.png"
                        data-src="{{url($item->image)}}"
                        alt="{{languageName($item->title)}}">
                     </a>
                  </div>
                  <div class="block-content">
                     <div class="blog-meta">
                        <svg class="blog-meta-ico" viewBox="0 0 24 24" aria-hidden="true">
                           <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                        <span>{{ date_format($item->created_at, 'd.m.Y') }}</span>
                     </div>
                     <h3>
                        <a href="{{route('detailBlog',['slug'=>$item->slug])}}"
                           title="{{languageName($item->title)}}">{{languageName($item->title)}}</a>
                     </h3>
                     <p class="justify">{!! \Illuminate\Support\Str::limit(strip_tags(languageName($item->description)), 90) !!}</p>
                     <a class="blog-readmore" href="{{route('detailBlog',['slug'=>$item->slug])}}"
                        title="{{languageName($item->title)}}">Đọc thêm <span>→</span></a>
                  </div>
               </div>
            </div>
            @endforeach
              
           </div>
           <div class="swiper-button-prev"></div>
           <div class="swiper-button-next"></div>
        </div>
        <div class="see-more">
           <a href="tin-tuc" title="Xem tất cả">Xem tất cả</a>
        </div>
     </div>
  </section>
  <script>
     $(document).ready(function($) {
         function runSwiperBlogs() {
             var blogs_pro = null;
     
             function initSwiperBlogs() {
                 blogs_pro = new Swiper('.swiper_blogs', {
                     slidesPerView: 1,
                     spaceBetween: 16,
                     watchOverflow: true,
                     slidesPerGroup: 1,
                     grabCursor: true,
                     navigation: {
                         nextEl: '.swiper_blogs .swiper-button-next',
                         prevEl: '.swiper_blogs .swiper-button-prev',
                     },
                     breakpoints: {
                         640: {
                             slidesPerView: 1,
                             spaceBetween: 16
                         },
                         768: {
                             slidesPerView: 2,
                             spaceBetween: 16
                         },
                         992: {
                             slidesPerView: 2,
                             spaceBetween: 18
                         },
                         1200: {
                             slidesPerView: 3,
                             spaceBetween: 20
                         },
                         1500: {
                             slidesPerView: 3,
                             spaceBetween: 20
                         }
                     }
                 });
             }
     
             function destroySwiperBlogs() {
                 if (blogs_pro) {
                     blogs_pro.destroy(true, true);
                     blogs_pro = null;
                 }
             }
     
             function toggleSwiperBlogs() {
                 if ($(window).width() <= 767 && blogs_pro) {
                     destroySwiperBlogs();
                 } else if ($(window).width() > 767 && !blogs_pro) {
                     initSwiperBlogs();
                 }
             }
             toggleSwiperBlogs();
             $(window).resize(toggleSwiperBlogs);
         }
         lazyBlockProduct('section_blog', '0px 0px -250px 0px', runSwiperBlogs);
     });
  </script>
  <section class="section_brand">
   <div class="container">
      <div class="swiper_brands swiper-container control-top">
         <div class="swiper-wrapper box_list_brand">
          @foreach ($Partner as $item)
          <div class="swiper-slide">
            <div class="item_list_brand">
               <a href="{{$item->link}}" title="{{$item->name}}" class="brand-item">
               <img data-src="{{url($item->image)}}"
                  alt="Makita" width="225" height="113" class="lazyload"
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" />
               </a>
            </div>
         </div>
          @endforeach
         </div>
         <div class="swiper-button-prev"></div>
         <div class="swiper-button-next"></div>
      </div>
   </div>
</section>
<script>
   var swiper_brand = null;
   
   function initSwiperBrand() {
       swiper_brand = new Swiper('.swiper_brands', {
           slidesPerView: 8,
           spaceBetween: 20,
           watchOverflow: true,
           slidesPerGroup: 1,
           navigation: {
               nextEl: '.swiper_brands .swiper-button-next',
               prevEl: '.swiper_brands .swiper-button-prev',
           },
           breakpoints: {
               640: {
                   slidesPerView: 5,
                   spaceBetween: 0
               },
               768: {
                   slidesPerView: 5,
                   spaceBetween: 0
               },
               992: {
                   slidesPerView: 5,
                   spaceBetween: 0
               },
               1024: {
                   slidesPerView: 6,
                   spaceBetween: 0
               },
               1200: {
                   slidesPerView: 8,
                   spaceBetween: 0
               }
           }
       });
   }
   
   function destroySwiperBrand() {
       if (swiper_brand) {
           swiper_brand.destroy(true, true);
           swiper_brand = null;
       }
   }
   
   function toggleSwiperBrand() {
       if ($(window).width() <= 767 && swiper_brand) {
           destroySwiperBrand();
       } else if ($(window).width() > 767 && !swiper_brand) {
           initSwiperBrand();
       }
   }
   toggleSwiperBrand();
   $(window).on('resize', function() {
       toggleSwiperBrand();
   });
</script>
  <div id="js-global-alert" class="alert alert-success" role="alert">
     <button type="button" class="close"><span aria-hidden="true"><span
        aria-hidden="true">&times;</span></span></button>
     <h5 class="alert-heading"></h5>
     <p class="alert-content"></p>
  </div>
</div>
@endsection
