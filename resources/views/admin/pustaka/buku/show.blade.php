@extends('admin.master')

@section('konten')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📖 Detail Buku</h4>
            <a href="{{ route('admin.buku.index') }}" class="btn btn-light btn-sm">Kembali</a>
        </div>

        <div class="card-body">
            <h5 class="fw-bold mb-3">{{ $buku->judul }}</h5>

            <p><strong>Deskripsi:</strong></p>
            <p class="text-muted">{{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

            @if ($buku->file_pdf)
                <hr>
                <p><strong>Cover Buku (Halaman 1 PDF):</strong></p>

                <div class="text-center">
                    <canvas id="pdfCanvas" width="350" height="480"
                            data-pdf="{{ asset('storage/' . $buku->file_pdf) }}"
                            style="border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); cursor:pointer;">
                    </canvas>
                    <div class="mt-3">
                        <a href="{{ asset('storage/' . $buku->file_pdf) }}" target="_blank" class="btn btn-outline-primary">
                            📄 Buka PDF Lengkap
                        </a>
                    </div>
                </div>
            @else
                <p class="text-muted">Tidak ada file PDF.</p>
            @endif
        </div>
    </div>
</div>

<!-- PDF.js untuk render cover -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('pdfCanvas');
    const pdfUrl = canvas ? canvas.getAttribute('data-pdf') : null;

    if (pdfUrl && window['pdfjsLib']) {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.worker.min.js';

        // Render halaman pertama PDF ke canvas
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                const scale = 1.2;
                const viewport = page.getViewport({ scale });
                const context = canvas.getContext('2d');

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        }).catch(function(error) {
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#f5f5f5';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#888';
            ctx.font = '16px sans-serif';
            ctx.fillText('Gagal memuat cover PDF', 30, 50);
        });

        // Klik cover = buka file PDF
        canvas.addEventListener('click', function() {
            window.open(pdfUrl, '_blank');
        });
    }
});
</script>

<style>
.card-body p {
    font-size: 16px;
}
#pdfCanvas {
    transition: transform 0.3s ease;
}
#pdfCanvas:hover {
    transform: scale(1.03);
}
</style>
@endsection
