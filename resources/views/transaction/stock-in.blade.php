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
                <div class="card-header">{{ __('Stock IN') }}</div>
                <a href="{{ route('history.index') }}" class="btn btn-danger m-3 float-left col-md-1">{{ __('Back') }}</a>
                <div class="card-body">
                    <form method="POST" action="{{ route('stock-in.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="form-label" for="total">{{ __('Product') }}</label>
                            </div>
                        </div>
                        <div class="field_wrapper">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <select class="form-control" id="product" name="product[]">
                                        @foreach($product as $pc)
                                            <option value="{{ $pc->name }}">{{ $pc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-outline col-md-3 float-right" style="width: 22rem;">
                                    <input min="1" type="number" id="total" placeholder="total" name="total[]" class="form-control" />
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0);" class="add_button btn btn-primary">{{ __('+') }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="field_wrapper">
                                <div>
                                    <input type="text" name="field_name[]" value=""/>
                                    <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png"/></a>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Stock In') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; 
    var x = 1; 
    var addButton = $('.add_button'); 
    var wrapper = $('.field_wrapper');
    var removeID = 1;
    var fieldHTML = '<div class="form-group row"><div class="col-md-3"><select class="form-control" id="product" name="product[]">@foreach($product as $pc)<option value="{{ $pc->name }}">{{ $pc->name }}</option>@endforeach</select></div><div class="form-outline col-md-3 float-right" style="width: 22rem;"><input min="1" type="number" id="total" placeholder="total" name="total[]" class="form-control" /></div><div class="col-md-1"><a href="javascript:void(0);" class="remove_button btn btn-danger">{{ __('-') }}</a></div></div>'; 
    
    
    $(addButton).click(function(){
        if(x < maxField){ 
            x++;
            $(wrapper).append(fieldHTML); 
        }
    });
    
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); 
        x--; 
    });
});
</script>
@endsection
