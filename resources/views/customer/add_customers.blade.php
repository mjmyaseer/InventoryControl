@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Customers</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/customers.html')}}"
                           data-rel="collapse">Customers</a>
                    </div>
                </div>
                <div class="panel-body">


                    <form action="" method="POST" id="frm_customer">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <label>Customer Code</label>
                                <input class="form-control"
                                       placeholder="Customer Code"
                                       type="text"
                                       name="customer_code"/>
                            </div>
                            <div class="form-group">
                                <label>Customer Name</label>
                                <textarea class="form-control"
                                          placeholder="Customer Name"
                                          name="customer_name" row="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control"
                                       placeholder="Email"
                                       type="email"
                                       name="customer_email"/>
                            </div>
                            <div class="form-group">
                                <label>Telephone</label>
                                <input class="form-control"
                                       placeholder="Telephone"
                                       type="text"
                                       name="customer_telephone"/>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control"
                                       placeholder="Address"
                                       type="text"
                                       name="customer_address"/>
                            </div>
                        </fieldset>
                        <div>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('js')
    <script src="/js/app/customers.js"></script>

@endsection