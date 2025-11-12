@extends('admin.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Resep Kuliner</h1>

    <!-- ✅ Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('resep.update', $resep->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Kuliner -->
                <div class="form-group">
                    <label for="nama_rasa">Nama Kuliner</label>
                    <input type="text" name="nama_rasa" id="nama_rasa" class="form-control"
                        value="{{ old('nama_rasa', $resep->nama_rasa) }}" required>
                </div>

                <!-- Provinsi Asal -->
                <div class="form-group">
                    <label for="provinsi_asal">Provinsi Asal</label>
                    <select name="provinsi_asal" id="provinsi_asal" class="form-control" required>
                        <option value="">-- Pilih Provinsi Asal --</option>
                        <option value="Sulawesi Utara" {{ $resep->provinsi_asal == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                        <option value="Gorontalo" {{ $resep->provinsi_asal == 'Gorontalo' ? 'selected' : '' }}>Gorontalo</option>
                        <option value="Sulawesi Tengah" {{ $resep->provinsi_asal == 'Sulawesi Tengah' ? 'selected' : '' }}>Sulawesi Tengah</option>
                        <option value="Sulawesi Barat" {{ $resep->provinsi_asal == 'Sulawesi Barat' ? 'selected' : '' }}>Sulawesi Barat</option>
                        <option value="Sulawesi Selatan" {{ $resep->provinsi_asal == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                        <option value="Sulawesi Tenggara" {{ $resep->provinsi_asal == 'Sulawesi Tenggara' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                    </select>
                </div>

                <!-- Resep -->
                <div class="form-group">
                    <label for="resep">Resep</label>
                    <textarea name="resep" id="resep" class="form-control" rows="4" required>{{ old('resep', $resep->resep) }}</textarea>
                </div>

                <!-- Sejarah -->
                <div class="form-group">
                    <label for="sejarah">Sejarah</label>
                    <textarea name="sejarah" id="sejarah" class="form-control" rows="4" required>{{ old('sejarah', $resep->sejarah) }}</textarea>
                </div>

                <!-- Gambar -->
                <div class="form-group">
                    <label for="gambar">Gambar</label><br>
                    @if ($resep->gambar)
                        <img src="{{ asset('storage/' . $resep->gambar) }}" alt="Gambar" width="150" class="img-thumbnail mb-2">
                    @endif
                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('resep.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
