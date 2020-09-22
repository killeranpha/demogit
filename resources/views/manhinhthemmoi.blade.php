<form method=post action="{{route("luudulieu")}}">
	@csrf
	<input type=text name='ten'>
	<input type=submit value='Submit'>
</form>