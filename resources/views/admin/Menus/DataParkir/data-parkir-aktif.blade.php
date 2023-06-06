@extends ('layouts.main')
@section('container')
<!-- Content -->

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-header">Tabel Data Parkir AKtif</h5>
  </div>
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Status</th>
          <th>Dibuat Oleh</th>
          <th>Diupdate Oleh</th>
          <th>Hari</th>
          <th>Tanggal</th>
          <th>Jam</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      <?php $index = 1; ?>
      @foreach ($parkir_aktif as $item)
        <tr>
          <td> <strong>{{$index++}}</strong></td>
          <td>{{$item->nim}}</td>
          @if($item->status_masuk==1)
          <td>Kendaraan Terparkir</td>
          @else
          <td>Terjadi Kesalahan</td>
          @endif
          <td>{{$item->created_by}}</td>
          <td>{{$item->updated_by}}</td>
          <td>{{$item->hari}}</td>
          <td>{{$item->tanggal}}</td>
          <td>{{$item->jam}}</td>
        </tr>
       @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection