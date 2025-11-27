@extends('admin.master')

@section('konten')
<div class="container mt-4">
    <h2 class="fw-bold mb-4">📄 Lihat Status Cerita</h2>

<<<<<<< HEAD
    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('lihat.status') }}" class="mb-4 d-flex">
        <input type="text" name="keyword" class="form-control me-2" placeholder="Cari judul atau user..." 
               value="{{ request('keyword') }}">
        <button type="submit" class="btn btn-orange">Cari</button>
        @if(request('keyword'))
            <a href="{{ route('lihat.status') }}" class="btn btn-secondary ms-2">Reset</a>
        @endif
    </form>

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    <table class="table table-bordered table-striped shadow-sm align-middle">
        <thead class="table-orange text-center">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Isi Cerita</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ceritas as $index => $cerita)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $cerita->user->name ?? 'Admin' }}</td>
                <td>{{ $cerita->judul }}</td>
                <td class="text-center">
                    @if($cerita->gambar)
                        <img src="{{ asset('storage/'.$cerita->gambar) }}" 
                             width="100" 
                             class="rounded img-thumbnail"
                             style="cursor:pointer;"
                             onclick="bukaGambar('{{ asset('storage/'.$cerita->gambar) }}')">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>
                <td class="text-center">
                    <button class="btn btn-info btn-sm"
                        onclick="bukaCerita(`{{ addslashes($cerita->isi_cerita) }}`)">
                        Lihat
                    </button>
                </td>
                <td class="text-center">
                    <span class="badge 
                        @if($cerita->status == 'diterima') bg-success 
                        @elseif($cerita->status == 'ditolak') bg-danger 
                        @else bg-warning text-dark 
                        @endif">
                        {{ ucfirst($cerita->status) }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('admin.cerita.status', $cerita->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="status" class="form-select">
                                <option value="menunggu" {{ $cerita->status=='menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diterima" {{ $cerita->status=='diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $cerita->status=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="btn btn-orange">Simpan</button>
                        </div>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted">Belum ada cerita.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<<<<<<< HEAD

=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
<!-- Popup Gambar -->
<div id="gambarOverlay" class="gambar-overlay" onclick="tutupGambar(event)">
    <span class="close-btn" onclick="tutupGambar(event)">✖</span>
    <img id="gambarPreview" src="" class="gambar-popup" alt="Gambar Cerita">
</div>

<!-- Popup Isi Cerita -->
<div id="ceritaOverlay" class="cerita-overlay" onclick="tutupCerita(event)">
    <span class="close-btn" onclick="tutupCerita(event)">✖</span>
    <div class="cerita-popup" id="ceritaPreview"></div>
</div>

<style>
/* Header tabel oranye */
.table-orange {
    background-color: #e06629 !important;
    color: white !important;
}

/* Tombol simpan oranye */
.btn-orange {
    background-color: #e06629 !important;
    border: none !important;
    color: white !important;
}
.btn-orange:hover {
    background-color: #c75720 !important;
    color: white !important;
}

/* Popup */
.gambar-overlay, .cerita-overlay {
    display: none;
    position: fixed;
    z-index: 1050;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.8);
    justify-content: center; align-items: center;
}
.gambar-overlay.active, .cerita-overlay.active { display: flex; }
.gambar-popup {
    max-width: 80%; max-height: 80%;
    border-radius: 10px; 
    box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
}
.cerita-popup {
    max-width: 80%; max-height: 70%;
    background: white; 
    border-radius: 10px;
    padding: 20px; overflow-y: auto;
    color: #333; font-size: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
}
.close-btn {
    position: absolute; 
    top: 25px; right: 35px;
    font-size: 30px; 
    color: white; 
    cursor: pointer;
    background: rgba(0,0,0,0.5); 
    border-radius: 50%;
    width: 40px; height: 40px; 
    line-height: 35px; 
    text-align: center;
}
.close-btn:hover { background: rgba(255,255,255,0.2); }
</style>

<script>
function bukaGambar(src){
    document.getElementById('gambarPreview').src = src;
    document.getElementById('gambarOverlay').classList.add('active');
}
function tutupGambar(event){
    if(event.target.id==='gambarOverlay' || event.target.classList.contains('close-btn')){
        document.getElementById('gambarOverlay').classList.remove('active');
        document.getElementById('gambarPreview').src='';
    }
}
function bukaCerita(isi){
    document.getElementById('ceritaPreview').innerHTML = isi.replace(/\n/g,'<br>');
    document.getElementById('ceritaOverlay').classList.add('active');
}
function tutupCerita(event){
    if(event.target.id==='ceritaOverlay' || event.target.classList.contains('close-btn')){
        document.getElementById('ceritaOverlay').classList.remove('active');
        document.getElementById('ceritaPreview').innerHTML='';
    }
}
</script>
@endsection
