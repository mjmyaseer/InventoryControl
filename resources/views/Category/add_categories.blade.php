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
                    <div class="panel-title">Categories</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/categories')}}"
                           data-rel="collapse">Categories</a>
                    </div>
                </div>
                <div class="panel-body">


                    <form action="" method="POST" id="frm_category">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <label>Category Title</label>
                                <input class="form-control"
                                       placeholder="Category Title"
                                       type="text"
                                       name="title"
                                        value="@php
                                        if(isset($categories[0]->category_title))
                                        {
                                        echo $categories[0]->category_title;
                                        }
                                        @endphp"
                                       id="title"
                                />
                                <span id="ons" class="error"></span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea style="width: 25%; height: 100px" id="description" class="form-control"
                                          placeholder="Description"
                                          name="description" row="3">@php
                                        if(isset($categories[0]->category_description))
                                        {
                                        echo $categories[0]->category_description;
                                        }
                                    @endphp</textarea>
                                <span id="ins" class="error"></span>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label>Parent Id</label>--}}
                                {{--<select class="form-control" name="parent_id">--}}
                                    {{--<option value="0">No Parent</option>--}}
                                    {{--@foreach($categories as $item)--}}
                                        {{--<option value="{{$item->id}}">{{$item->title}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
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
    <script src="../js/app/categories.js"></script>

@endsection