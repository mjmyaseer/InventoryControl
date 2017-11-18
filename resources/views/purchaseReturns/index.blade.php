@extends('layout.app_layout')

@section("content")

    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Purchase Returns</div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                           id="example">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Supplier Name</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $x =1
                        @endphp
                        @foreach($purchaseReturns as $item)
                            <tr class="gradeX">
                                <td>{{$x}}</td>
                                <td>{{$item->supplier_name}}</td>
                                <td>{{$item->item_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->created_at}}</td>
                                @php
                                    $x++
                                @endphp
                            </tr>


                        @endforeach

                        </tbody>
                    </table>

                </div>


            </div>
        </div>

    </div>

@endsection