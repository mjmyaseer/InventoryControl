@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Sales</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/customers.html')}}"
                           data-rel="collapse">Suppliers</a>
                    </div>
                </div>
                <div class="panel-body">

                    <form action="" method="POST" id="frm_customer">
                        {{csrf_field()}}
                        <fieldset>

                            <div class="form-group">
                                <label>Customer Name</label>
                                <select style="width: 250px" class="form-control" name="customer_id">
                                    <option value="0" selected disabled>Select Customer</option>
                                    @foreach($data['customers'] as $items)
                                        <option value="{{$items->id}}">{{$items->customer_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/>

                            <div id="input_fields_wrap" class="form-group form-inline">
                                <div>
                                    <label>Category</label>&nbsp;
                                    <select class="form-control" style="width: 200px" type="text"
                                            name="order[1][category]">
                                        <option value="0" selected disabled>Select a Category</option>
                                        @foreach($data['categories'] as $items)
                                            <option value="{{$items->id}}">{{$items->title}}</option>
                                        @endforeach
                                    </select>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <label>Item</label>&nbsp;
                                    <select class="form-control" style="width: 200px" type="text"
                                            name="order[1][item]">
                                        <option value="0" selected disabled>Select an Item</option>
                                        @foreach($data['items'] as $items)
                                            <option value="{{$items->id}}">{{$items->title}}</option>
                                        @endforeach
                                    </select>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <label>Quantity</label>&nbsp;
                                    <input class="form-control"
                                           placeholder="Quantity"
                                           type="number"
                                           name="order[1][quantity]"/>&nbsp;

                                    <button type="button" id="add_field_button" class="btn btn-info">Add More Fields
                                    </button>
                                </div>
                            </div>
                            <br/>
                            <label>Purchase Date</label>&nbsp;
                            <div style="width: 200px" class="input-group date" data-provide="datepicker">
                                <div id="sandbox-container">
                                    <input type="text" name="dispatch_date" type="text" class="form-control"/>
                                </div>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <br>

                        </fieldset>

                        <div>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('js')
    <script src="../js/app/invoice.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function () {

            var max_fields = 10; //maximum input boxes allowed

            var wrapper = $("#input_fields_wrap"); //Fields wrapper

            var add_button = $("#add_field_button"); //Add button ID

            var selectid = 1;

            var x = 1; //initlal text box count

            $(add_button).click(function (e) { //on add input button click

                e.preventDefault();

                if (x < max_fields) { //max input allowed

                    x++; //increment

                    selectid += 1;

                    $(wrapper).append('<div>' +

                        '<br> <label>Category</label>&nbsp;' +
                        '  <select class="form-control" style="width: 200px" type="text" name="order[' + (selectid) + '][category]">' +
                        '  <option value="0" selected disabled>Select a Category</option>' +
                        '  @foreach($data["categories"] as $items)' +
                        '  <option value="{{$items->id}}">{{$items->title}}</option>' +
                        '  @endforeach' +
                        '  </select>&nbsp;&nbsp;&nbsp;&nbsp;' +

                        '<label>Item</label>&nbsp;' +
                        ' <select class="form-control" style="width: 200px" type="text" name="order[' + (selectid) + '][item]">' +
                        '  <option value="0" selected disabled>Select an </option>' +
                        '  @foreach($data["items"] as $items)' +
                        '  <option value="{{$items->id}}">{{$items->title}}</option>' +
                        '  @endforeach' +
                        ' </select>&nbsp;&nbsp;&nbsp;&nbsp;' +

                        '<label>Quantity   </label>&nbsp;' +
                        '<input class="form-control" placeholder="Quantity" type="number" name="order[' + (selectid) + '][quantity]"/>&nbsp;' +

                        '<a href="#" class="remove_field">Remove</a>' +

                        '</div>'); //add input

                }

            });

        });
    </script>
@endsection