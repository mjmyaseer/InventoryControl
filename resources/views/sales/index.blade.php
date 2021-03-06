@extends('layout.app_layout')

@section("content")

    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Sales</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/add-sales.html')}}"
                           data-rel="collapse">New Sales</a>
                        <a href="{{url('sales')}}" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                           id="example">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Customer Name</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Dispatch Date</th>
                            <th>Return</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $x =1
                        @endphp
                        @foreach($sales as $category)
                            <tr class="gradeX">

                                @php

                                    if($category->status == 2 )
                                    {
                                    $name = 'Order Returned';
                                    $status = 'disabled';
                                    }else{
                                     $name = 'Return Order';
                                     $status = '';
                                    }

                                @endphp

                                <td>{{$x}}</td>
                                <td>{{$category->customer_name}}</td>
                                <td>{{$category->title}}</td>
                                <td>{{$category->total}}</td>
                                <td>{{$category->dispatch_date}}</td>
                                <td width="20px"><!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#myModal-{{$category->id}}" {{$status}}>
                                        {{$name}}
                                    </button>
                                </td>
                                @php
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


                                            <form action="" method="POST" id="frm_sales_returns">
                                                <fieldset>
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label>Customer Name</label>
                                                        <input class="form-control"
                                                               value="{{$category->customer_name}}"
                                                               type="text"
                                                               name="customer_name" readonly/>
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
                                                               value="{{$category->total}}"
                                                               type="text"
                                                               name="quantity" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Dispatch Date</label>
                                                        <input class="form-control"
                                                               value="{{$category->dispatch_date}}"
                                                               type="text"
                                                               name="dispatch_date" readonly/>
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
                                                               value="{{$category->customer_id}}"
                                                               type="hidden"
                                                               name="customer_id"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control"
                                                               value="{{$category->customer_id}}"
                                                               type="hidden"
                                                               name="Sales_returns"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control"
                                                               value="{{$category->id}}"
                                                               type="hidden"
                                                               name="Sales_id"/>
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
                    <div class="col-sm-12">
                        <ul class="pagination pull-right"></ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

