@extends('layout.app_layout')


@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Stocks Available</div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                           id="example">
                        <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Item Name</th>
                            <th>Balance Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $x=1;
                        @endphp
                        @foreach($data as $key=>$item)
                            <tr class="gradeX">
                                <td>{{$x}}</td>
                                <td><a href="{{url("/secure/transactions/{$item->item_id}")}}">{{$item->title}}</a></td>
                                <td>{{$item->quantity}}</td>
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