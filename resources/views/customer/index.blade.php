@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Customers</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/add-customers')}}"
                           data-rel="collapse">Add New Customer</a>
                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <div id="input_fields_wrap" class="form-group form-inline">
                        <div>
                            <label>Search By Customer Name</label>&nbsp;
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

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th style="text-align: center">Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($customers as $key=>$customer)
                            <tr class="gradeX">
                                <td>{{$customer->customer_id}}</td>
                                <td>{{$customer->customer_code}}</td>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->customer_email}}</td>
                                <td class="center"> {{$customer->customer_telephone}}</td>
                                <td class="center">{{$customer->customer_address}}</td>
                                <td style="text-align: center"><a href="{{url("/secure/add-customers/{$customer->customer_id}")}}" >Edit</a></td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

@endsection


@section('js')
    <script src="../js/app/customerIndex.js"></script>
@endsection