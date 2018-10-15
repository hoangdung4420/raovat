@extends('templates.public.master')
@section('content')
<form action="{{route('public.posttest')}}" method="post">
	{{csrf_field()}}
	<input type="text" name="name" class="form-control">
	<select name="village_id" class="form-control">
@foreach($districts as $district)
	<option value="{{$district->id}}">{{$district->name}}</option>
@endforeach
	</select>
	<input class="form-control" type="submit" value="submit"></input>
</form>
<h2>test map</h2>
<div id="map" style="clear:both; height:200px;"></div>
    <script>
      function initMap() {
		  var map = new google.maps.Map(document.getElementById("map"), {
		    center: { lat: 21.0168864, lng: 105.7855574 },
		    zoom: 15
		  });
		}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWzPwzUTtnKOzxAAQ3nv_65-OfuAorMkU&callback=initMap"
    async defer>
    </script>
    
@stop