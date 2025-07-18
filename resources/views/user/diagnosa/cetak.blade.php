<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Hasil Diagnosa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: A4 portrait;
            margin: 1.5cm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: white;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .header h2 {
            color: #34495e;
            font-size: 18px;
            font-weight: 600;
        }
        
        .patient-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .patient-info h3 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
        }
        
        .info-label {
            width: 150px;
            font-weight: bold;
            color: #2c3e50;
            flex-shrink: 0;
        }
        
        .info-value {
            flex: 1;
            color: #555;
        }
        
        .diagnosis-result {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .diagnosis-result h3 {
            font-size: 20px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .result-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .result-item {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        
        .result-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .result-value {
            font-size: 18px;
            font-weight: bold;
        }
        
        .symptoms-section {
            margin-bottom: 25px;
        }
        
        .symptoms-section h3 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 5px;
        }
        
        .symptoms-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .symptoms-table th {
            background: #e74c3c;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        
        .symptoms-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        
        .symptoms-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .symptoms-table tr:hover {
            background: #e3f2fd;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .print-date {
            text-align: right;
            color: #666;
            font-size: 12px;
            margin-bottom: 20px;
        }
        
        .confidence-level {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        
        .confidence-high {
            background: #d4edda;
            color: #155724;
        }
        
        .confidence-medium {
            background: #fff3cd;
            color: #856404;
        }
        
        .confidence-low {
            background: #f8d7da;
            color: #721c24;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="print-date">
        Tanggal Cetak: {{ date('d/m/Y H:i') }}
    </div>

    <div class="header">
        <h1>HASIL DIAGNOSA PENYAKIT KULIT</h1>
        <h2>Sistem Pakar Menggunakan Metode Certainty Factor</h2>
    </div>

    <div class="patient-info">
        <h3>Informasi Pasien</h3>
        <div class="info-row">
            <div class="info-label">Nama Pasien:</div>
            <div class="info-value">{{ $pasien->nama_pasien }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Umur:</div>
            <div class="info-value">{{ $pasien->umur }} Tahun</div>
        </div>
    </div>

    <div class="diagnosis-result">
        <h3>Hasil Diagnosa</h3>
        <div class="result-grid">
            <div class="result-item">
                <div class="result-label">Penyakit Terdiagnosa</div>
                <div class="result-value">
                    @if(isset($pasien->penyakit))
                        {{ $pasien->penyakit->nama_penyakit }}
                    @elseif($pasien->persentase > 0)
                        {{ $pasien->penyakit->nama_penyakit ?? 'Tidak teridentifikasi' }}
                    @else
                        Gejala tidak spesifik
                    @endif
                </div>
            </div>
            <div class="result-item">
                <div class="result-label">Tingkat Kepercayaan</div>
                <div class="result-value">
                    <span class="confidence-level 
                        @if($pasien->persentase >= 70) confidence-high
                        @elseif($pasien->persentase >= 40) confidence-medium
                        @else confidence-low @endif">
                        {{ $pasien->persentase }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="patient-info">
        <h3>Detail Diagnosa</h3>
        <div class="info-row">
            <div class="info-label">Nilai CF:</div>
            <div class="info-value">{{ $pasien->akumulasi_cf }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Deskripsi:</div>
            <div class="info-value">
                @if(isset($pasien->penyakit))
                    {{ $pasien->penyakit->deskripsi }}
                @elseif($pasien->persentase > 0)
                    {{ $pasien->penyakit->deskripsi ?? 'Deskripsi tidak tersedia' }}
                @else
                    Gejala yang dipilih mungkin merupakan kombinasi dari beberapa kondisi atau memerlukan pemeriksaan lebih lanjut oleh dokter.
                @endif
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Penanganan:</div>
            <div class="info-value">
                @if(isset($pasien->penyakit))
                    {{ $pasien->penyakit->solusi }}
                @elseif($pasien->persentase > 0)
                    {{ $pasien->penyakit->solusi ?? 'Penanganan tidak tersedia' }}
                @else
                    Disarankan untuk berkonsultasi dengan dokter spesialis kulit untuk pemeriksaan lebih lanjut.
                @endif
            </div>
        </div>
    </div>

    <div class="symptoms-section">
        <h3>Gejala yang Dialami</h3>
        <table class="symptoms-table">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="70%">Gejala</th>
                    <th width="20%">Nilai CF</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @foreach ($gejala as $item)
                @if ($item->cf_hasil != 0)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $item->gejala->nama_gejala }}</td>
                    <td>{{ $item->cf_hasil }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p><strong>Catatan:</strong> Hasil diagnosa ini merupakan perkiraan berdasarkan gejala yang dipilih. Untuk kepastian diagnosa, disarankan untuk berkonsultasi dengan dokter spesialis kulit.</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>