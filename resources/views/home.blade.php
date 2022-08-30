@extends('layouts.app')
@section('title', 'Trang quản trị Website')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Trang quản trị') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Xin chào !') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
