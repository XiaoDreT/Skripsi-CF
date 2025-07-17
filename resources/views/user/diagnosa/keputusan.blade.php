<div class="row">
    <div class="col-md 12">
        <div class="card">
            <div class="card-body">
                
                <a href="/user/diagnosa" class="btn btn-primary mb-2"><i class="fas fa-file"></i> Diagnosa Baru</a>
                <a href="/user/diagnosa/cetak/{{ $pasien->id }}" target="blank" class="btn btn-warning mb-2"><i class="fas fa-print"></i> Cetak</a>

                @if($pasien->persentase < 10)
                <div class="alert alert-warning" style="background-color: #fff3cd; border: 2px solid #ffc107; color: #856404; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <i class="fas fa-exclamation-triangle" style="color: #ffc107; font-size: 20px; margin-right: 10px;"></i>
                        <strong style="font-size: 16px;">Perhatian: Hasil Diagnosa Rendah</strong>
                    </div>
                    <p style="margin-bottom: 15px; line-height: 1.5;">
                        Hasil diagnosa menunjukkan kemungkinan yang sangat rendah. 
                        Gejala yang dipilih mungkin tidak spesifik atau merupakan kombinasi dari beberapa kondisi.
                    </p>
                    <div style="background-color: #ffffff; padding: 12px; border-radius: 5px; border-left: 4px solid #ffc107;">
                        <strong style="color: #856404;">Disarankan untuk:</strong>
                        <ul style="margin-bottom: 0; margin-top: 8px; padding-left: 20px;">
                            <li style="margin-bottom: 5px;">Memilih gejala yang lebih spesifik</li>
                            <li style="margin-bottom: 5px;">Berkonsultasi dengan dokter spesialis kulit</li>
                            <li style="margin-bottom: 5px;">Melakukan pemeriksaan fisik yang lebih detail</li>
                        </ul>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td width="200px">Nama Pasien</td>
                                <td>: {{ $pasien->nama_pasien }}</td>
                            </tr>

                            <tr>
                                <td>Umur</td>
                                <td>: {{ $pasien->umur . ' Tahun' }}</td>
                            </tr>

                            <tr>
                                <td>Penyakit</td>
                                <td>: 
                                    @if(isset($pasien->penyakit))
                                        {{ $pasien->penyakit->nama_penyakit }}
                                    @elseif($pasien->persentase > 0)
                                        {{ $pasien->penyakit->nama_penyakit ?? 'Penyakit tidak teridentifikasi dengan jelas' }}
                                    @else
                                        Gejala yang dipilih tidak cukup spesifik untuk mendiagnosa penyakit tertentu
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>Keakuratan</td>
                                <td>: {{ $pasien->akumulasi_cf }}</td>
                            </tr>

                            <tr>
                                <td>Persentase</td>
                                <td>: {{ $pasien->persentase . '%' }}</td>
                            </tr>
                            
                            <tr>
                                <td>Tingkat Kepercayaan</td>
                                <td>: 
                                    @if($pasien->persentase >= 80)
                                        <span class="badge" style="background-color: #28a745; color: white; font-size: 12px; padding: 6px 12px; border-radius: 15px; font-weight: bold;">Sangat Tinggi</span>
                                    @elseif($pasien->persentase >= 60)
                                        <span class="badge" style="background-color: #17a2b8; color: white; font-size: 12px; padding: 6px 12px; border-radius: 15px; font-weight: bold;">Tinggi</span>
                                    @elseif($pasien->persentase >= 40)
                                        <span class="badge" style="background-color: #ffc107; color: #212529; font-size: 12px; padding: 6px 12px; border-radius: 15px; font-weight: bold;">Sedang</span>
                                    @elseif($pasien->persentase >= 20)
                                        <span class="badge" style="background-color: #dc3545; color: white; font-size: 12px; padding: 6px 12px; border-radius: 15px; font-weight: bold;">Rendah</span>
                                    @else
                                        <span class="badge" style="background-color: #6c757d; color: white; font-size: 12px; padding: 6px 12px; border-radius: 15px; font-weight: bold;">Sangat Rendah</span>
                                    @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Deskripsi</td>
                                <td>: 
                                    @if(isset($pasien->penyakit))
                                        {{ $pasien->penyakit->deskripsi }}
                                    @elseif($pasien->persentase > 0)
                                        {{ $pasien->penyakit->deskripsi ?? 'Deskripsi tidak tersedia' }}
                                    @else
                                        Gejala yang dipilih mungkin merupakan kombinasi dari beberapa kondisi atau memerlukan pemeriksaan lebih lanjut oleh dokter
                                    @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Penanganan</td>
                                <td>: 
                                    @if(isset($pasien->penyakit))
                                        {{ $pasien->penyakit->solusi }}
                                    @elseif($pasien->persentase > 0)
                                        {{ $pasien->penyakit->solusi ?? 'Penanganan tidak tersedia' }}
                                    @else
                                        Disarankan untuk berkonsultasi dengan dokter spesialis kulit untuk pemeriksaan lebih lanjut
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <a href="/user/diagnosa/riwayat" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>

                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Gejala</th>
                                <th>Nilai CF Akhir</th>
                            </tr>

                            @foreach ($gejala as $item)
                            @if ($item->cf_hasil != 0)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->gejala->nama_gejala }}</td>
                                <td>{{ $item->cf_hasil }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                        
                        @if(count($rekomendasiPenyakit) > 1 && $pasien->persentase < 50)
                        <div class="mt-4">
                            <h5><i class="fas fa-lightbulb text-warning"></i> Rekomendasi Penyakit Alternatif</h5>
                            <div class="alert alert-info" style="background-color: #d1ecf1; border-color: #bee5eb; color: #0c5460;">
                                <p class="mb-3"><strong>Berdasarkan gejala yang dipilih, berikut adalah kemungkinan penyakit:</strong></p>
                                
                                @foreach($rekomendasiPenyakit as $index => $rekomendasi)
                                <div class="card mb-3" style="border: 2px solid #17a2b8; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <div class="card-header py-2" style="background-color: #17a2b8; color: white; font-weight: bold;">
                                        <strong>{{ $index + 1 }}. {{ $rekomendasi['penyakit']->nama_penyakit }}</strong>
                                        <span class="badge badge-light float-right" style="background-color: #ffffff; color: #17a2b8; font-size: 14px; padding: 5px 10px;">{{ $rekomendasi['persentase'] }}%</span>
                                    </div>
                                    <div class="card-body py-3" style="background-color: #ffffff;">
                                        <div style="color: #495057; font-weight: 600; margin-bottom: 8px;">
                                            <i class="fas fa-check-circle text-success"></i> Gejala yang cocok:
                                        </div>
                                        <ul class="mb-2" style="color: #6c757d; padding-left: 20px;">
                                            @foreach($rekomendasi['gejala_cocok'] as $gejala)
                                            <li style="margin-bottom: 4px;">{{ $gejala->gejala->nama_gejala }}</li>
                                            @endforeach
                                        </ul>
                                        
                                        @if($index == 0)
                                        <div style="background-color: #e8f5e8; border: 1px solid #28a745; padding: 8px; border-radius: 5px; margin-top: 10px;">
                                            <small style="color: #155724;">
                                                <i class="fas fa-star text-warning"></i> 
                                                <strong>Penyakit Utama:</strong> Dipilih berdasarkan CF tertinggi ({{ $rekomendasi['cf_hasil'] }}), 
                                                {{ $rekomendasi['jumlah_gejala'] }} gejala cocok, rata-rata CF: {{ number_format($rekomendasi['rata_rata_cf'], 3) }}
                                            </small>
                                        </div>
                                        @else
                                        <div style="background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 8px; border-radius: 5px; margin-top: 10px;">
                                            <small style="color: #6c757d;">
                                                <i class="fas fa-info-circle"></i> 
                                                CF: {{ $rekomendasi['cf_hasil'] }}, {{ $rekomendasi['jumlah_gejala'] }} gejala, rata-rata: {{ number_format($rekomendasi['rata_rata_cf'], 3) }}
                                            </small>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                
                                <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 10px; border-radius: 5px; margin-top: 15px;">
                                    <small style="color: #856404;">
                                        <i class="fas fa-info-circle"></i> 
                                        <strong>Penting:</strong> Rekomendasi ini berdasarkan analisis gejala yang dipilih. Untuk diagnosa yang lebih akurat, disarankan berkonsultasi dengan dokter.
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
    }
    
    .badge {
        display: inline-block;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
    }
    
    .alert {
        position: relative;
        overflow: hidden;
    }
    
    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #17a2b8, #20c997);
    }
    
    ul {
        list-style-type: disc;
    }
    
    ul li {
        position: relative;
        padding-left: 0;
    }
</style>