@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Edit</small>
                        </h1>
                    </div>
                    @if(count($errors)>0)
                    @foreach($errors->all() as $err)
                        {{$err}}
                    @endforeach
                    @endif
                    @if(session('success'))
                        {{session('success')}}

                    @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changePass" name="changepass"/>
                                <label>Change Password</label>
                                <input type="password" class="form-control" name="password" id="password"  disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Re-Password</label>
                                <input type="password" class="form-control" name="repassword" id="repassword" disabled="" />
                            </div>
                            
                            <div class="form-group">
                                <label>Quyen</label>
                                
                                <label class="radio-inline">
                                    <input name="quyen" value="0"
                                @if($user->quyen==0)
                                {{"checked"}}
                                @endif type="radio">User
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" @if($user->quyen==1)
                                {{"checked"}}
                                @endif  type="radio">Admin
                                </label>
                                
                                
                            </div>
                            <button type="submit" class="btn btn-default">Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection

        @section('script')
        <script>
            $(document).ready(function(){
                $('#changePass').change(function(){
                    if($('#changePass').is(":checked")){
                        $('#password').removeAttr('disabled');
                        $('#repassword').removeAttr('disabled');
                    }else{
                        $('#password').attr('disabled','');
                        $('#repassword').attr('disabled','');
                    }
                });
            });
        </script>
        @endsection