@extends('master')
@section('title', 'Profile')
@section('cssloader')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
    body{
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }
    .profile-img{
        text-align: center;
    }
    .profile-img img{
        width: 70%;
        height: 100%;
    }
    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }
    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }
    .profile-head h5{
        color: #333;
    }
    .profile-head h6{
        color: #0062cc;
    }
    .profile-edit-btn{
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }
    .proile-rating{
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }
    .proile-rating span{
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }
    .profile-head .nav-tabs{
        margin-bottom:5%;
    }
    .profile-head .nav-tabs .nav-link{
        font-weight:600;
        border: none;
    }
    .profile-head .nav-tabs .nav-link.active{
        border: none;
        border-bottom:2px solid #0062cc;
    }
    .profile-work{
        padding: 14%;
        margin-top: -15%;
    }
    .profile-work p{
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }
    .profile-work a{
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }
    .profile-work ul{
        list-style: none;
    }
    .profile-tab label{
        font-weight: 600;
    }
    .profile-tab p{
        font-weight: 600;
        color: #0062cc;
    }
</style>
@stop
@section('content')

	
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <img src="{{ asset(Auth::user()->avatar) }}" alt=""/>
                <form>
	                <div class="file btn btn-lg btn-primary">
	                    Change Photo
	                    <input type="file" name="file" id="file-avatar"/>
	                </div>
                </form>
            </div>
        </div>
        {{ csrf_field() }}
        <input type="hidden" class="" name="userId" value="{{ Auth::user()->id }}"/>
        <div class="col-md-8">
			<div id="exTab2" class="container">	
				<ul class="nav nav-tabs">
					<li class="active">
				        <a  href="#1" data-toggle="tab">Thông tin cá nhân</a>
					</li>
					<li>
						<a href="#2" data-toggle="tab">Thay đổi Email</a>
					</li>
					<li>
						<a href="#3" data-toggle="tab">Thay đổi mật khẩu</a>
					</li>
				</ul>
				<div class="tab-content ">
					<div class="tab-pane active" id="1">
			          	<div class="col-md-12">
				            <div class="profile-head">
			                    <h1>
			                        {{ Auth::user()->full_name }}
			                    </h1>
			                    <h6>
			                    	@if (Auth::user()->type == 1)
			                        	Web Developer and Designer
			                        @elseif (Auth::user()->type == 2)
			                        	Manage
			                        @endif
			                    </h6>
				            </div>
			        	</div>
			        	<div class="col-md-12">
					        <div class="tab-content profile-tab" id="myTabContent">
					            <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
				                    <div class="row">
				                        <div class="col-md-1">
				                            <label>Email</label>
				                        </div>
				                        <div class="col-md-11">
				                            <p>{{ Auth::user()->email }}</p>
				                        </div>
				                    </div>
				                    <br>
				                    <div class="row">
				                        <div class="col-md-1">
				                            <label>Nation</label>
				                        </div>
				                        <div class="col-md-3">
			                                <select class="form-control" name="country" id="country">
			                                    @foreach($countryList as $key => $value)
			                                        <option value="{{ $value->id }}" {{ $value->id == Auth::user()->nation ? 'selected' : '' }}>{{ $value->country_name }}</option>
			                                    @endforeach
			                                </select>
			                            </div>
			                            <div class="col-md-8"></div>
				                    </div>
				                    <br><br>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-3">
			            	<input type="button" class="profile-edit-btn" id="updateInfs" data-type="1" value="Cập nhật thông tin"/>
			        	</div>
					</div>
					<div class="tab-pane" id="2">
						<div class="col-md-12">
					        <div class="tab-content profile-tab" id="myTabContent">
					            <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
					            	<br><br>
				                    <div class="row">
				                        <div class="col-md-2">
				                            <label>Email hiện tại</label>
				                        </div>
				                        <div class="col-md-10">
				                            <p>{{ Auth::user()->email }}</p>
				                        </div>
				                    </div>
				                    <br>
				                    <div class="row">
				                        <div class="col-md-2">
				                            <label>Nhập Email thay đổi</label>
				                        </div>
				                        <div class="col-md-4">
				                            <input type="text" name="email" id="emailNew" class="form-control" placeholder="Nhập email" value="">
				                            <div id="errorEmail"></div>
				                        </div>
				                        <div class="col-md-6"></div>
				                    </div>
				                    <br><br>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-3">
			            	<input type="button" class="profile-edit-btn" id="updateEmail" data-type="2" value="Cập nhật Email"/>
			        	</div>
					</div>
			        <div class="tab-pane" id="3">
		        		<div class="col-md-12">
					        <div class="tab-content profile-tab" id="myTabContent">
					            <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
					            	<br><br>
				                    <div class="row">
				                        <div class="col-md-2">
				                            <label>Nhập mật khẩu hiện tại</label>
				                        </div>
				                        <div class="col-md-4">
				                            <input type="password" name="passwordOld" id="passwordOld" class="form-control" placeholder="Mật khẩu hiện tại" value="">
				                            <div id="errorPasswordOld"></div>
				                        </div>
				                        <div class="col-md-6"></div>
				                    </div>
				                    <br>
				                    <div class="row">
				                        <div class="col-md-2">
				                            <label>Nhập mật khẩu mới</label>
				                        </div>
				                        <div class="col-md-4">
				                            <input type="password" name="passwordNew" id="passwordNew" class="form-control" placeholder="Mật khẩu mới" value="">
				                            <div id="errorPasswordNew"></div>
				                        </div>
				                        <div class="col-md-6"></div>
				                    </div>
				                    <br><br>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-3">
			            	<input type="button" class="profile-edit-btn" id="updatePassword" data-type="3" value="Thay đổi mật khẩu"/>
			        	</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</form>
