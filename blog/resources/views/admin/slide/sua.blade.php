@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="ten" value="{{$slide->Ten}}" />
                            </div>
                            <div class="form-group">
                                <label>Hinh</label>
                                <img src="upload/slide/{{$slide->Hinh}}"/>
                                <input class="form-control" name="hinh" type="file" />
                            </div>
                            <div class="form-group">
                                <label>Noi Dung</label>
                                <input class="form-control" name="noidung" value="{{$slide->NoiDung}}" />
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" value="{{$slide->link}}" />
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