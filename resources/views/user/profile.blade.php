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
                    <div class="panel-title">Profile</div>

                    <div class="panel-options">
                        <a href="{{url('/secure/users')}}"
                           data-rel="collapse">Users</a>
                    </div>
                </div>
                <div class="panel-body">


                    <form action="" method="POST" id="frm_users">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control"
                                       placeholder="First Name"
                                       type="text"
                                       id="first_name"
                                       name="first_name"
                                       value="@php
                                           if(isset($user['first_name']))
                                           {
                                           echo $user['first_name'];
                                           }
                                       @endphp"
                                />
                                <span id="fname" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control"
                                       placeholder="Last Name"
                                       type="text"
                                       id="last_name"
                                       name="last_name"
                                       value="@php
                                           if(isset($user['last_name']))
                                           {
                                           echo $user['last_name'];
                                           }
                                       @endphp"
                                />
                                <span id="lname" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control"
                                       placeholder="Email"
                                       type="text"
                                       id="email"
                                       name="email"
                                       value="@php
                                           if(isset($user['email']))
                                           {
                                           echo $user['email'];
                                           }
                                       @endphp"
                                />
                                <span id="mail" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" type="password" placeholder="Password">
                                <span id="ons" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role">
                                    <option id="role" value="1"
                                            @php
                                                if (isset($user) && $user['role'] == 1)
                                                {
                                                echo 'selected';
                                                }else{
                                                echo '';
                                                }
                                            @endphp
                                    >Admin
                                    </option>
                                    <option id="role" value="2" name="role"
                                            @php
                                        if (isset($user) && $user['role'] == 2)
                                        {
                                        echo 'selected';
                                        }else{
                                                echo '';
                                                }
                                            @endphp
                                            >Assistant
                                    </option>
                                </select>
                                <span id="ons" class="error"></span>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
    <script src="../js/app/users.js"></script>

@endsection