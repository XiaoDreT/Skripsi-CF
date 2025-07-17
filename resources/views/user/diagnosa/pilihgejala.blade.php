<div class="row">
    <div class="col-md-12">
    <!-- Tombol Tutorial -->
    <div class="mb-3">
        <button type="button" class="btn btn-warning" onclick="showTutorial()">
            <i class="fas fa-question-circle"></i> Tutorial
        </button>
    </div>
        <div class="card">
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md 6">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $pasien->nama_pasien }}</td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>: {{ $pasien->umur. ' Tahun' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Gejala</th>
                                <th>#</th>
                            </tr>

                            @foreach ($gejala as $item)
                            
                            @php
                                $cek = App\Models\Diagnosa::whereGejalaId($item->id)
                                    ->wherePasienId(session()->get('pasien_id'))
                                    ->first();
                            @endphp

                            @if ($cek == false)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_gejala }}</td>
                                <td>{{ $item->nama_gejala }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">Pilih</button>
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                        <a class="dropdown-item" href="/user/diagnosa/pilih?gejala_id={{ $item->id }}&nilai=1">Sangat Yakin (100%)</a>
                                        <a class="dropdown-item" href="/user/diagnosa/pilih?gejala_id={{ $item->id }}&nilai=0.8">Yakin (80%)</a>
                                        <a class="dropdown-item" href="/user/diagnosa/pilih?gejala_id={{ $item->id }}&nilai=0.6">Cukup Yakin (60%)</a>
                                        <a class="dropdown-item" href="/user/diagnosa/pilih?gejala_id={{ $item->id }}&nilai=0.4">Sedikit Yakin (40%)</a>
                                        <a class="dropdown-item" href="/user/diagnosa/pilih?gejala_id={{ $item->id }}&nilai=0.2">Tidak Tahu (20%)</a>
                                        <a class="dropdown-item" href="/user/diagnosa/pilih?gejala_id={{ $item->id }}&nilai=0">Tidak Mengalami (0%)</a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Gejala</th>
                                <th>Keyakinan</th>
                                <th>#</th>
                            </tr>

                            @foreach ($gejalaTerpilih as $item)
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->gejala->kode_gejala }}</td>
                                <td>{{ $item->gejala->nama_gejala }}</td>
                                <td>{{ $item->nilai_cf }}</td>
                                <td>
                                    <a href="/user/diagnosa/hapus-gejala?gejala_id={{ $item->gejala_id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            
                            @endforeach
                        </table>

                        <a href="/user/diagnosa/proses" class="btn btn-primary btn-block"><i class="fas fa-circle"></i> Diagnosa</a>
                    </div>
                </div>

                <!-- Tambahkan ini di layout atau halaman yang menerima redirect -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    @if(session('warning'))
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: "{{ session('warning') }}",
                        });
                    @endif
                </script>

                <script>
                    function showTutorial() {
                        Swal.fire({
                            title: 'Tutorial Penggunaan Aplikasi Sistem Pakar',
                            icon: 'info',
                            html: `
                                <ol style="text-align: left;">
                                    <li>Pilih gejala sesuai dengan gejala yang anda alami saat ini.</li>
                                    <li>Setelah klik salah satu gejala, pilih salah satu tingkatan keyakinan anda berdasarkan preferensi anda mulai dari skala <strong>"Tidak Mengalami Gejala"</strong> sampai <strong>"Sangat Yakin"</strong>.</li>
                                    <li>Setelah gejala-gejala terpilih, lanjutkan diagnosa dengan klik tombol <strong>"Diagnosa"</strong> pada bagian bawah tabel "Gejala Terpilih".</li>
                                </ol>
                            `,
                            confirmButtonText: 'Mengerti',
                        });
                    }
                </script>

            </div>
        </div>
    </div>
</div>