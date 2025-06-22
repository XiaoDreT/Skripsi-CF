<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Jenis Penyakit Kulit</th>
                            <th>Kode Gejala</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($basisPengetahuan as $item)
                        <tr>
                            <td>{{ $item['nama_penyakit'] }}</td>
                            <td>{{ $item['kode_gejala'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 