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
            <a href="{{ route('history.index') }}" class="btn btn-success m-2">{{  __('Transaction') }}</a>
            <div class="card">
                <div class="card-header">{{ __('Product Category') }}</div>

                <div class="card-body col-md-12">
                    <a href="{{ route('product-category.index') }}" class="btn btn-primary m-3 float-right">{{ __('Add New') }}</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" colspan="3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product_category as $pc)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $pc->name }}</td>
                                    <td>
                                        <a href="{{ route('product.index', [ 'product_category' => Crypt::encrypt($pc->category_id) ]) }}" class="btn btn-primary col-md-12">{{ __('List Produk') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('product-category.edit', [ 'product_category' => Crypt::encrypt($pc->category_id) ]) }}" class="btn btn-warning col-md-12">{{ __('Edit') }}</a>
                                    </td>
                                    <td>
                                        <form id="destroy-form" action="{{ route('product-category.destroy', [ 'product_category' => Crypt::encrypt($pc->category_id) ]) }}" method="POST">
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
