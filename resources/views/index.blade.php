<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Square Off Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/select2.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" class="css"> -->

  </head>
  <body>
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
        <form action="">
            <div class="mb-5">
                <label for="item-name" class="form-label">What's the name of the item?</label>
                <input type="text" id="item-name" class="form-control" aria-describedby="item-name-help-block">
                <div id="item-name-help-block" class="form-text">
                    <small class="text-color">See examples <i class="fa fa-forward"></i> </small>
                </div>
            </div>

            <div class="mb-5">
                <label for="item-name" class="form-label">Does this item have any options (size, color, style, etc)?</label>
                <div id="item-name-help-block" class="form-text">
                    <small class="text-color">See examples <i class="fa fa-forward"></i> </small>
                </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hasNoOptions" name="radio-options" class="custom-control-input" data-toggle="collapse" data-target="#OptionsCollapse">
                            <label class="custom-control-label" for="hasNoOptions">No, this item does not have options.</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hasOptions" name="radio-options" class="custom-control-input" data-toggle="collapse" data-target="#OptionsCollapse" checked>
                            <label class="custom-control-label" for="hasOPtions">Yes, this item has options.</label>
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
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="/js/select-pure.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script src="/js/app.js"></script>

  </body>
</html>
