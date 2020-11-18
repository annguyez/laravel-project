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
            @if(session('success'))
            {{session('success')}}
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Ten</th>
                        <th>Hinh</th>
                        <th>Noi Dung</th>
                        <th>Link</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($slide as $s)
                    <tr class="odd gradeX" align="center">
                        <td>{{$s->id}}</td>
                        <td>{{$s->Ten}}</</td>
                        <td><img width="400px" src="upload/slide/{{$s->Hinh}}"></</td>
                        <td>{{$s->NoiDung}}</</td>
                        <td>{{$s->link}}</</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{$s->id}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$s->id}}">Edit</a></td>
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