<div class="modal-dialog modal-sm">
    <form id="form" class="modal-content" action="{{ route('data-siswa.export') }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Export Data Siswa</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-control select2" data-placeholder="Pilih Tahun Ajaran">
                            <option></option>
                            <option value="Semua">Semua</option>
                            @foreach ($tahun_ajaran as $item)
                            <option value="{{ $item->id }}">{{ $item->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <select name="jurusan" class="form-control select2" data-placeholder="Pilih Jurusan">
                            <option></option>
                            <option value="Semua">Semua</option>
                            @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" type="button">Tutup</button>
            <button class="btn btn-primary waves-effect waves-light" data-text="Export" type="submit">Export</button>
        </div>
    </form>
</div>