<div id="select_file"></div>
@stop

@section('script')
<script>
    $(".container-fluid").removeClass( "content container-fluid" )
    var TOKEN = "{{ csrf_token() }}";
    var userId = $("input[name*='userId']").val();
    $("#file-avatar").change(function(){
    	
        var filepath = $('#file-avatar').val();
        var filename = filepath.replace(/^.*[\\\/]/, '');
        $.ajax({
            type: "POST",
            data: { "filename": filename, "filepath": filepath, "userId": userId, "_token": TOKEN },
            url: "/user/update",
            success: function(response) {
            }
        });
	});

	$( "#updateInfs" ).click(function() {
		var country = $( "#country" ).val();
		var type = $(this).data("type");
  		$.ajax({
        	type: "POST",
            data: { "country": country, "type": type, "userId": userId, "_token": TOKEN },
            url: "/user/user-edit",
            success: function(response) {
            }
        });
	});

	$( "#updateEmail" ).click(function() {
		var emailNew = $( "#emailNew" ).val();
		var type = $(this).data("type");
  		$.ajax({
        	type: "POST",
            data: { "email": emailNew, "type": type, "userId": userId, "_token": TOKEN },
            url: "/user/user-edit",
            success: function(response) {
            	if(response.error) 
        		{
            		var html = '';
		            $.each(response.message, function(i, data) {
		            		html += '<span class="text-danger">' + data[0] + '</span>';
		            });	
        		}
            	$('#errorEmail').empty().append(html);
            }
        });
	});

	$( "#updatePassword" ).click(function() {
		var passwordOld = $( "#passwordOld" ).val();
		var passwordNew = $( "#passwordNew" ).val();
		var type = $(this).data("type");
  		$.ajax({
        	type: "POST",
            data: { "passwordOld": passwordOld, "passwordNew": passwordNew, "type": type, "userId": userId, "_token": TOKEN },
            url: "/user/user-edit",
            success: function(response) {
            	
            	if(response.error) 
        		{
		            $.each(response.message, function(i, data) {
		            	var html = '';
		            	html += '<span class="text-danger">' + data[0] + '</span>';
		            	if(i === "passwordNew") $('#errorPasswordNew').empty().append(html);
		            	if(i === "passwordOld") $('#errorPasswordOld').empty().append(html);
		            });	
        		}
            }
        });
	});
</script>
@stop