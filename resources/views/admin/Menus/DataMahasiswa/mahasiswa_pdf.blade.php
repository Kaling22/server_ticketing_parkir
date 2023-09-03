<!DOCTYPE html>
<html>
<head>
	<title>Report Riwayat Parkir</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Report Riwayat Parkir Mahasiswa</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>NIM</th>
				<th>Dibuat Oleh</th>
				<th>Diupdate Oleh</th>
				<th>Status</th>
				<th>Tanggal</th>
				<th>Jam</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($riwayatMahasiswa as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nim}}</td>
				<td>{{$p->petugasMasuk->name}}</td>
				<td>{{$p->petugasKeluar->name}}</td>
                <td>{{$sts[$loop->index]}}</td>
                <td>{{$p->tanggal}}</td>
                <td>{{$p->jam}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>