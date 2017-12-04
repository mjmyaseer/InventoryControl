@extends('layout.app_layout')


@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Transactions</div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                           id="example">
                        <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Item Name</th>
                            <th>Customer Name</th>
                            <th>Supplier Name</th>
                            <th>Reference Number</th>
                            <th>Transaction Type</th>
                            <th>Quantity</th>
                            <th>Transaction Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $x=1;
                        @endphp
                        @foreach($data as $key=>$item)
                            <tr class="gradeX">
                                <td>{{$x}}</td>
                                <td>{{$item->item_name}}</td>
                                <td>{{$item->customer_name}}</td>
                                <td>{{$item->supplier_name}}</td>
                                <td>{{$item->reference_number}}</td>
                                <td>{{$item->transaction_type}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                            @php
                                $x++;
                            @endphp
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

@endsection