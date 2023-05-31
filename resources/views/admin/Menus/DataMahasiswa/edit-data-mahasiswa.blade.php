@extends ('layouts.main')
@section('container')
<div class="col-xl">
    <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Data Mahasiswa</h5>
    </div>
    <div class="card-body">
        <form action="{{route('dataMahasiswa.update', $mahasiswa->id )}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" value="{{$mahasiswa->nim}}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">NFC Number</label>
            <input type="text" class="form-control" name="nfc_num" value="{{$mahasiswa->nfc_num}}" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" value="{{$mahasiswa->name}}" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" value="{{$mahasiswa->jurusan}}" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Fakultas</label>
            <input type="text" class="form-control" name="fakultas" value="{{$mahasiswa->fakultas}}" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="text" class="form-control" name="angkatan" value="{{$mahasiswa->angkatan}}" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" class="form-control" name="telepon" value="{{$mahasiswa->telepon}}" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">No Kendaraan</label>
            <select name="no_kendaraan" class="form-control">
                @foreach ($kendaraan as $ken)
                    <option value="{{$ken->id}}">{{$ken -> no_kendaraan}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <div class="d-flex align-items-start align-items-sm-center gap-4">
            <div class="button-wrapper">
                <label for="inputImage" class="btn btn-primary me-10 mb-0" tabindex="0">
                    <span class="d-none d-sm-block required-field">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" name="foto" id="inputImage"
                        class="form-control @error('image') is-invalid @enderror" required>
                </label>
                <p class="text-muted mt-1">Allowed JPG, JPEG, GIF or PNG. Max size of 2MB</p>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    </div>
</div>
@endsection