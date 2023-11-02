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
                <div class="card-header">{{ __('Product List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-danger m-3 float-left">{{ __('Back') }}</a>
                    <a href="{{ route('product.create', [ 'product_category' => Crypt::encrypt($product_category) ] ) }}" class="btn btn-primary m-3 float-right">{{ __('Add New') }}</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pict</th>
                                <th scope="col">Name</th>
                                <th scope="col">Stock</th>
                                <th scope="col" colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $p)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img src="{{ asset('images/'.$p->picture) }}"  width="100" height="100" /></td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->stock }}</td>
                                    <td>
                                        <a href="{{ route('product.show', [ 'product' => Crypt::encrypt($p->id) ]) }}" class="btn btn-warning col-md-12">{{ __('Edit') }}</a>
                                    </td>
                                    <td>
                                        <form id="destroy-form" action="{{ route('product.destroy', [ 'product' => Crypt::encrypt($p->id) ]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger col-md-12">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
