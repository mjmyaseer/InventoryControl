@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel-title">Reports</div>


                <div class="panel-body">

                    <form action="" method="POST" id="frm_customer" class="form-inline">
                        {{csrf_field()}}

                        <label>Category</label>&nbsp;
                        <select class="form-control" style="width: 200px" type="text"
                                name="report_category" id="category">
                            <option value="0" selected disabled>Select to Print</option>
                            <option value="1">Sales</option>
                            <option value="2">Purchase</option>
                            <option value="3">Sales Returns</option>
                            <option value="4">Purchase Returns</option>
                        </select>&nbsp;&nbsp;
                        <span id="cate" class="error"></span>

                        <label>Start Date</label>&nbsp;
                        <div style="width: 200px" class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <div id="sandbox-container">
                                <input type="text" name="start_date" type="text" class="form-control" id="startdate"/>
                                <span id="start" class="error"></span>
                            </div>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        &nbsp;
                        <label>End Date</label>&nbsp;
                        <div style="width: 200px" class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <div id="sandbox-container">
                                <input type="text" name="end_date" type="text" class="form-control" id="enddate" />
                                <span id="end" class="error"></span>

                            </div>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <button class="btn btn-primary" type="submit" id="submit">
                            <i class="fa fa-print"></i>
                            Print
                        </button>
                        <button class="btn btn-primary" type="submit" id="export" name="export" value="1">
                            <i class="fa fa-export"></i>
                            Export
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

    <script>

//        $("#export").click(function () {
//
//            var category = $("#category").val();
//            var startdate = $("#startdate").val();
//            var enddate = $("#enddate").val();
//
//            $.ajax({
//                url: "/InventoryControl/public/secure/asd",
//                type: "GET",
//                 data: {category: category, startdate: startdate, enddate: enddate},
//                dataType: "json",
//                success: function (data) {
//                    console.log(data);
//
//                    if (data.result == "success")
//                    {
//                            alert('success');
//
//                    } else {
//                        alert('success');
//                        }
//                },
//                error: function (data) {
//
//                }
//            });
//        });

    </script>
@endsection