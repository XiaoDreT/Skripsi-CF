<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Basis Pengetahuan</h5>
                    <div class="text-muted">
                        <i class="fas fa-info-circle"></i> Data relasi penyakit dan gejala
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="60%">Jenis Penyakit Kulit</th>
                                <th width="40%">Kode Gejala</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($basisPengetahuan as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item['nama_penyakit'] }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $item['kode_gejala'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 