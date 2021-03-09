@extends('layout')
  @section('content')
      


        <div class="form">
            <form style="width:100%;" method="post" action="/">
                @csrf
               <input type="text" class="text" placeholder="Enter city name" name="search" value="@if($status=="yes") {{$results['city']['name']}} @endif "/>
               <input class="btn btn-success"  type="submit" value="Search" class="submit" name="submit"/>
            </form>
         </div>
         @if (Session::get('notCorrect') != null)
       
         <div class="alert alert-danger" style="position: absolute;top: 200px;left: 500px;width: 300px;">
          city's name is not correct !
         </div>
         @endif
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

@endsection