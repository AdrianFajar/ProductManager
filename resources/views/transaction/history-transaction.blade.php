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
            @if(session()->has('errors'))
                <div class="alert alert-danger">
                    {{ session()->get('errors') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('stock-in') }}" class="btn btn-success col-md-12 mb-2">{{  __('Stock IN') }}</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('stock-out') }}" class="btn btn-danger col-md-12 mb-2">{{  __('Stock OUT') }}</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Transaction History') }}</div>
                <div class="card-body">
                    <a href="{{ route('home') }}" class="btn btn-danger m-3 float-left">{{ __('Back') }}</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col" colspan="3" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product_category as $pc)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $pc->name }}</td>
                                    <td><a href="{{ route('history.show', [ 'history' => Crypt::encrypt($pc->category_id) ]) }}" class="btn btn-primary col-md-12">{{ __('Detail Transaction') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
@endsection
