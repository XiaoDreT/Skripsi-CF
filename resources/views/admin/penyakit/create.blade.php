<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @isset($penyakit)

                <form action="/admin/penyakit/{{ $penyakit->id }}" method="POST">
                    @method('PUT')
                @else
                <form action="/admin/penyakit" method="POST">
                @endisset
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Penyakit</label>
                        <input type="nama_penyakit" class="form-control @error('nama_penyakit') is-invalid @enderror" name="nama_penyakit" placeholder="Masukkan Nama Penyakit" value="{{ isset($penyakit) ? $penyakit->nama_penyakit : old('nama_penyakit') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">
                            {{ isset($penyakit) ? $penyakit->deskripsi : old('deskripsi') }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Solusi</label>
                        <textarea name="solusi" class="form-control" id="" cols="30" rows="10">
                            {{ isset($penyakit) ? $penyakit->solusi : old('solusi') }}
                        </textarea>
                    </div>

                    <a href="/admin/penyakit" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>