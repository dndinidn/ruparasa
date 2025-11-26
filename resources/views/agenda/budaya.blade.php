@extends('dashboard.master')

@section('konten')
<!-- 🟧 HEADER DENGAN GAMBAR LATAR -->
<div class="header-agenda text-center py-5 mb-5">
    <div class="header-overlay">
        <h1 class="fw-bold text-uppercase mb-2 title-white">Agenda Budaya Sulawesi</h1>
        <p class="mb-0 subtitle-white">Menelusuri dan melestarikan kekayaan budaya masyarakat adat di Sulawesi</p>
    </div>
</div>

<div class="container py-5" style="font-family: 'Inter', sans-serif;">

    {{-- ✅ Alert jika berhasil menambah agenda --}}
    @if (session('success'))
    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="text-center mb-5">
        <h2 class="fw-bold text-orange text-uppercase">Kalender & Kegiatan Budaya</h2>
        <p class="text-muted">
            Lihat dan promosikan berbagai kegiatan budaya di Sulawesi sepanjang tahun.
        </p>
    </div>

    <!-- 📅 Kalender Visual -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button id="prevMonth" class="btn btn-outline-orange btn-sm rounded-pill">
                    <i class="bi bi-chevron-left"></i> Sebelumnya
                </button>

                <h5 id="monthYear" class="mb-0 fw-bold text-orange text-uppercase"></h5>

                <button id="nextMonth" class="btn btn-outline-orange btn-sm rounded-pill">
                    Berikutnya <i class="bi bi-chevron-right"></i>
                </button>
            </div>

            <div id="kalender" class="calendar-grid"></div>
        </div>
    </div>

    <!-- 📜 Tabel Agenda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h5 class="mb-3 text-orange"><i class="bi bi-list-ul"></i> Daftar Agenda Budaya</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead style="background-color: #f77f00; color: #fff;">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Acara</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($agendaBudaya as $agenda)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>{{ $agenda->nama }}</td>
                            <td>{{ $agenda->lokasi }}</td>
                            <td>
                                @php
                                    $descPreview = Str::limit($agenda->deskripsi, 50);
                                @endphp
                                {{ $descPreview }}
                                @if(strlen($agenda->deskripsi) > 50)
                                    <a href="#" class="lihat-detail text-orange fw-bold"
                                       data-nama="{{ $agenda->nama }}"
                                       data-tanggal="{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}"
                                       data-lokasi="{{ $agenda->lokasi }}"
                                       data-deskripsi="{{ $agenda->deskripsi }}">
                                        Lihat Selengkapnya
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted py-3">Belum ada agenda budaya yang tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-orange rounded-pill px-4 py-2">Kembali ke Beranda</a>
        <button class="btn btn-orange rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#tambahAgendaModal">
            <i class="bi bi-plus-circle"></i> Tambah Agenda
        </button>
    </div>
</div>

<!-- 🧩 Modal Tambah Agenda -->
<div class="modal fade" id="tambahAgendaModal" tabindex="-1" aria-labelledby="tambahAgendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="font-family: 'Inter', sans-serif;">
            <form action="{{ route('agenda.storee') }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color: #f77f00; color: #fff;">
                    <h5 class="modal-title" id="tambahAgendaLabel"><i class="bi bi-plus-circle"></i> Tambah Agenda Budaya</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Acara</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Acara</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Festival Toraja" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Contoh: Tana Toraja" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control" placeholder="Tuliskan deskripsi kegiatan..." required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-orange rounded-pill">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 🧩 Modal Detail Agenda -->
<div class="modal fade" id="detailAgendaModal" tabindex="-1" aria-labelledby="detailAgendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header" style="background-color: #f77f00; color: #fff;">
                <h5 class="modal-title" id="detailAgendaLabel">Detail Agenda Budaya</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailAgendaBody">
                <!-- Konten akan diisi melalui JS -->
            </div>
        </div>
    </div>
</div>

