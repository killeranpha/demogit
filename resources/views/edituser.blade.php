<form action="{{route("user.save")}}" method=post>
	@csrf
	<input type=hidden name=id value="{{$user->id}}">
	<table>
		<tr><td>Email</td><td>{{$user->email}}</td></tr>
		<tr>
			<td>Phòng ban</td>
			<td>
				<select name=phongbanid>
				<option value="0" >--Chọn phòng ban--</option>
				@foreach($phongban as $key=>$value)
				<option value="{{$key}}" 
				{{$key==$user->phongbanid?"selected":""}}
				>{{$value}}</option>
				@endforeach
				</select>
			</td>
		</tr>
	</table>
</form>