@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Items</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/items.html')}}"
                           data-rel="collapse">Items</a>
                    </div>
                </div>
                <div class="panel-body">


                    <form action="" method="POST" id="frm_item">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <label>Item Title</label>
                                <input class="form-control"
                                       placeholder="Item Title"
                                       type="text"
                                       name="title"/>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control"
                                          placeholder="Description"
                                          name="description" row="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Category Id</label>
                                <select class="form-control"name="category_id">
                                    @foreach($categories as $items)
                                        <option value="{{$items->id}}">{{$items->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Unit Price</label>
                                <input class="form-control"
                                       placeholder="Unit Price"
                                       type="text"
                                       name="unit_price"/>
                            </div>
                            <div class="form-group">
                                <label>Max Retail Price</label>
                                <input class="form-control"
                                       placeholder="Max retail price"
                                       type="text"
                                       name="max_retail_price"/>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label>Quantity</label>--}}
                                {{--<input class="form-control"--}}
                                       {{--placeholder="Quantity"--}}
                                       {{--type="number"--}}
                                       {{--name="quantity"/>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label>Reorder Level</label>
                                <input class="form-control"
                                       placeholder="Reorder level"
                                       type="number"
                                       name="reorder_level"/>
                            </div>
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <select class="form-control"name="supplier_id">
                                    @foreach($supplier as $items)
                                        <option value="{{$items->id}}">{{$items->supplier_name}}</option>
                                    @endforeach
                                </select>
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
    <script src="../js/app/items.js"></script>

@endsection