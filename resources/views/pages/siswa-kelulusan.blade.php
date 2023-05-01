<div class="modal-dialog modal-lg">
    <form id="form" class="modal-content" action="{{ route('data-siswa.kelulusan', $siswa->id) }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">{{ $siswa->nama_siswa }}</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                @if ($siswa->status_kelulusan === null)
                <div class="col-12">
                    <div class="alert alert-warning">
                        <div class="alert-body">
                            Status kelulusan belum ditentukan
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Status Kelulusan</label>
                        <div class="d-flex">
                            <div class="form-check form-check-primary">
                                <input type="radio" class="form-check-input" id="lulus" name="status_kelulusan" value="1">
                                <label for="lulus" class="form-check-label">Lulus</label>
                            </div>
                            <div class="form-check form-check-primary ms-2">
                                <input type="radio" class="form-check-input" id="tidaklulus" name="status_kelulusan" value="0">
                                <label for="tidaklulus" class="form-check-label">Tidak Lulus</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Surat Kelulusan</label>
                        <input type="file" name="surat_kelulusan" class="form-control">
                    </div>
                </div>
                @else
                <div class="col-12">
                    <div class="alert alert-{{ $siswa->status_kelulusan ? 'success' : 'danger' }}">
                        <div class="alert-body">
                            {{ $siswa->status_kelulusan ? 'LULUS' : 'TIDAK LULUS' }}
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <embed src="{{ asset('storage/skl/'.$siswa->surat_kelulusan) }}" type="application/pdf" width="100%" height="500px">
                </div>
                <div class="col-12 mt-2">
                    <div class="d-grid gap-2">
                        <a href="{{ asset('storage/skl/'.$siswa->surat_kelulusan) }}" download class="btn btn-label-primary btn-">Download SKL</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" type="button">Tutup</button>
            @if ($siswa->surat_kelulusan === null)
            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
            @endif
        </div>
    </form>
</div>