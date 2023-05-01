<div class="modal-dialog modal-sm">
    <form id="form" class="modal-content" action="{{ $url ?? route('data-siswa.store') }}" method="POST">
        @csrf
        @isset($url)
        @method('put')
        @endisset
        <div class="modal-header">
            <h5 class="modal-title">Siswa</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">NIS</label>
                        <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="">NISN</label>
                        <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <div class="d-flex">
                            <div class="form-check form-check-primary">
                                <input type="radio" class="form-check-input" id="lakilaki" {{ $siswa->jenis_kelamin == 'Laki-Laki' ? 'checked' : null }} name="jenis_kelamin" value="Laki-Laki">
                                <label for="lakilaki" class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-primary ms-2">
                                <input type="radio" class="form-check-input" id="perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'checked' : null }} name="jenis_kelamin" value="Perempuan">
                                <label for="perempuan" class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-control select2" data-placeholder="Pilih Tahun Ajaran">
                            <option></option>
                            @foreach ($tahun_ajaran as $item)
                            <option value="{{ $item->id }}" {{ $siswa->tahun_ajaran_id == $item->id ? 'selected' : null }}>{{ $item->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <select name="jurusan" class="form-control select2" data-placeholder="Pilih Jurusan">
                            <option></option>
                            @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}" {{ $siswa->jurusan_id == $item->id ? 'selected' : null }}>{{ $item->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" type="button">Tutup</button>
            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
        </div>
    </form>
</div>