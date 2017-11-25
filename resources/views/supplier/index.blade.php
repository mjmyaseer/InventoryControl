@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Suppliers</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/add-suppliers.html')}}"
                           data-rel="collapse">Add New Supplier</a>
                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Supplier Code</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th style="text-align: center">Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($suppliers as $key=>$supplier)
                            <tr class="gradeX">
                                <td>{{$supplier->id}}</td>
                                <td>{{$supplier->supplier_code}}</td>
                                <td>{{$supplier->supplier_name}}</td>
                                <td class="center"> {{$supplier->supplier_telephone}}</td>
                                <td class="center">{{$supplier->supplier_address}}</td>
                                <td style="text-align: center"><a href="#" >Edit</a></td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

@endsection