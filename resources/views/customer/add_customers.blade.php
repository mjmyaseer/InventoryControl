@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-title">Customers</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/customers')}}"
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
                                       id="customer_code"
                                       name="customer_code"
                                       value="@php
                                           if (isset($customers[0]->customer_code))
                                   {
                                   echo $customers[0]->customer_code;
                                   }
                                       @endphp"/>
                                <span id="cus_code" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label>Customer Name</label>
                                <input class="form-control"
                                       placeholder="Customer Name"
                                       type="text"
                                       id="customer_name"
                                       name="customer_name"
                                       value="@php
                                           if (isset($customers[0]->customer_name))
                                   {
                                   echo $customers[0]->customer_name;
                                   }
                                       @endphp"
                                />
                                <span id="cus_name" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control"
                                       placeholder="Email"
                                       id="customer_email"
                                       type="email"
                                       name="customer_email"
                                       value="@php
                                           if (isset($customers[0]->customer_email))
                                   {
                                   echo $customers[0]->customer_email;
                                   }
                                       @endphp"
                                />
                                <span id="cus_email" class="error"></span>
                            </div>
                            <div class="form-group">
                                <label>Telephone</label>
                                <input class="form-control"
                                       placeholder="Telephone"
                                       type="text"
                                       id="customer_telephone"
                                       name="customer_telephone"
                                       value="@php
                                           if (isset($customers[0]->customer_telephone))
                                   {
                                   echo $customers[0]->customer_telephone;
                                   }
                                       @endphp"
                                />
                                <span id="cus_telephone" class="error"></span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control"
                                       placeholder="Address"
                                       type="text"
                                       id="customer_address"
                                       name="customer_address"
                                       value="@php
                                           if (isset($customers[0]->customer_address))
                                   {
                                   echo $customers[0]->customer_address;
                                   }
                                       @endphp"
                                />
                                <span id="cus_address" class="error"></span>
                            </div>
                        </fieldset>
                        <div>
                            <button class="btn btn-primary" type="submit" id="submit">
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
    <script src="../js/app/customers.js"></script>

@endsection