
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
background-image: url('https://images.unsplash.com/photo-1565608221829-f95dd349717f?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{

margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:darkslategray">
        <a class="navbar-brand" style="color: #d4d4d4" href="/">WeatherProject</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            @if(Session::has('name'))
            
              <li class="nav-item active">
                <a class="nav-link font-weight-bold" style="color: #d4d4d4" href="/listFavories">favories</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link font-weight-bold" style="color: #d4d4d4" href="/logOut">log-out</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link font-weight-bold" style="color: #d4d4d4" href="#">welcome{{ ' '.session('name') }}</a>
              </li>
              @else
              <li class="nav-item active">
                <a class="nav-link font-weight-bold" style="color: #d4d4d4" href="/login">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link font-weight-bold" style="color: #d4d4d4" href="/register">Register</a>
              </li> 
            @endif
           
          </ul>
        </div>
      </nav>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
        @if (Session::get('deleted') != null)
        <div class="alert alert-danger">
            city deleted succesfully !
        </div>
        @endif
        @if (Session::get('added') != null)
        <div class="alert alert-success">
            city added succesfully ^_^
        </div>
        @endif
				<h3>My Favories</h3>
			</div>
			<div class="card-body">
                @foreach($items as $item)
            <div style="background-color:rgb(156, 153, 153); height:60px;border-radius:8px;position :relative;margin:4px;">
              <div id=" " style="position:absolute; top:17px; left:20px;">
                   {{$item->name}}
                </div>
                <div style="position:absolute; top:13px; right:15px;">
                    <a style="" id=""  class="btn btn-primary add"  href="{{$item->name}}" >show</a>
                    <a style="" id=""  class="btn btn-danger "  href="/delete/{{$item->id}}" >delete</a>  
                </div>
                </div>
                @endforeach
			</div>
		</div>
	</div>
</div>
<div style="display: block;">  
    <form id="pos" method="post" action="/search">
        @csrf
        <input id="put" class="city" type="text" name="search" value="gfgfgf">
        
    </form>
   </div>
   <script>
       $(document).ready(function(){
           $( ".add" ).mousedown(function() {
             var search =  $(this).attr("href");
             $("#put").val(search);
             $("#pos").submit();
           });
        
       });
       </script>
</body>
</html>