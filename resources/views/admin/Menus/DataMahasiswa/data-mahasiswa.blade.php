@extends ('layouts.main')
@section('container')
<!-- Content -->

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-header">Tabel Data Mahasiswa</h5>
    <a href="{{route('dataMahasiswa.create')}}" type="button" class="btn btn-primary" >
      Tambah Data Mahasiswa
    </a>
  </div>
  
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>NFC Number</th>
          <th>Nama</th>
          <th>Jurusan</th>
          <th>Fakultas</th>
          <th>Angkatan</th>
          <th>Telepon</th>
          <th>Nomer Kendaraan</th>
          <th>Foto</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      <?php $index = 1; ?>
      @foreach ($mahasiswa as $item)
        <tr>
          <td> <strong>{{$index++}}</strong></td>
          <td>{{$item->nim}}</td>
          <td>{{$item->nfc_num}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->jurusan}}</td>
          <td>{{$item->fakultas}}</td>
          <td>{{$item->angkatan}}</td>
          <td>{{$item->telepon}}</td>
          <td>{{$item->plat->no_kendaraan}}</td>
          
          <td><img width="50" height="50" src="{{Storage::url('public/posts/').$item->foto}}"></td>
          <!-- <td><span class="badge bg-label-primary me-1">Aktif</span></td> -->
          <td>
          <a href="{{ route('dataMahasiswa.edit', $item->id) }}"
          class="btn btn-sm btn-secondary">Edit</a>
          <form onsubmit="return confirm('Apakah Anda Yakin ?');"
          action="{{ route('dataMahasiswa.destroy', $item->id) }}" method="POST">
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