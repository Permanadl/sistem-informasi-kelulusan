<div class="modal-dialog modal-sm">
    <form id="form" class="modal-content" action="{{ $url ?? route('jurusan.store') }}" method="POST">
        @csrf
        @isset($url)
        @method('put')
        @endisset
        <div class="modal-header">
            <h5 class="modal-title">Jurusan</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Nama Jurusan</label>
                        <input type="text" name="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" class="form-control">
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