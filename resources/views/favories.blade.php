@extends('layout')
@section('content')
    

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card3">
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
<div style="display: none;">  
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
@endsection