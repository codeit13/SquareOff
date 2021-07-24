@extends('_layouts/main')

@section('title','SquareOff')

@section('main-content')
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed !important">
        <div class="toast-header">
            <strong class="mr-auto">SquareOff</strong>
            <button type="button" class="ml-2 mb-1 close" style="margin-left: auto !important;" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Order have been successfully inserted in Database.
        </div>
        </div>
    <div class="wrapper">
            <div class="mb-5">
                <label for="item-name" class="form-label">What's the name of the item?</label>
                <input type="text" id="item-name" class="form-control" aria-describedby="item-name-help-block">
                <div id="item-name-help-block" class="form-text">
                    <small class="text-color">See examples <i class="fa fa-forward"></i> </small>
                </div>
            </div>

            <div class="mb-5">
                <label for="item-mrp" class="form-label">MRP of the Item</label>
                <input type="text" id="item-mrp" class="form-control" aria-describedby="item-mrp-help-block">
                <div id="item-mrp-help-block" class="form-text">
                    <small class="text-color">See examples <i class="fa fa-forward"></i> </small>
                </div>
            </div>
            <form id="order-data-form" action="" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="item-image" class="form-label">Items Image</label>
                    <input type="file" id="image-input" name="file" class="form-control" aria-describedby="item-image-help-block">
                    <div id="item-image-help-block" class="form-text">
                        <span class="text-danger" id="image-input-error"></span>
                    </div>
                </div>
            </form>

            <div class="mb-5">
                <label for="item-name" class="form-label mb-0">Does this item have any options (size, color, style, etc)?</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hasNoOptions" name="radio-options" class="custom-control-input" data-toggle="collapse" data-target="#OptionsCollapse">
                            <label class="custom-control-label" for="hasNoOptions">No, this item does not have options.</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hasOptions" name="radio-options" class="custom-control-input" data-toggle="collapse" data-target="#OptionsCollapse" checked>
                            <label class="custom-control-label" for="hasOPtions">Yes, this item has options.</label>
                        </div>
                        <div id="item-name-help-block" class="form-text">
                            <small class="text-color">See examples <i class="fa fa-forward"></i> </small>
                        </div>
            </div>
            <div class="collapse" id="OptionsCollapse">
                <div class="bg-gray p-3 mb-5">
                    <div class="row">
                        <div class="col">
                            <p class="font-weight-bold">Option Name</p>
                        </div>
                        <div class="col">
                            <p class="font-weight-bold">Option Value</p>
                        </div>
                    </div>
                    <div id="options-div">
                        <div class="row align-items-center">
                            <div class="col">
                                <input type="text" class="form-control option-name" placeholder="Enter the Option Name" value="Color">
                            </div>
                            <div class="col">
                                <select class="option-value" id="option-value option-1" multiple="multiple">
                                    <option value="RED">RED</option>
                                    <option value="BLUE">BLUE</option>
                                    <option value="GREEN">GREEN</option>
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center mt-2">
                            <div class="col">
                                <input type="text" class="form-control option-name" placeholder="Enter the Option Name" value="Size">
                            </div>
                            <div class="col">
                            <select class="option-value" id="option-value option-2" multiple="multiple">
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="XL">XL</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <small class="font-weight-bold mt-2" id="add-options" style="cursor: pointer;">+ Add Option</small>
                </div>
                <div class="mb-5">
                <div class="row mt-4">
                    <div class="col">
                        <a class="btn btn-block btn-color" id="generate-variants">Generate Variants</a>
                    </div>
                </div>
                <div class="row align-items-center mt-5 d-none" id="generated-variants">
                    <table class="table" id="generated-variants-table">
                        <thead>

                        </thead>
                    </table>
                </div>
            </div>

            <div class="mb-5">
                <a class="btn btn-lg btn-block btn-color d-none" id="saveToDatabase">Save Order</a>
            </div>

    </div>
@endsection

@section('page-scripts')
    <script src="/js/app.js"></script>
@endsection