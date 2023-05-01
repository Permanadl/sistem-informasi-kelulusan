<div class="modal-dialog modal-sm">
    <form id="form" class="modal-content" action="{{ route('data-siswa.import') }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Import Data Siswa</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <div class="alert-body">
                            Download format excel untuk import data <a href="{{ url('data-siswa/format-excel') }}" download="">disini.</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">File Excel</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" type="button">Tutup</button>
            <button class="btn btn-primary waves-effect waves-light" data-text="Import" type="submit">Import</button>
        </div>
    </form>
</div>