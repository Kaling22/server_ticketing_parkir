@extends ('layouts.main')
@section('container')
<div class="col-xl">
    <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Staff Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{route('dataStaff.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip_kode" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">No Telepon</label>
            <input type="text" class="form-control" name="no_telepon" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <input type="text" class="form-control" name="role" required value="2" readonly/>
        </div>
        <div class="mb-3">
            <label class="form-label">E-Mail</label>
            <input type="text" class="form-control" name="email" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" name="password" required placeholder="Min 8 Karakter"/>
        </div>       
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    </div>
    </div>
@endsection