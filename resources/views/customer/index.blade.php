@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Customers</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/add-customers.html')}}"
                           data-rel="collapse">Add New Customer</a>
                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($customers as $key=>$customer)
                            <tr class="gradeX">
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->customer_code}}</td>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->customer_email}}</td>
                                <td class="center"> {{$customer->customer_telephone}}</td>
                                <td class="center">{{$customer->customer_address}}</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

@endsection