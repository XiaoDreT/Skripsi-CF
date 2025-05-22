<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>{{ $penyakit->nama_penyakit }}</b></h5>
                        <p>
                            <b>Deskripsi</b><br>
                            {{ $penyakit->deskripsi }}
                        </p>
                        <p>
                            <b>Solusi</b><br>
                            {{ $penyakit->solusi }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <table class="table">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                                <i class="fas fa-plus"></i> Tambah Gejala
                            </button>
                            <div class="modal fade" id="modal-info">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-info">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Gejala</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/admin/penyakit/add-gejala" method="POST">
                                                @csrf

                                                <input type="text" name="penyakit_id" value="{{ $penyakit->id }}" hidden>
                                                <div class="form-group">
                                                    <div class="label">Gejala</div>
                                                    <select name="gejala_id" class="form-control" id="">
                                                        <option value="">-- Gejala --</option>
                                                        @foreach ($gejala as $item)
                                                            <option value="{{ $item->id }}">{{ $item->kode_gejala.' - '.$item->nama_gejala }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <div class="label">Bobot CF</div>
                                                    <input type="text" class="form-control" name="bobot_cf" id="" placeholder="0.0">
                                                </div>

                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-light">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <tr>
                                <td>No</td>
                                <td>Kode Gejala</td>
                                <td>Nama</td>
                                <td>Bobot CF</td>
                                <td>#</td>
                            </tr>

                            @foreach ($role as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->gejala->kode_gejala }}</td>
                                    <td>{{ $item->gejala->nama_gejala }}</td>
                                    <td>{{ $item->bobot_cf }}</td>
                                    <td>
                                        <form action="/admin/penyakit/delete-role/{{ $item->gejala_id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>