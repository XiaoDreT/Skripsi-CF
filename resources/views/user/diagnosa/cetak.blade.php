<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Hasil Diagnosa</title>
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<body>
    <style>
        @page{
            size: portrait;
            margin: 90px
        }
    </style>
    <div class="text-center">
        <h3><b>CETAK HASIL DIAGNOSA</b></h3>
        <h4><b>SISTEM PAKAR DIAGNOSA PENYAKIT KULIT</b></h4>
    </div>

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
<hr>
    <h4>Gejala</h4>

    <table class="table">
        <tr>
            <th>No</th>
            <th>Gejala</th>
            <th>Nilai</th>
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

    <script>
        window.print()
    </script>
</body>
</html>