<footer class="footer">
  <div class="mid-footer">
     <div class="container">
        <div class="row">
           <div class="col-12 col-lg-4 ft-info">
              <a href="/" class="logo_foo" title="Logo">
              <img width="378" height="96"
                 src="{{$setting->logo}}"
                 alt="{{$setting->webname}}">
              </a>
              <div class="des_foo">
                 {!!$setting->company!!} <br>
              </div>
              <div class="list_phone_foo">
                 <a href="tel:{{$setting->phone1}}" title="{{$setting->phone1}}">
                 Tư vấn mua hàng <span>{{$setting->phone1}}</span>
                 </a>
              </div>
           </div>
           <div class="col-12 col-lg-5 ft-menu">
              <div class="row">
                 <div class="col-12 col-sm-6 link-list col-footer footer-click">
                    <h4 class="title-menu title-menu2">
                       Chính sách
                    </h4>
                    <ul class="list-menu hidden-mobile">
                      @foreach ($pageContent as $item)
                      
                          @if ($item->type === 'ho-tro-khanh-hang')
                          <li><a href="{{route('pagecontent',['slug'=>$item->slug])}}" title="{{$item->title}}">{{$item->title}}</a>
                          </li>
                          @endif
                      @endforeach
                    </ul>
                 </div>
                 <div class="col-12 col-sm-6 link-list col-footer footer-click">
                    <h4 class="title-menu title-menu2">
                       Menu nhanh
                    </h4>
                    <ul class="list-menu hidden-mobile">
                      @foreach ($categoryhome as $item)
                      <li><a href="{{route('allListProCate',['danhmuc'=>$item->slug])}}" title="{{languageName($item->name)}}">{{languageName($item->name)}}</a>
                      </li>
                      @endforeach
                       <li><a href="{{route('fag')}}" title="Câu hỏi thường gặp">Câu hỏi thường
                          gặp</a>
                       </li>
                       <li><a href="{{route('lienHe')}}" title="Liên hệ">Liên hệ</a></li>
                    </ul>
                 </div>
              </div>
           </div>
           <div class="col-12 col-lg-3">
              <h4 class="title-menu">
                 Thông tin liên hệ
              </h4>
              <div class="list-menu toggle-mn">
                 <div class="content-contact clearfix">
                    <span class="list_footer">
                    <b>Địa chỉ: </b>
                    {!!$setting->address1!!}
                    </span>
                 </div>
                 <div class="content-contact clearfix">
                    <span class="list_footer">
                    <b>Điện thoại: </b>
                    <a title="{{$setting->phone1}}" href="tel:{{$setting->phone1}}">
                    {{$setting->phone1}}
                    </a>
                    </span>
                 </div>
                 <div class="content-contact clearfix">
                    <span class="list_footer">
                    <b>Email: </b>
                    <a title="{{$setting->email}}"
                       href="mailto:{{$setting->email}}">
                    {{$setting->email}}
                    </a>
                    </span>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
  <div id="copyright" class="copyright">
     <div class="container">
        <div class="row">
           <div class="col-12 col-lg-12">
              <span class="copy-right">© Bản quyền thuộc về <b>Quà Tặng Mạ Vàng</b></span>
              <span class="opacity1"> <span class="dash hidden-xs">|</span> Cung cấp bởi
              <a href=""
                 rel="noopener" title="Tuấn Anh Dev" target="_blank">Tuấn Anh Dev</a>
              </span>
           </div>
        </div>
     </div>
  </div>
</footer>