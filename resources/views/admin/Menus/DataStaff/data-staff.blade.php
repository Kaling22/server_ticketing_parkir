@extends ('layouts.main')
@section('container')
<!-- Content -->
@if (Auth::user()->role == '1')
  <div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-header">Tabel Data Staff</h5>
    <a href="{{route('dataStaff.create')}}" type="button" class="btn btn-primary" >
      Tambah Data Staff
    </a>
  </div>
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>NIP</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>No Telepon</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      <?php $index = 1; ?>
      @foreach ($staff as $item)
        <tr>
          <td> <strong>{{$index++}}</strong></td>
          <td>{{$item->nip_kode}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->alamat}}</td>
          <td>{{$item->no_telepon}}</td>
          <td>{{$item->email}}</td>
        </tr>
       @endforeach
      </tbody>
    </table>
  </div>
</div>
@else
@endif
@endsection