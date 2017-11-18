@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Items</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/add-items.html')}}"
                           data-rel="collapse">Add New Item</a>
                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Title</th>
                            <th>Unit Price</th>
                            <th>Reorder Level</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($items as $key=>$item)
                            <tr class="gradeX">
                                <td>{{$item->id}}</td>
                                <td><a href="{{url("/secure/view-item.html/{$item->id}")}}">{{$item->title}}</a></td>
                                <td>{{$item->unit_price}}</td>
                                <td class="center"> {{$item->reorder_level}}</td>
                                <td class="center">{{$item->quantity}}</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

@endsection