@extends('mainLayout')
	@section('content')
		<form action="{{url('/chat')}}" method="post">
			<p>Enter your name here</p><br>
			<input type="text" name="username"><br><br>
			<input type="submit" value="Start chat" class="btn">
			{{csrf_field()}}
		</form><br>
	    @foreach($errors->all() as $error)
	      <p>{{ $error }}</p>
	    @endforeach
	@endsection
