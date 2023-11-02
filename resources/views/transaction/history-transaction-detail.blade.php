@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Transaction History Category ') }}<strong>{{ $category }}</strong></div>
                <div class="card-body">
                    <a href="{{ route('history.index') }}" class="btn btn-danger m-3 float-left">{{ __('Back') }}</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total Transaction</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $h)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $h->name }}</td>
                                    <td>{{ $h->total }}</td>
                                    @if($h->type == "in")
                                        <td><button class="btn btn-success" disabled>{{ $h->type }}</button></td>
                                    @else
                                        <td><button class="btn btn-danger" disabled>{{ $h->type }}</button></td>
                                    @endif
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
