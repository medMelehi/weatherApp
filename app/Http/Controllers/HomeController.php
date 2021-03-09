<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Favory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use View;
use DB;

class HomeController extends Controller
{
    
    public function home(){
        $status="";


        $user_ip = getenv('REMOTE_ADDR');
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];
 
        $msg="";
        $url="http://api.openweathermap.org/data/2.5/forecast?q=$city&appid=49c0bad2c7458f1c76bec9654081a661";
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($ch);
        curl_close($ch);
        $result=json_decode($result,true);
        if($result['cod']==200){
            $status="yes";
        }else{
            $msg=$result['message'];
        }
         
        return view("welcome")->with('results', $result)->with('status', $status);
        
            //return view('welcome')->with('status', $status);
    } 

    
    public function homePost(Request $r){

        $status="";
        $msg="";
        $city= $r->input('search');
        $url="http://api.openweathermap.org/data/2.5/forecast?q=$city&appid=49c0bad2c7458f1c76bec9654081a661";
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($ch);
        curl_close($ch);
        $result=json_decode($result,true);
        if($result['cod']==200){
            $status="yes";
        }else{
            $msg=$result['message'];
            session()->flash('notCorrect', 'city doesnt exist!');
        }
        $idu = session('id');
        $item = favory::where('idUser', '=', $idu)->where('name', '=', $city)->first();
           
        
            if($item != null){ session()->flash('exist', 'do not show add message');  }
            
                  
            
          
        return view("welcome")->with('results', $result)->with('status', $status);
      // return view('welcome');
        }

        public function login(){

                return view('login');
        } 
        
        public function loginPost(Request $r){
            $email = $r->email;
            $password = $r->password;
            $client = Client::where('email', '=', $email)->where('password', '=', $password)->first();
            if($client === null){
                session()->flash('password', 'email or password not correct');
                return view('login');
            }
            session()->put('name', $client->name);
            session()->put('id', $client->id);
            return Redirect::to('http://127.0.0.1:8000/');
        } 

        public function register(){
  
                return view('register');
        } 
        
        public function registerPost(Request $r){
            if($r->input('confirm')== $r->input('password')){
                $client = new Client();

                $client->name= $r->input('name');
                $client->email= $r->input('email');
                $client->password= $r->input('password');
                

                $client->save();
                return view('login');
            }
            


            return view('welcome');
        } 

        public function logOut(){
            Session::flush();
            return Redirect::to('http://127.0.0.1:8000/');
            
    } 

    public function favory(Request $r){
        
        $city = new Favory();
        $city->name= $r->input('city');
        $city->idUser= session('id');
        $city->save();
        session()->flash('added', ' Report is deleted successfully.');
        return Redirect::to('http://127.0.0.1:8000/listFavories');
    } 

    
    public function  listFavories(){
        $id=Session::get("id");
        $items = DB::table('favories')
    ->select('favories.id' , 'favories.name')
    ->where('favories.idUser', $id)
    ->get();
        
    return View::make('favories', compact('items',$items));
    } 
   
    public function  search(Request $r){
        $status="";
        $msg="";
        $city= $r->input('search');
        $url="http://api.openweathermap.org/data/2.5/forecast?q=$city&appid=49c0bad2c7458f1c76bec9654081a661";
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($ch);
        curl_close($ch);
        $result=json_decode($result,true);
        if($result['cod']==200){
            $status="yes";
        }else{
            $msg=$result['message'];
        }
        $idu = session('id');
        $item = favory::where('idUser', '=', $idu)->where('name', '=', $city)->first();
           
        
            if($item != null){
           
                session()->flash('exist', ' Report is deleted successfully.');
            }
        return view("welcome")->with('results', $result)->with('status', $status);
    } 
    public function  delete($id){
       
       $report = $id;      

       $rsltDelRec = favory::find($report);
    
       $rsltDelRec->delete();        
       session()->flash('deleted', ' Report is deleted successfully.');
    
       return Redirect::to('http://127.0.0.1:8000/listFavories');

    } 


}
