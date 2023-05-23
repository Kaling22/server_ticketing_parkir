@extends ('layouts.main')
@section('container')
<!-- Content -->

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-header">Tabel Data Kendaraan</h5>
    <a href="{{ route('dataKendaraan.create') }}" type="button" class="btn btn-primary" >
      Tambah Nomer Kendaraan
    </a>
  </div>
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nomer Kendaraan</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($kendaraan as $item)
        <tr>
          <td> <strong></strong></td>
          <td>{{$item->no_kendaraan}}</td>
          <td><span class="badge bg-label-primary me-1">Aktif</span></td>
          <td>
          <a href="{{ route('dataKendaraan.edit', $item->id) }}"
              class="btn btn-sm btn-secondary">Edit</a>
          <form onsubmit="return confirm('Apakah Anda Yakin ?');"
            action="{{ route('dataKendaraan.destroy', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
          </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection