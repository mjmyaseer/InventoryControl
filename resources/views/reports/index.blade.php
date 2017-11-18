@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Reports</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/add-customers.html')}}"
                           data-rel="collapse">Add New Customer</a>
                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <form action="" method="POST" id="frm_customer" class="form-inline">
                        {{csrf_field()}}

                        <label>Category</label>&nbsp;
                        <select class="form-control" style="width: 200px" type="text"
                                name="report_category">
                            <option value="0" selected disabled>Select to Print</option>
                            <option value="1">Sales</option>
                            <option value="2">Purchase</option>
                            <option value="3">Sales Returns</option>
                            <option value="4">Purchase Returns</option>
                        </select>&nbsp;&nbsp;

                        <label>Start Date</label>&nbsp;
                        <div style="width: 200px" class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <div id="sandbox-container">
                                <input type="text" name="start_date" type="text" class="form-control"/>
                            </div>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        &nbsp;
                        <label>End Date</label>&nbsp;
                        <div style="width: 200px" class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <div id="sandbox-container">
                                <input type="text" name="end_date" type="text" class="form-control"/>

                            </div>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-print"></i>
                            Print
                        </button>

                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('js')
    <script src="../js/app/reports.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
@endsection