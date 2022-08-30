@extends('layouts.client')

@section('title', $pageinfo->metaTitle )

@section('description', $pageinfo->metaDescription)

@section('keywords', $pageinfo->metaKeyword)

@section('url', url('/'.$pageinfo->slug))

@section('content')
         <style>
            a{
              color: #1B2A63;
              text-underline-position: none;
             
            }
            a:hover{
              text-decoration: none;
            
            }
         </style>



  <div class="content-wrapper">
    <div class="container">
      <div class="col-sm-12">
        <div class="card" data-aos="fade-up">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="font-weight-600 mb-4">{{$pageinfo->name}}</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                @if(isset($searchList) && $searchList != NULL)
                  @foreach($searchList as $l)
                              
                    <a href="{{url('/cate/'.$l->slugCate.'/'.$l->slug)}}.html" title="{{$l->title}}">
                        <div class="row" style="  cursor: pointer;">
                          <div class="col-sm-4 grid-margin">
                            <div class="rotate-img">
                              <img src="{{asset('uploads/news/'.$l->image)}}" alt="{{$l->image}}" class="img-fluid"/>
                            </div>
                          </div>
                          <div class="col-sm-8 grid-margin">
                              <h2 class="font-weight-600 mb-2">{{$l->title}}</h2>
                              <p class="fs-13 text-muted mb-0">
                                <span class="mr-2">{{$l->category_name}} </span>{{date('d/m/Y',strtotime($l->created_at))}}
                              </p>
                              <p class="fs-15">                         
                                  {{Str::limit($l->summary, $limit = 150, '...') }}
                              </p>
                          </div>
                        </div>
                    </a>
                  @endforeach
                  {{$searchList->links()}}
                @else
                  <h5>Không tìm thấy kết quả nào</h5>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection