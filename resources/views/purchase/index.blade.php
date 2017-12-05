@extends('layout.app_layout')

@section("content")
    <?php
    //print_r($purchase['request']->session()->get('role'));exit();
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Orders</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/add-purchase')}}"
                           data-rel="collapse">New Purchase</a>
                        <a href="{{url('/secure/purchase')}}" data-rel="reload"><i
                                    class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="input_fields_wrap" class="form-group form-inline">
                        <div>
                            <label>Search By Purchaser Name</label>&nbsp;
                            <input class="form-control"
                                   placeholder="Search"
                                   type="text"
                                   style="widows: 50px;"
                                   name="search_txt"
                                   id="search_txt"/>&nbsp;

                            <button type="button" id="search_button" class="btn btn-info">Search
                            </button>
                            <span id="sear_txt" class="error"></span>
                        </div>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                           id="example">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Supplier Name</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Return</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php

                            $x =1;
                        @endphp
                        @foreach($purchase['purchase'] as $category)
                            <tr class="gradeX">

                                @php

                                    if($category->status ==2 )
                                    {
                                    $name = 'Order Returned';
                                    $status = 'disabled';
                                    }else{
                                     $name = 'Return Order';
                                     $status = '';
                                    }

                                @endphp

                                <td>{{$x}}</td>
                                <td>{{$category->supplier_name}}</td>
                                <td>{{$category->title}}</td>
                                <td>{{$category->quantity}}</td>
                                <td>{{$category->order_date}}</td>
                                @php
                                    if ($purchase['request']->session()->get('role') == 1){
                                @endphp
                                <td width="20px"><!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#myModal-{{$category->id}}" {{$status}}>
                                        {{$name}}
                                    </button>
                                </td>
                                @php
                                    }else{
                                @endphp
                                <td width="20px"><!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#myModal-{{$category->id}}" {{$status}} disabled>
                                        {{$name}}
                                    </button>
                                </td>
                                @php
                                    }

                                        $x++
                                @endphp
                            </tr>

                            <!-- Modal -->
                            <div id="myModal-{{$category->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Modal Header</h4>
                                        </div>
                                        <div class="modal-body">


                                            <form action="" method="POST" id="frm_purchase_returns">
                                                <fieldset>
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label>Supplier Name</label>
                                                        <input class="form-control"
                                                               value="{{$category->supplier_name}}"
                                                               type="text"
                                                               name="supplier_name" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Item</label>
                                                        <input class="form-control"
                                                               value="{{$category->title}}"
                                                               type="text"
                                                               name="item_name" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input class="form-control"
                                                               value="{{$category->quantity}}"
                                                               type="text"
                                                               name="quantity" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Order Date</label>
                                                        <input class="form-control"
                                                               value="{{$category->order_date}}"
                                                               type="text"
                                                               name="order_date" readonly/>
                                                    </div>

                                                    {{-- Passing the ID's as Hidden Values--}}

                                                    <div class="form-group">
                                                        <input class="form-control"
                                                               value="{{$category->item_id}}"
                                                               type="hidden"
                                                               name="item"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control"
                                                               value="{{$category->supplier_id}}"
                                                               type="hidden"
                                                               name="supplier_id"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control"
                                                               value="{{$category->supplier_id}}"
                                                               type="hidden"
                                                               name="Purchase_returns"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control"
                                                               value="{{$category->id}}"
                                                               type="hidden"
                                                               name="Purchase_id"/>
                                                    </div>
                                                </fieldset>
                                                <div>
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fa fa-save"></i>
                                                        Return
                                                    </button>
                                                </div>
                                            </form>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--End Modal -->

                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="../js/app/grnIndex.js"></script>
@endsection
