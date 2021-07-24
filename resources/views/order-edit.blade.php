@extends('_layouts/main')

@section('title','SquareOff')

@section('main-content')
<div class="wrapper">
    <form action="">
        <input type="hidden" id="order-id" value="{{ $id }}">
        <div class="mb-5">
                <label for="item-name" class="form-label">What's the name of the item?</label>
                <input type="text" id="item-name" class="form-control" aria-describedby="item-name-help-block" value="{{ $name }}" readonly>
                <div id="item-name-help-block" class="form-text">
                    <small class="text-color">See examples <i class="fa fa-forward"></i> </small>
                </div>
            </div>

            <div class="mb-5">
                <label for="item-mrp" class="form-label">MRP of the Item</label>
                <input type="text" id="item-mrp" class="form-control" aria-describedby="item-mrp-help-block" value="{{ $mrp }}" readonly>
                <div id="item-mrp-help-block" class="form-text">
                    <small class="text-color">See examples <i class="fa fa-forward"></i> </small>
                </div>
            </div>
            <form id="order-data-form" action="" enctype="multipart/form-data">
                <div class="mb-5">
                    <label for="item-image" class="form-label">Items Image</label>
                    <br>
                    <img width="200" src="{{ $image_path }}">
                </div>
            </form>
        <div class="row align-items-center my-4" id="generated-variants">
            <table class="table" id="generated-variants-table">
                <thead></thead>
            </table>
        </div>
        <div class="mb-5">
            <a class="btn btn-lg btn-block btn-color" id="saveToDatabase">Save Order</a>
        </div>
    </form>
</div>
@endsection

@section('page-scripts')
    <script src="/js/admin.js"></script>
@endsection