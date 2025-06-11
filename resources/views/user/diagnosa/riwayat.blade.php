@extends('user.layouts.base')

@section('title', 'Riwayat Diagnosa') {{-- opsional jika title dipakai --}}

@section('content')
    <h2 class="font-weight-bold mb-4">Data Riwayat Diagnosa Pasien</h2>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Umur</th>
            <th scope="col">Penyakit</th>
            <th scope="col">Persentase</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($diagnosas as $diagnosa)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $diagnosa->nama_pasien  }}</td>
                <td>{{ $diagnosa->umur }}</td>
                <td>{{ $diagnosa->penyakit->nama_penyakit ?? 'Tidak Ter-diagnosis' }}</td>
                <td>{{ $diagnosa->persentase }}</td>
                <td>
                    <a href="/user/diagnosa/keputusan/{{ $diagnosa->id }}">Lihat Detail</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
