{{-- resources/views/penjual/profile/edit.blade.php --}}
@extends('penjual.master'){{-- sesuaikan dengan layout kamu --}}
@section('konten')
<div class="row">
  <div class="col-lg-8">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Profil Toko</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('penjual.profile.update') }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="nama_toko">Nama Toko <span class="text-danger">*</span></label>
            <input type="text" name="nama_toko" id="nama_toko"
                   class="form-control @error('nama_toko') is-invalid @enderror"
                   value="{{ old('nama_toko', $penjual->nama_toko) }}" required>
            @error('nama_toko') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat"
                   class="form-control @error('alamat') is-invalid @enderror"
                   value="{{ old('alamat', $penjual->alamat) }}">
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" id="kontak"
                   class="form-control @error('kontak') is-invalid @enderror"
                   value="{{ old('kontak', $penjual->kontak) }}" placeholder="0812xxxx / @username">
            @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <button class="btn btn-primary" type="submit">
            <i class="fas fa-save mr-1"></i> Simpan Perubahan
          </button>
          <a href="{{ route('penjual.dashboard') }}" class="btn btn-light ml-2">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
