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
                <div class="card-header">{{ __('Add Product Category') }}</div>

                <div class="card-body">
                    <a href="{{ route('home') }}" class="btn btn-danger m-3 float-left">{{ __('Back') }}</a><br><br><br>
                    <hr>
                    <form method="POST" action="{{ route('product-category.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="category_name" class="col-md-2 col-form-label text-md-left">{{ __('Category Name') }}</label>

                            <div class="col-md-5">
                                <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="" required autocomplete="name" autofocus>

                                @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_description" class="col-md-2 col-form-label text-md-left">{{ __('Category Description') }}</label>

                            <div class="col-md-5">
                                <input id="category_description" type="text" class="form-control @error('category_description') is-invalid @enderror" name="category_description"  required autocomplete="name" autofocus>

                                @error('category_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="register_password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="register_password-confirm" type="password" class="form-control" name="register_password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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
