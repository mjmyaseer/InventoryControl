@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Items</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/items')}}"
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
                                       name="title"
                                       value="@php
                                           if (isset($item[0]->item_title))
                                   {
                                   echo $item[0]->item_title;
                                   }
                                       @endphp"/>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea style="width: 400px; height: 100px" class="form-control"
                                          placeholder="Description"
                                          name="description" row="3">@php
                                        if (isset($item[0]->item_description))
                                {
                                echo $item[0]->item_description;
                                }
                                    @endphp
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Category Id</label>
                                <select class="form-control" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->category_id}}"
                                                @php
                                                    if (isset($item) && $item[0]->item_category_id == $category->category_id)
                                                    {
                                                    echo 'selected';
                                                    }
                                                @endphp

                                        >{{$category->category_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Unit Price</label>
                                <input class="form-control"
                                       placeholder="Unit Price"
                                       type="text"
                                       name="unit_price"
                                       value="@php
                                           if (isset($item[0]->item_unit_price))
                                   {
                                   echo $item[0]->item_unit_price;
                                   }
                                       @endphp"
                                />
                            </div>
                            <div class="form-group">
                                <label>Max Retail Price</label>
                                <input class="form-control"
                                       placeholder="Max retail price"
                                       type="text"
                                       name="max_retail_price"
                                       value="@php
                                           if (isset($item[0]->item_max_retail_price))
                                   {
                                   echo $item[0]->item_max_retail_price;
                                   }
                                       @endphp"
                                />
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
                                       name="reorder_level"
                                       value="@php
                                           if (isset($item[0]->item_reorder_level))
                                   {
                                   echo $item[0]->item_reorder_level;
                                   }
                                       @endphp"
                                />
                            </div>
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <select class="form-control" name="supplier_id">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}"
                                                @php
                                                    if (isset($item) && $item[0]->item_supplier_id == $supplier->id)
                                                    {
                                                    echo 'selected';
                                                    }
                                                @endphp
                                        >{{$supplier->supplier_name}}</option>
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