<!-- 🧩 Script Kalender + Detail Agenda -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const kalenderEl = document.getElementById('kalender');
    const monthYearEl = document.getElementById('monthYear');

    // Ambil tanggal dari Laravel
    const tanggalAcara = @json($agendaBudaya->map(function($item) {
        return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
    }));

    let current = new Date();

    function renderCalendar(year, month) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startDay = firstDay.getDay();
        const totalDays = lastDay.getDate();

        const namaBulan = firstDay.toLocaleString('id-ID', { month: 'long', year: 'numeric' });
        monthYearEl.textContent = namaBulan.toUpperCase();

        let html = '<div class="calendar-container">';
        const hari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        hari.forEach(h => html += `<div class="day-header">${h}</div>`);

        for (let i = 0; i < startDay; i++) html += `<div class="day empty"></div>`;

        for (let d = 1; d <= totalDays; d++) {
            const tanggalFull = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
            const adaAcara = tanggalAcara.includes(tanggalFull);
            html += `<div class="day ${adaAcara ? 'has-event' : ''}"><span>${d}</span></div>`;
        }

        html += '</div>';
        kalenderEl.innerHTML = html;
    }

    renderCalendar(current.getFullYear(), current.getMonth());
    document.getElementById('prevMonth').addEventListener('click', () => {
        current.setMonth(current.getMonth() - 1);
        renderCalendar(current.getFullYear(), current.getMonth());
    });
    document.getElementById('nextMonth').addEventListener('click', () => {
        current.setMonth(current.getMonth() + 1);
        renderCalendar(current.getFullYear(), current.getMonth());
    });

    // Event listener untuk tombol "Lihat Selengkapnya"
    document.querySelectorAll('.lihat-detail').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const nama = this.dataset.nama;
            const tanggal = this.dataset.tanggal;
            const lokasi = this.dataset.lokasi;
            const deskripsi = this.dataset.deskripsi;

            const modalBody = `
                <p><strong>Nama Acara:</strong> ${nama}</p>
                <p><strong>Tanggal:</strong> ${tanggal}</p>
                <p><strong>Lokasi:</strong> ${lokasi}</p>
                <p><strong>Deskripsi:</strong> ${deskripsi}</p>
            `;

            document.getElementById('detailAgendaBody').innerHTML = modalBody;
            const modal = new bootstrap.Modal(document.getElementById('detailAgendaModal'));
            modal.show();
        });
    });
});
</script>

<!-- 🧩 Style Kalender + Header Gambar -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body, h1, h2, h3, h4, h5, h6, p, button, input, textarea {
    font-family: 'Inter', sans-serif !important;
}

/* HEADER */
.header-agenda {
    background: url('/images/bg-budaya.png') center center/cover no-repeat;
    border-radius: 0 0 20px 20px;
    position: relative;
    overflow: hidden;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.header-agenda .header-overlay {
    background-color: rgba(222, 215, 215, 0.4);
    padding: 40px;
    border-radius: 15px;
}
.title-white { color: #ffffff; text-shadow: 2px 2px 10px rgba(0,0,0,0.7); }
.subtitle-white { color: #ffffff; opacity: 0.95; text-shadow: 1px 1px 8px rgba(0,0,0,0.5); }

.text-orange { color: #f77f00 !important; }

/* Tombol */
.btn-orange { background-color: #f77f00; color: #fff; border: none; }
.btn-orange:hover { background-color: #e56e00; color: #fff; }

.btn-outline-orange { border: 1px solid #f77f00; color: #f77f00; background: transparent; }
.btn-outline-orange:hover { background-color: #f77f00; color: #fff; }

/* Kalender */
.calendar-container { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; background-color: #f9f9f9; border-radius: 12px; padding: 15px; }
.day, .day-header { text-align: center; padding: 10px; border-radius: 8px; transition: all 0.3s ease; font-size: 15px; }
.day-header { background-color: #ffe5cc; font-weight: 600; color: #f77f00; }
.day {
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    border: 1px solid #dee2e6;
    color: #333;
}
.day.has-event {
    background-color: #f77f00;
    border: 2px solid #e56e00;
    color: #fff;
    font-weight: bold;
}
.day:hover { background-color: #ffe5cc; cursor: pointer; }
</style>
@endsection
