    @extends('admin.layout.index')
    <!-- Page Content -->
    @section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tuc
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors)>0)
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
                @endif
                @if(session("thanhcong"))
                    {{session("thanhcong")}}
                @endif
                    <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">
                            <label>The Loai</label>
                            <select class="form-control" name="theloai" id="theloai">
                                @foreach($theloai as $tl)
                                <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loai Tin</label>
                            <select class="form-control" name="loaitin" id="loaitin">
                                @foreach($loaitin as $lt)
                                <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select></div>
                        <div class="form-group">
                            <label>Tieu De</label>
                            <input class="form-control" name="tieude" placeholder="Please Enter Tieu De" />
                        </div>
                        <div class="form-group">
                            <label>Tom Tat</label>
                            <textarea id="demo" name="tomtat" class="form-control ckeditor" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Noi dung</label>
                            <textarea id="demo" name="noidung" class="form-control ckeditor" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hinh Anh</label>
                            @if(session("loi"))
                    {{session("loi")}}
                @endif
                            <input type="file" name="hinh" class="form-group"/>
                        </div>
                        <div class="form-group">
                            <label>Noi Bat</label>
                            <label class="radio-inline">
                                <input name="noibat" value="0" checked="" type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="noibat" value="1" type="radio">Có
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
    @section('script')
        <script>
        $(document).ready(function(){
            $("#theloai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai, function(data){
                    $("#loaitin").html(data);
                });
            });
        });
        </script>

    @endsection