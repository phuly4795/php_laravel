@extends('layouts.client')

@section('title', $pageinfo->metaTitle)

@section('description', $pageinfo->metaDescription)

@section('keywords', $pageinfo->metaKeyword)

@section('url', url('/'.$pageinfo->slug))

@section('content')
         
<div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="card" data-aos="fade-up">
            <div class="card-body">
              <div class="aboutus-wrapper">
                
                <p class="font-weight-600 fs-15">
                 {!!$pageinfo->mota!!}
                </p>
                
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


@endsection