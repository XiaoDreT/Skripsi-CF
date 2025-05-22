<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="/admin/penyakit/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>

                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Penyakit</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($penyakit as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="/admin/penyakit/{{ $item->id }}"><b>
                            {{ $item->nama_penyakit }}</b>
                            </a>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="/admin/penyakit/{{ $item->id }}/edit" class="btn btn-info mr-2"><i class="fas fa-edit">Edit</i></a>
                                <form action="/admin/penyakit/{{ $item->id }}" method="POST">
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