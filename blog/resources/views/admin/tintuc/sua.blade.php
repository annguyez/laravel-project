@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tuc
                            <small>Edit</small>
                        </h1>
                    </div>
                    @if(count($errors)>0)
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
                @endif
                    @if(session("suathanhcong"))
                                {{session("suathanhcong")}}
                            @endif<br/>

                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">
                            <label>The Loai</label>
                            <select class="form-control" name="theloai" id="theloai">
                                @foreach($theloai as $tl)
                                <option
                                @if($tl->id==$tintuc->loaitin->theloai->id)
                                    {{"selected"}}
                                @endif
                                 value="{{$tl->id}}">{{$tl->Ten}}
                                 </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loai Tin</label>
                            <select class="form-control" name="loaitin" id="loaitin">
                                @foreach($loaitin as $lt)
                                <option
                                @if($tintuc->loaitin->id==$lt->id)
                                    {{"selected"}}
                                @endif
                                 value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select></div>
                        <div class="form-group">
                            <label>Tieu De</label>
                            <input class="form-control" name="tieude" placeholder="{{$tintuc->TieuDe}}" />
                        </div>
                        <div class="form-group">
                            <label>Tom Tat</label>
                            <textarea id="demo" name="tomtat" placeholder="{{$tintuc->TomTat}}" class="form-control ckeditor" rows="2">
                            {{$tintuc->TomTat}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Noi dung</label>
                            <textarea id="demo" name="noidung" placeholder="{{$tintuc->NoiDung}}" class="form-control ckeditor" rows="5">
                            {{$tintuc->NoiDung}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Hinh Anh</label>
                            @if(session("loi"))
                                {{session("loi")}}
                            @endif<br/>
                            <img src="upload/tintuc/{{$tintuc->Hinh}}" />
                            <input type="file" name="hinh" class="form-group"/>
                        </div>
                        <div class="form-group">
                            <label>Noi Bat</label>
                            <label class="radio-inline">
                                <input
                                @if($tintuc->NoiBat==0)
                                {{"checked"}}
                                @endif
                                 name="noibat" value="0"  type="radio">Không</input>
                            </label>
                            <label class="radio-inline">
                                <input
                                @if($tintuc->NoiBat==1)
                                {{"checked"}}
                                @endif
                                 name="noibat" value="1" type="radio">Có</input>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Edit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>


                <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small>List</small>
                </h1>
            </div>
            @if(session('xoathanhcong'))
            <div class="alert alert-success">
                {{session('xoathanhcong')}}
            </div>
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>User</th>
                        <th>Noi Dung</th>
                        <th>Ngay Dang</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tintuc->comment as $c)
                    <tr class="odd gradeX" align="center">
                        <td>{{$c->id}}</td>
                        <td>{{$c->user->name}}</td>
                        <td>{{$c->NoiDung}}</td>
                        <td>{{$c->created_at}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$c->id}}/{{$tintuc->id}}"> Delete</a></td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>



                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
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