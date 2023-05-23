@extends ('layouts.main')
@section('container')
<div class="col-xl">
    <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Data Kendaraan</h5>
    </div>
    <div class="card-body">
        <form action="{{route('dataKendaraan.update', $kendaraan->id )}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nomer Kendaraan</label>
            <input type="text" class="form-control" name="no_kendaraan"id="no_kendaraan" value="{{$kendaraan->no_kendaraan}}" />
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    </div>
</div>
@endsection