@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>List</small>
                </h1>
            </div>
            @if(session('xoathanhcong'))
                {{session('xoathanhcong')}}
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tieu De</th>
                        <th>Tom Tat</th>
                        <th>Hinh</th>
                        <th>Noi Bat</th>
                        <th>So luot Xem</th>
                        <th>Loai tin</th>
                        <th>The Loai</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tintuc as $t)
                    <tr class="odd gradeX" align="center">
                        <td>{{$t->id}}</td>
                        <td>{{$t->TieuDe}}</td>
                        <td>{{$t->TomTat}}</td>
                        <td><img width="100px" src="upload/tintuc/{{$t->Hinh}}"/></td>
                        <td>
                        @if($t->NoiBat==0)
                        {{'Không'}}
                        @else{{'Có'}}
                        @endif
                        </td>
                        <td>{{$t->SoLuotXem}}</td>
                        <td>{{$t->loaitin->Ten}}</td>
                        <td>{{$t->loaitin->theloai->Ten}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$t->id}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$t->id}}">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection