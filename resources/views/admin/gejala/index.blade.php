<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Data Gejala</h5>
                    <a href="/admin/gejala/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode Gejala</th>
                                <th width="35%">Nama Gejala</th>
                                <th width="20%">Nilai CF</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gejala as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $item->kode_gejala }}</strong></td>
                                <td>{{ $item->nama_gejala }}</td>
                                <td><span class="badge badge-info">{{ $item->nilai_cf }}</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="/admin/gejala/{{ $item->id }}/edit" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="/admin/gejala/{{ $item->id }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
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