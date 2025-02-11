<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shark Supliment - Login</title>
	<link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('asset/css/datepicker3.css')}}" rel="stylesheet">
	<link href="{{asset('asset/css/styles.css')}}" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
 

 
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
            
                        @if (session('success'))
                          <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                          </div>
                        @endif
					<form method="POST" action="{{ route('admin.login')}}">
                        @csrf
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
                            @error('email')
                            <div class="alert alert-danger" role="alert">
                             {{$message}}
                               </div>
                               @enderror
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
                            @error('password')
                            <div class="alert alert-danger" role="alert">
                             {{$message}}
                               </div>
                               @enderror
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button class="btn btn-primary" type="submit">Log in</button>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="{{asset('asset/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{'asset/js/bootstrap.min.js'}}"></script>
</body>
</html>
































{{-- <!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الإدمن</title>
</head>
<body>
    <h2>تسجيل دخول الإدمن</h2>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <label>الإيميل:</label>
        <input type="email" name="email" required>
        <label>كلمة المرور:</label>
        <input type="password" name="password" required>
        <button type="submit">تسجيل الدخول</button>
    </form>
</body>
</html> --}}
