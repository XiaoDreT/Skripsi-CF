<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Data Pasien</h5>
                    {{-- <a href="/admin/pasien/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a> --}}
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama Pasien</th>
                                <th width="10%">Umur</th>
                                <th width="25%">Diagnosa Penyakit</th>
                                <th width="15%">Keakuratan</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $item)
                            <tr>
                                <td>{{ $pasien->firstItem() + $loop->index }}</td>
                                <td>
                                    <a href="/admin/diagnosa/keputusan/{{ $item->id }}" class="text-decoration-none">
                                        <strong>{{ $item->nama_pasien }}</strong>
                                    </a>
                                </td>
                                <td>{{ $item->umur }} tahun</td>
                                <td>
                                    @if(isset($item->penyakit))
                                        <span class="badge badge-success">{{ $item->penyakit->nama_penyakit }}</span>
                                    @else
                                        <span class="badge badge-secondary">Data Kosong</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $item->persentase }}%</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        {{-- <a href="/admin/pasien/{{ $item->id }}/edit" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                        </a> --}}
                                        <form action="/admin/pasien/{{ $item->id }}" method="POST" class="d-inline">
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

                <div class="d-flex justify-content-center mt-3">
                    {{ $pasien->links() }}
                </div>
            </div>
        </div>
    </div>
</div>