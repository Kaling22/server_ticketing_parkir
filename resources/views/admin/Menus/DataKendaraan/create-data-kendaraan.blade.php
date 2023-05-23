@extends ('layouts.main')
@section('container')
<div class="col-xl">
    <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Kendaraan Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{route('dataKendaraan.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nomer Kendaraan</label>
            <input type="text" class="form-control" name="no_kendaraan"id="no_kendaraan" placeholder="" />
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    </div>
</div>
@endsection