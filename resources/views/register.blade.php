@extends('layout')
@section('content')
    

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card2">
			<div class="card-header">
				<h3>Register</h3>
			</div>
			<div class="card-body">
                <form  method="post" action="/registerPost">
                    @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend2">
							<span class="input-group-text">Name</span>
						</div>
						<input type="text" name="name" class="form-control" placeholder="Name">
						
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend2">
							<span class="input-group-text">Email</span>
						</div>
						<input type="text" name="email" class="form-control" placeholder="Email">
						
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend2">
                            <span class="input-group-text">Password</span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Password">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend2">
							<span class="input-group-text">Confirm</span>
						</div>
						<input type="password" name="confirm" class="form-control" placeholder="Confirm password">
					</div>
			
					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection