<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="/admin/gejala/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>

                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Kode Gejala</th>
                        <th>Nama Gejala</th>
                        <th>Nilai Certainty Factor</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($gejala as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_gejala }}</td>
                        <td>{{ $item->nama_gejala }}</td>
                        <td>{{ $item->nilai_cf }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="/admin/gejala/{{ $item->id }}/edit" class="btn btn-info mr-2"><i class="fas fa-edit">Edit</i></a>
                                <form action="/admin/gejala/{{ $item->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash">Hapus</i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>