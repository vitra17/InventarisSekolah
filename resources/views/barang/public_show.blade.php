@extends('layouts.app')

@section('content')
<style>
    .public-card {
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.08);
        overflow: hidden;
        background: #ffffff;
    }
    .public-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        text-align: center;
    }
    .school-badge {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 6px 16px;
        border-radius: 50px;
        backdrop-filter: blur(4px);
        display: inline-block;
    }
    .asset-code-badge {
        background: #ffffff;
        color: #0d6efd;
        font-weight: 700;
        padding: 6px 18px;
        border-radius: 8px;
        font-size: 1rem;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .status-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        height: 100%;
        text-align: center;
    }
    .info-list-group {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        background: #ffffff;
    }
    .info-item {
        display: flex;
        flex-direction: column;
        padding: 0.9rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s ease;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-item:hover {
        background-color: #f8fafc;
    }
    .info-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        margin-bottom: 0.25rem;
    }
    .info-label i {
        color: #0d6efd;
        width: 22px;
    }
    .info-value {
        color: #1e293b;
        font-weight: 600;
        font-size: 0.95rem;
        word-break: break-word;
    }
    .qr-container {
        background: #f0f7ff;
        border: 2px dashed #bfdbfe;
        border-radius: 14px;
        padding: 1.25rem;
        text-align: center;
    }
    @media (min-width: 576px) {
        .info-item {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        .info-label {
            margin-bottom: 0;
            flex: 0 0 45%;
        }
        .info-value {
            flex: 0 0 55%;
            text-align: right;
        }
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            
            <!-- Main Public Card -->
            <div class="public-card">
                
                <!-- Header Banner -->
                <div class="public-header">
                    <div class="mb-2">
                        <span class="school-badge">
                            <i class="fas fa-school me-1"></i> SD MUHAMMADIYAH METRO PUSAT
                        </span>
                    </div>
                    <h2 class="fw-bold mb-2 text-white">{{ $barang->nama_barang }}</h2>
                    <div class="mt-3">
                        <span class="asset-code-badge">
                            <i class="fas fa-barcode me-1"></i> {{ $barang->kode_aset }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-3 p-md-4">
                    
                    <!-- Quick Status Badges -->
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <div class="status-card">
                                <span class="text-muted small d-block mb-1">Kondisi Saat Ini</span>
                                @if($barang->kondisi_terkini === 'Baik')
                                    <span class="badge bg-success px-3 py-2 fs-6 rounded-pill">
                                        <i class="fas fa-check-circle me-1"></i> {{ $barang->kondisi_terkini }}
                                    </span>
                                @elseif($barang->kondisi_terkini === 'Rusak Ringan')
                                    <span class="badge bg-warning text-dark px-3 py-2 fs-6 rounded-pill">
                                        <i class="fas fa-exclamation-triangle me-1"></i> {{ $barang->kondisi_terkini }}
                                    </span>
                                @else
                                    <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill">
                                        <i class="fas fa-times-circle me-1"></i> {{ $barang->kondisi_terkini }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="status-card">
                                <span class="text-muted small d-block mb-1">Status Validasi</span>
                                @if($barang->status_validasi === 'approved')
                                    <span class="badge bg-primary px-3 py-2 fs-6 rounded-pill">
                                        <i class="fas fa-user-check me-1"></i> Disetujui Waka
                                    </span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 fs-6 rounded-pill">
                                        <i class="fas fa-clock me-1"></i> Menunggu Validasi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Layout 2 Kolom untuk Info & QR Code -->
                    <div class="row g-4 mb-4 align-items-center">
                        <div class="col-12 col-md-7 col-lg-8">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-info-circle me-1"></i> Detail Informasi Barang
                            </h6>
                            
                            <div class="info-list-group">
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-tag"></i>Nama Barang</span>
                                    <span class="info-value">{{ $barang->nama_barang }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-layer-group"></i>Kategori Aset</span>
                                    <span class="info-value">{{ $barang->masterKodeAset->kategori ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-copyright"></i>Merek / Type</span>
                                    <span class="info-value">{{ $barang->merek ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-door-open"></i>Lokasi Ruangan</span>
                                    <span class="info-value text-primary">{{ $barang->lokasi->nama_ruangan ?? 'Belum Ditentukan' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-user-tie"></i>Penanggung Jawab</span>
                                    <span class="info-value">{{ $barang->lokasi->penanggung_jawab ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-coins"></i>Harga Perolehan</span>
                                    <span class="info-value">Rp {{ number_format($barang->harga_perolehan, 0, ',', '.') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-wallet"></i>Sumber Dana</span>
                                    <span class="info-value">{{ $barang->sumber_dana ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-calendar-alt"></i>Tgl. Perolehan</span>
                                    <span class="info-value">{{ \Carbon\Carbon::parse($barang->tanggal_perolehan)->translatedFormat('d F Y') }}</span>
                                </div>
                                @if($barang->catatan_waka)
                                <div class="info-item">
                                    <span class="info-label"><i class="fas fa-comment-alt"></i>Catatan Waka</span>
                                    <span class="info-value text-muted"><em>{{ $barang->catatan_waka }}</em></span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Panel QR Code -->
                        <div class="col-12 col-md-5 col-lg-4 text-center">
                            <div class="qr-container">
                                <div class="p-2 bg-white d-inline-block rounded-3 shadow-sm mb-2">
                                    {!! QrCode::size(130)->generate($barang->public_url) !!}
                                </div>
                                <div class="fw-semibold text-primary small">
                                    <i class="fas fa-check-circle me-1"></i>QR Code Terverifikasi
                                </div>
                                <p class="text-muted small mb-0 mt-1">Scan untuk membuka kembali halaman resmi ini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Keterangan Publik -->
                    <div class="p-3 bg-light rounded-3 d-flex align-items-center text-muted small">
                        <i class="fas fa-shield-alt text-primary fa-2x me-3"></i>
                        <div>
                            <strong>Informasi Publik:</strong> Halaman ini bersifat terbuka dan resmi dari Sistem Informasi Inventaris Sekolah SD Muhammadiyah Metro Pusat.
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="bg-light p-3 p-md-4 border-top d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                    @auth
                        <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-primary w-100 w-sm-auto px-4 rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 w-sm-auto px-4 rounded-pill">
                            <i class="fas fa-sign-in-alt me-1"></i> Login Petugas / Staff
                        </a>
                    @endauth
                    
                    <span class="text-muted small text-center text-sm-end">
                        &copy; {{ date('Y') }} <strong>SD Muhammadiyah Metro Pusat</strong>
                    </span>
                </div>

            </div>
            
        </div>
    </div>
</div>
@endsection
