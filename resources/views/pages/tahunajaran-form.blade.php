<div class="modal-dialog modal-sm">
    <form id="form" class="modal-content" action="{{ $url ?? route('tahun-ajaran.store') }}" method="POST">
        @csrf
        @isset($url)
        @method('put')
        @endisset
        <div class="modal-header">
            <h5 class="modal-title">Tahun Ajaran</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" value="{{ $tahunAjaran->tahun_ajaran }}" class="form-control" placeholder="20xx/20xx">
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-group">
                        <div class="d-flex">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" {{ $tahunAjaran->aktif ? 'checked' : null }} name="aktif" id="aktif">
                                <label for="aktif" class="form-check-label">Aktif</label>
                            </div>
                        </div>
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