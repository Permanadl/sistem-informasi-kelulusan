<div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cek Kelulusan</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="lottie m-auto" style="max-width: 25%">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="{{ asset('front/graduation.json') }}"  background="white"  speed="1"  style="width: 100%" class="text-center"  loop autoplay></lottie-player>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <table class="table table-bordered text-left m-auto" style="width: 50%">
                        <tr class="bg-secondary text-white">
                            <th colspan="2">IDENTITAS SISWA</th>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td>{{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <th>NISN</th>
                            <td>{{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <th>NAMA LENGKAP</th>
                            <td>{{ strtoupper($siswa->nama_siswa) }}</td>
                        </tr>
                        <tr>
                            <th>JURUSAN</th>
                            <td>{{ strtoupper($siswa->jurusan->nama_jurusan) }}</td>
                        </tr>
                        <tr>
                            <th>STATUS</th>
                            <td>
                                @if ($siswa->status_kelulusan)
                                <h6 class="text-success mb-0">LULUS</h6>
                                @else
                                <h6 class="text-danger mb-0">TIDAK LULUS</h6>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>SKL</th>
                            <td>
                                @if (file_exists(public_path('storage/skl/'.$siswa->surat_kelulusan)))
                                <a href="{{ asset('storage/skl/'.$siswa->surat_kelulusan) }}" download class="btn btn-primary">Download</a>
                                <a href="{{ asset('storage/skl/'.$siswa->surat_kelulusan) }}" target="_blank" class="btn btn-secondary">Preview</a>
                                @else
                                Tidak ada file.
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-12 mt-4">
                    <div class="alert alert-info">
                        <h4 class="alert-heading">Pengumuman!</h4>
                        <p>{{ $pengumuman }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" type="button">Tutup</button>
        </div>
    </div>
</div>