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
                    <div class="panel-title">Suppliers</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/suppliers')}}"
                           data-rel="collapse">Suppliers</a>
                    </div>
                </div>
                <div class="panel-body">


                    <form action="" method="POST" id="frm_supplier">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <label>Supplier Code</label>
                                <input class="form-control"
                                       placeholder="Supplier Code"
                                       type="text"
                                       name="supplier_code"
                                       value="@php
                                           if (isset($suppliers[0]->supplier_code))
                                   {
                                   echo $suppliers[0]->supplier_code;
                                   }
                                       @endphp"
                                />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <input class="form-control"
                                       placeholder="Supplier Name"
                                       type="text"
                                       name="supplier_name"
                                       value="@php
                                           if (isset($suppliers[0]->supplier_name))
                                   {
                                   echo $suppliers[0]->supplier_name;
                                   }
                                       @endphp"
                                />
                            </div>

                            <div class="form-group">
                                <label>Telephone</label>
                                <input class="form-control"
                                       placeholder="Telephone"
                                       type="text"
                                       name="supplier_telephone"
                                       value="@php
                                           if (isset($suppliers[0]->supplier_telephone))
                                   {
                                   echo $suppliers[0]->supplier_telephone;
                                   }
                                       @endphp"
                                />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control"
                                       placeholder="Email"
                                       type="text"
                                       name="supplier_email"
                                       value="@php
                                           if (isset($suppliers[0]->supplier_email))
                                   {
                                   echo $suppliers[0]->supplier_email;
                                   }
                                       @endphp"
                                />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control"
                                       placeholder="Address"
                                       type="text"
                                       name="supplier_address"
                                       value="@php
                                           if (isset($suppliers[0]->supplier_address))
                                   {
                                   echo $suppliers[0]->supplier_address;
                                   }
                                       @endphp"
                                />
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
    <script src="/js/app/suppliers.js"></script>

@endsection