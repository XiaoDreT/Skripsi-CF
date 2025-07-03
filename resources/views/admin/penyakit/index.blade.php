<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Data Penyakit</h5>
                    <a href="/admin/penyakit/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="10%">No</th>
                                <th width="70%">Penyakit</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyakit as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="/admin/penyakit/{{ $item->id }}" class="text-decoration-none">
                                        <strong>{{ $item->nama_penyakit }}</strong>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="/admin/penyakit/{{ $item->id }}/edit" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="/admin/penyakit/{{ $item->id }}" method="POST" class="d-inline">
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