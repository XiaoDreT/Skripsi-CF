<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @isset($gejala)

                <form action="/admin/gejala/{{ $gejala->id }}" method="POST">
                    @method('PUT')
                @else
                <form action="/admin/gejala" method="POST">
                @endisset
                    @csrf
                    <div class="form-group">
                        <label for="">Kode Gejala</label>
                        <input type="text" class="form-control @error('kode_gejala') is-invalid @enderror" name="kode_gejala" placeholder="Masukkan Kode Gejala" value="{{ isset($gejala) ? $gejala->kode_gejala : old('kode_gejala') }}">
                        @error('kode_gejala')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Nama Gejala</label>
                        <input type="text" class="form-control @error('nama_gejala') is-invalid @enderror" name="nama_gejala" placeholder="Masukkan Nama Gejala" value="{{ isset($gejala) ? $gejala->nama_gejala : old('nama_gejala') }}">
                        @error('nama_gejala')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Nilai Certainty Factor</label>
                        <input type="text" class="form-control @error('nilai_cf') is-invalid @enderror" name="nilai_cf" placeholder="Masukkan Nilai Certainty Factor" value="{{ isset($gejala) ? $gejala->nilai_cf : old('nilai_cf') }}">
                        @error('nilai_cf')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <a href="/admin/gejala" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>