<table>
	<thead>
		<tr>
			<th>Stt</th>
			<th>Tên</th>
			<th>Email</th>
			<th>Chức danh</th>
			<th>Phòng ban</th>
			<th>Chức năng</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$stt=0;
		?>
		@foreach($user as $item)
		<tr>
			<td>{{++$stt}}</td>
			<td>{{$item->name}}</td>
			<td>{{$item->email}}</td>
			<td>{{$chucdanh[$item->chucdanhid]??""}}</td>
			<td>{{$phongban[$item->phongbanid]??""}}</td>
			<td><a href="{{route("user.edit",$item->id)}}">Edit</a></td>
		</tr>
		@endforeach
	</tbody>
</table>