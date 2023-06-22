@extends ('layouts.main')
@section('container')
<!-- Content -->

<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-header">Tabel Data Petugas</h5>
    <a href="{{route('dataPetugas.create')}}" type="button" class="btn btn-primary" >
      Tambah Data Petugas
    </a>
  </div>
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Pekerja</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>No Telepon</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      <?php $index = 1; ?>
      @foreach ($petugas as $item)
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
@endsection