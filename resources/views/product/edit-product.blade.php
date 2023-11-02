@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Edit Product') }} <strong>{{ $product->name }}</strong></div>
                <div class="card-body">
                    
                    <a href="{{ route('product.index', [ 'product_category' => Crypt::encrypt($product->category_id) ]) }}" class="btn btn-danger m-3 float-left">{{ __('Back') }}</a><br><br><br>
                    <hr>
                    <form method="POST" action="{{ route('product.update', [ 'product' => Crypt::encrypt($product->id) ]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="product_name" class="col-md-2 col-form-label text-md-left">{{ __('Product Name') }}</label>

                            <div class="col-md-5">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->name }}" required autocomplete="name" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_description" class="col-md-2 col-form-label text-md-left">{{ __('Product Description') }}</label>

                            <div class="col-md-5">
                                <input id="product_description" type="text" class="form-control @error('product_description') is-invalid @enderror" name="product_description" value="{{ $product->description }}"  required autocomplete="name" autofocus>

                                @error('product_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">{{ __('Picture') }}</div>
                            <img src="{{ asset('images/'.$product->picture) }}"  width="200" height="200" />
                            <div class="col-md-5 float-right">
                                <input type="file" id="picture" name="picture">
                                <label for="picture">Choose file...</label>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2"><label class="form-label" for="stock">{{ __('Stock') }}</label></div>
                            <div class="form-outline col-md-5 float-right" style="width: 22rem;">
                                <input min="1" type="number" id="stock" name="stock" value="{{ $product->stock }}" class="form-control" />
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
