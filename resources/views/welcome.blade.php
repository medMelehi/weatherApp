<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <style>
               body {
                background-image: url('https://images.unsplash.com/photo-1565608221829-f95dd349717f?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
         font-family: Poiret One;
         }
             @import url(https://fonts.googleapis.com/css?family=Poiret+One);
         @import url(https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css);
        
         .widget {
         position: absolute;
         top: 50%;
         left: 50%;
         display: flex;
         height: 300px;
         width: 800px;
         transform: translate(-50%, -50%);
         flex-wrap: wrap;
         cursor: pointer;
         border-radius: 20px;
         box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
         }
         .widget .weatherIcon {
         flex: 1 100%;
         height: 60%;
         border-top-left-radius: 20px;
         border-top-right-radius: 20px;
         background:rgb(25, 26, 26,0.8);
         font-family: weathericons;
         display: flex;
         align-items: center;
         justify-content: space-around;
         font-size: 100px;
         }
         .widget .weatherIcon i {
         padding-top: 30px;
         }
         .widget .weatherInfo {
         flex: 0 0 80%;
         height: 40%;
         background: darkslategray;
         border-bottom-left-radius: 20px;
         display: flex;
         align-items: center;
         color: white;
         }
         .widget .weatherInfo .temperature {
         flex: 0 0 15%;
         width: 40px;
         font-size: 65px;
         display: flex;
         justify-content: space-around;
         }
         .widget .weatherInfo .description {
         flex: 0 40%;
         display: flex;
         flex-direction: column;
         width: 80%;
         height: 100%;
         justify-content: center;
          text-align: center;

         }
         .widget .weatherInfo .description .weatherCondition {
         text-transform: uppercase;
         font-size: 35px;
         font-weight: 100;
         }
         .widget .weatherInfo .description .place {
         font-size: 15px;
         }
         .widget .date {
         flex: 0 0 20%;
         height: 40%;
         background: #70C1B3;
         border-bottom-right-radius: 20px;
         display: flex;
         justify-content: space-around;
         align-items: center;
         color: white;
         font-size: 30px;
         font-weight: 800;
         }
         p {
         position: fixed;
         bottom: 0%;
         right: 2%;
         }
         p a {
         text-decoration: none;
         color: #E4D6A7;
         font-size: 10px;
         }
         .form{
         position: absolute;
         top: 40%;
         left: 50%;
         display: flex;
         height: 300px;
         width: 600px;
         transform: translate(-50%, -50%);
         }
         .text{
         width: 80%;
         padding: 10px
         }
         .submit{
         height: 39px;
         width: 100px;
         border: 0px;
         }
         .mr45{
            
         }
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
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

        <div class="form">
            <form style="width:100%;" method="post" action="/">
                @csrf
               <input type="text" class="text" placeholder="Enter city name" name="search" value="@if($status=="yes") {{$results['city']['name']}} @endif "/>
               <input class="btn btn-success"  type="submit" value="Search" class="submit" name="submit"/>
            </form>
         </div>

         @if($status=="yes")

               <article class="widget" style="">
                @if(Session::has('name'))
                @if (Session::get('exist') == null)
                  <div style="position: absolute; top:10px; right:10px ">
                  <a id="add" class="btn btn-sm btn-primary" href="#">add</a>
                  </div>
                  @endif
                @endif
            <div class="weatherIcon">
              <div class="temperature" style="color: #fff;">
                <span>{{round($results['list'][0]['main']['temp']-273.15)}}°</span>
             </div>
             <div class="description mr45" style="font-size: 40px; color: #fff;">
              <div class="weatherCondition">{{$results['list'][0]['weather'][0]['main']}}</div>
              <div id="search" class="place">{{$results['city']['name']}}</div>
           </div>
               <img src="http://openweathermap.org/img/wn/{{$results['list'][0]['weather'][0]['icon']}}@4x.png"/>
            </div>
            <div class="weatherInfo">
              
              
              
             
             <div class="description">
              <div class="weatherCondition " style="font-size: 20px">Wind</div>
              <div class="place">{{$results['list'][0]['wind']['speed']}} M/H</div>
           </div>

               <div class="description mr45" >
                <div class="weatherCondition"style="font-size: 20px">Humidity</div>
                <div id="search" class="place">{{$results['list'][0]['main']['humidity']}} %</div>
             </div>
             <div class="description mr45">
              <div class="weatherCondition" style="font-size: 20px">Visibility</div>
              <div id="search" class="place">{{$results['list'][0]['visibility']/1000}} km</div>
           </div>
            
           <div class="description mr45">
            <div class="weatherCondition"style="font-size: 20px">Pressure</div>
            <div id="search" class="place">{{$results['list'][0]['main']['pressure']}} hPa</div>
         </div>
        
              
            </div>
            <div class="date">
               {{date('d M',$results['list'][1]['dt'])}}
            </div>
         </article>
         <div style="position: absolute;left: 0px; bottom: 10px;border-radius:10px;background-color: rgba(2, 104, 104, 0.9); width: 100%;">
         <table style="width: 100%;">
          <thead>
             <tr style="text-align: center;">
                @for($i = 1 ; $i<20 ; $i++)
                <th colspan=""style="color: #d4d4d4">{{date('d M',$results['list'][$i]['dt'])}}
                <br>
                {{date('H ',$results['list'][$i]['dt'])
                }} H</th>
                @endfor
            </tr>
          </thead>
          <tbody>
             <tr style="">
              
                @for($i = 1 ; $i<20 ; $i++)
                <td style="text-align: center;">
                  <img width="70" height="70" src="http://openweathermap.org/img/wn/{{$results['list'][$i]['weather'][0]['icon']}}@4x.png"/>
                </td>   
                @endfor
             </tr>
             <tr style="">
              @for($i = 1 ; $i<20; $i++)
              <td style="text-align: center;color: #d4d4d4; font-weight: bold; font-size: 18px;">
                {{round($results['list'][$i]['main']['temp']-273.15)}}°
              </td>
              @endfor
           </tr>
             
          </tbody>
      </table>
    </div>
         @endif
         <div style="display: none;">  
         <form id="post" action="/favory">
           
             <input class="city" type="text" name="city" value="gfgfgf">
             <input  type="submit">
         </form>
        </div>
        <script>
            $(document).ready(function(){
                $( "#add" ).mousedown(function() {

                  var search =  $("#search").text();
                  
                  $('input.city').val(search);
                  $("#post").submit();
                });
             
            });
            </script>
    </body>
</html>
