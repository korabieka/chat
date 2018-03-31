@extends('mainLayout')
@section('content')
	<div id="chatBox">
		<textarea id="chat" rows="7" cols="70"></textarea><br>
		<input type="text" id="text" size="75">
		<input type="hidden" value="{{$user->id}}" id="sender">
		<input type="button" id="send" value="send" class="btn btn-default">
	</div>
	<div id="online">
		<select id="users">
			@foreach($users as $user)
				<option value="{{$user->id}}">{{$user->name}}</option>
			@endforeach
		</select>
	</div>
	<br><br><br>
	<a href="{{url('/logout')}}" class="btn btn-danger">Logout</a>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('/js/client.js')}}"></script>
@endsection