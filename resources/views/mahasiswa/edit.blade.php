<!-- START FORM -->
@extends('layout.template')
@section('content')

@include('components/alert')
<form action='{{ url("mahasiswa/".$dataEdit->nim) }}' method='post'>
  @csrf
  @method('PUT')
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <a href="{{ url('mahasiswa') }}" class="btn btn-secondary mb-4">Kembali</a>
    <div class="mb-3 row">
      <label for="nim" class="col-sm-2 col-form-label">NIM</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" disabled name='nim' value="{{ $dataEdit->nim }}" id="nim">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name='nama' value="{{ $dataEdit->nama }}" id="nama">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name='jurusan' value="{{ $dataEdit->jurusan }}" id="jurusan">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="jurusan" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
    </div>
  </div>
</form>
@endsection
<!-- AKHIR FORM -->