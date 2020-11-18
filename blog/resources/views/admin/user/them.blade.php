    @extends('admin.layout.index')
    <!-- Page Content -->
    @section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->

                @if(count($errors)>0)
                    @foreach($errors->all() as $err)
                        {{$err}}
                    @endforeach
                @endif
                @if(session('success'))
                {{session('success')}}
                @endif
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Name" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Please Enter Email" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Please Enter Password" />
                        </div>
                        <div class="form-group">
                            <label>passwordComfirm</label>
                            <input type="password" class="form-control" name="passwordComfirm" placeholder="Please comfirm Password" />
                        </div>
                        
                        <div class="form-group">
                            <label>Quyen</label>
                            <label class="radio-inline">
                                <input name="quyen" value="0" checked="" type="radio">User
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" type="radio">Admin
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @endsection