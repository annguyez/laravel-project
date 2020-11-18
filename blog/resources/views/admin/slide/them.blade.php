    @extends('admin.layout.index')
    <!-- Page Content -->
    @section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Add</small>
                    </h1>
                </div>
                @if(count($errors)>0)
                    @foreach($errors->all() as $err)
                <div class="alert alert-danger">
                    {{$err}}
                </div>
                    @endforeach
                @endif
                @if(session('success'))
                            <div class="alert alert-success">
                   {{ session('success')}}
                </div>
                            @endif
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="ten" placeholder="Please Enter Name" />
                        </div>
                        <div class="form-group">
                            <label>Hinh</label>

                            @if(session('thongbaoloi'))
                            <div class="alert alert-danger">
                                {{session('thongbaoloi')}}
                            </div>
                            @endif
                            <input class="form-control" name="hinh" type="file" />
                        </div>
                        <div class="form-group">
                            <label>Noi dung</label>
                            <input class="form-control" name="noidung" placeholder="Please Enter ND" />
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name="link" placeholder="Please Enter link" />
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