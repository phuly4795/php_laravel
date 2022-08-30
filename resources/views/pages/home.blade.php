@extends('layouts.client')

@section('title', $pageinfo->metaTitle)

@section('description', $pageinfo->metaDescription)

@section('keywords', $pageinfo->metaKeyword)

@section('url', url('/'))


@section('content')
<style>
  a{
    color: #1B2A63;
    text-underline-position: none;
   
   cursor: pointer !important;
  }
  a:hover{
    text-decoration: none;
    cursor: pointer !important;
  }
  .aa:hover{
    color:darkslateblue !important;
  }



</style>
<div class="content-wrapper">
  <div class="container">
    <div class="row" data-aos="fade-up">
      @foreach($banner as $n)
      
      <div class="col-xl-8 stretch-card grid-margin">
        <div class="position-relative" style="min-width: 100%; " >      
            <img src="{{asset('uploads/news/'.$n->image)}}"  style="width: 100%; height:70vh" alt="banner" class="img-fluid" />       
          <div class="banner-content" >           
            <h1 class="mb-2">
              <a href="{{url('/cate/'.$n->slugCate.'/'.$n->slug)}}.html" title="{{$n->title}}" style="color: white; cur" class="aa">
                {{$n->title}}
              </a>
            </h1>      
            <div class="fs-12">
              <span class="mr-2">{{$n->category_name}} </span>{{date('d/m/Y',strtotime($n->created_at))}}
            </div>
          </div>
        </div>
      </div>
    
    @endforeach
      <div class="col-xl-4 stretch-card grid-margin">    
        <div class="card bg-dark text-white">    
          <div class="card-body">
            <h2>Tin HOT</h2>
            @foreach($newsHot as $key =>$n)
            <a href="{{url('/cate/'.$n->slugCate.'/'.$n->slug)}}.html" title="{{$n->title}}" style="color: white" class="aa">
            <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
              <div class="pr-3">
                <h5>{{Str::limit($n->title, $limit = 100,'...')}}</h5>
                <div class="fs-12">
                  <span class="mr-2">{{$n->category_name}} </span>{{date('d/m/Y',strtotime($n->created_at))}}        
                </div>
              </div>
              <div class="rotate-img">
                <img src="{{asset('uploads/news/'.$n->image)}}" alt="{{$n->image}}" class="img-fluid img-lg" />
              </div>
            </div>
            </a>
            @endforeach
          </div>
        
        </div>
      
      </div>
     
    </div>
   
    <div class="row" data-aos="fade-up">
      <div class="col-lg-3 stretch-card grid-margin">
        <div class="card">
          <div class="card-body">
            <h2>Nhiều lượt xem</h2>
            <ul class="vertical-menu">
              @foreach($newsViews as $key => $n)
              
                <li><a href="{{url('/cate/'.$n->slugCate.'/'.$n->slug)}}.html" title="{{$n->title}}" >{{$n->title}} <span>({{$n->view}})</span></a></li>
             
              @endforeach            
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9 stretch-card grid-margin">
        <div class="card">
          <div class="card-body">
            @foreach($newsLatest as $key =>$n)
            <a href="{{url('/cate/'.$n->slugCate.'/'.$n->slug)}}.html" title="{{$n->title}}">
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="position-relative">
                  <div class="rotate-img">
                    <img src="{{asset('uploads/news/'.$n->image)}}" alt="thumb" class="img-fluid"/>
                  </div>
                  <div class="badge-positioned">
                    <span class="badge badge-danger font-weight-bold">{{$n->category_name}}</span>
                  </div>
                </div>
              </div>
              <div class="col-sm-8  grid-margin">
                <h2 class="mb-2 font-weight-600">
                 {{$n->title}}
                </h2>
                <div class="fs-13 mb-2">
                  <span class="mr-2">{{$n->category_name}} </span>{{date('d/m/Y',strtotime($n->created_at))}}
                </div>
                <p class="mb-0">
                  {{Str::limit($n->summary, $limit = 100, '...') }}
                </p>
              </div>
            </div>  
            </a>  
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="row" data-aos="fade-up">
      <div class="col-sm-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8">
                <div class="card-title">
                  Video
                </div>           
                <div class="row">
                  @foreach($videoHot as $v)             
                  <div class="col-sm-6 grid-margin">
                    <a href="{{url('/cate/'.$v->slugCate.'/'.$v->slug)}}.html" title="{{$v->title}}">
                    <div class="position-relative">
                      <div class="rotate-img">
                          <img src="{{asset('uploads/news/'.$v->image)}}" style="min-width: 100%; min-height: 35vh;" title="{{$v->title}}" alt="{{$v->image}}" class="img-fluid"/>
                      </div>
                      <div class="badge-positioned w-90">
                        <div class="d-flex justify-content-between align-items-center">
                          <span class="badge badge-danger font-weight-bold">{{$v->category_name}}</span>
                          <div class="video-icon">
                            <i class="mdi mdi-play"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  </div>       
                  @endforeach                            
                </div>
            
              </div>
              <div class="col-lg-4">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="card-title">
                    Video xem nhiều
                  </div>
                  <p class="mb-3"><a href="{{url('/cate/video')}}">Xem tất cả</a></p>
                </div>
                @foreach($videoViews as $v)
                <a href="{{url('/cate/'.$v->slugCate.'/'.$v->slug)}}.html" title="{{$v->title}}" >
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                  <div class="div-w-80 mr-3">
                    <div class="rotate-img">
                      <img src="{{asset('uploads/news/'.$v->image)}}" title="{{$v->title}}" alt="{{$v->image}}" class="img-fluid"/>
                    </div>
                  </div>
                  <h3 class="font-weight-600 mb-0">
                    {{$v->title}}
                  </h3>
                </div>
                </a>
                @endforeach
           
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row" data-aos="fade-up" style=" margin-top:5%">
      <div class="col-sm-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-xl-12">
                <div class="input-group mb-3">
                    <h4  style="line-height: 45px;margin-right: 3%;color: #032a63;font-weight: 700;">Đăng kí nhận tin mới nhất: </h4>          
                    <input type="text" id="txtEmailSub" name="subEmail" class="form-control" placeholder="Nhập địa chỉ email..."aria-label="Recipient's username" aria-describedby="button-addon2" >
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" name="buttonSend" id="btnSendSub">Gửi</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
     
@endsection