@extends('layout.index')
@section('content')
<div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
                          @if(session('success'))
                            {{session('success')}}
                          @endif
				    	<form action="nguoidung" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
				    		<div>
				    			<label>Họ tên</label>
                                  <input type="text" class="form-control" placeholder="Username"
                                  value="{{Auth::user()->name}}"
                                  name="name" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" value="{{Auth::user()->email}}" name="email" aria-describedby="basic-addon1"
							  	disabled
							  	>
							</div>
							<br>	
							<div>
								<input type="checkbox" id="changePass" name="checkpassword">
				    			<label>Đổi mật khẩu</label>
							  	<input type="password" id="password" class="form-control" name="password" disabled aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" id="repassword" class="form-control" name="passwordAgain" disabled aria-describedby="basic-addon1">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Sửa
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
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