@extends('layout.app_layout')


@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Categories</div>

                    <div class="panel-options">

                        <a href="{{url('/api/profile')}}"
                           data-rel="collapse">My Profile</a>
                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
                    </div>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                           id="example">
                        <thead>
                        <tr>
                            <th>#Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th style="text-align: center">Edit</th>
                            {{--<th>Parent</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $x = 1;
                        @endphp
                        @foreach($users as $user)
                            <tr class="gradeX">
                                <td>{{$x}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                {{--                                <td>{{$category->parent_id}}</td>--}}
                                <td style="text-align: center"><a
                                            href="{{url("/secure/users/{$user->id}")}}">Edit</a>
                                </td>
                            </tr>
                            @php
                                $x++;
                            @endphp
                        @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

@endsection