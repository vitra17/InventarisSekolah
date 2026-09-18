<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_kode_aset_id',
        'kode_aset',
        'lokasi_id',
        'merek',
        'nama_barang',
        'harga_perolehan',
        'tanggal_perolehan',
        'kondisi_terkini',
        'status_validasi',
        'catatan_waka',
        'sumber_dana',
    ];

    protected $table = 'barang_inventaris';

    // Relasi: Barang milik Master Kode Aset tertentu
    public function masterKodeAset()
    {
        return $this->belongsTo(MasterKodeAset::class, 'master_kode_aset_id');
    }

    // Relasi: Barang berada di satu Lokasi
    public function lokasi()
    {
        return $this->belongsTo(LokasiRuangan::class, 'lokasi_id');
    }

    // Relasi: Barang punya banyak Laporan Pemeliharaan
    public function laporans()
    {
        return $this->hasMany(LaporanPemeliharaan::class, 'barang_id');
    }

    /**
     * URL Publik untuk QR Code (Otomatis menggunakan IP Wi-Fi jika dijalankan di localhost)
     */
    public function getPublicUrlAttribute()
    {
        $url = route('public.barang.show', $this->id);

        if (str_contains($url, 'localhost') || str_contains($url, '127.0.0.1')) {
            $localIp = gethostbyname(gethostname());
            if ($localIp && $localIp !== '127.0.0.1') {
                $url = str_replace(['localhost', '127.0.0.1'], $localIp, $url);
            }
        }

        return $url;
    }
}