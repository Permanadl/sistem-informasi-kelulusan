@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/flatpickr/flatpickr.css" />
@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between pb-0">
        <h4 class="card-title">Pengaturan</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="false">Login</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <form action="{{ url('pengaturan/store-general') }}" method="POST" id="form-general">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Banner Depan</label>
                                        <input type="file" class="form-control" name="banner">
                                        <input type="hidden" name="banner_lama" value="{{ $pengaturan['banner'] }}">
                                    </div>
                                </div>
                                @if (file_exists(public_path('storage/asset/'.$pengaturan['banner'])))
                                <div class="col-12">
                                    <img src="{{ asset('storage/asset/'.$pengaturan['banner']) }}" style="width: 100%" alt="">
                                </div>
                                @endif
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Pengumuman</label>
                                        <textarea name="pengumuman" rows="10" class="form-control" placeholder="Isi pengumuman disini">{{ $pengaturan['pengumuman'] }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Tanggal Dibuka</label>
                                        <input type="text" name="tanggal_dibuka" placeholder="Y-m-d H:i" value="{{ $pengaturan['tanggal_dibuka'] }}" readonly class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Tanggal Ditutup</label>
                                        <input type="text" name="tanggal_ditutup" placeholder="Y-m-d H:i" value="{{ $pengaturan['tanggal_ditutup'] }}" readonly class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form action="{{ url('pengaturan/store-login') }}" id="form-login" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="username" value="{{ auth()->user()->username }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Password Baru</label>
                                        <input type="password" name="password" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Konfirmasi</label>
                                        <input type="password" name="konfirmasi_password" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('vendors')
<script src="{{ asset('') }}assets/vendor/libs/flatpickr/flatpickr.js"></script>
@endpush

@push('js')
<script>
    'use strict'

    var jurusanJs = function(){
        if ($('.datepicker').length) {
            $('.datepicker').flatpickr({
                enableTime: true,
                dateFormat: 'Y-m-d H:i'
            });    
        }

        $(document).ready(function(){
            const origin = new URL(window.location)
            const ref = origin.searchParams.get('ref')
            if (ref == 'profil') {
                $('#login-tab').trigger('click')
            }
        })

        handleSubmitFormAjax('form-general')
        .onSuccess((response)=>{
            toastInit('success', response.message)

            setTimeout(() => {
                window.location.reload()    
            }, 500);
        })
        .onError((e)=>{
            const errors = e.responseJSON?.errors
            if (typeof errors == 'object') {
                showValidationErrors(errors)
                return
            }

            toastInit('error', e.responseJSON?.message)
        })
        .init({
            beforeSend: function(){
                submitLoader('form-general')
                $('#form-general').find('.is-invalid').removeClass('is-invalid')
                $('#form-general').find('.invalid-feedback').remove()
            }
        })

        handleSubmitFormAjax('form-login')
        .onSuccess((response)=>{
            toastInit('success', response.message)

            setTimeout(() => {
                window.location.reload()    
            }, 500);
        })
        .onError((e)=>{
            const errors = e.responseJSON?.errors
            if (typeof errors == 'object') {
                showValidationErrors(errors)
                return
            }

            toastInit('error', e.responseJSON?.message)
        })
        .init({
            beforeSend: function(){
                submitLoader('form-login')
                $('#form-login').find('.is-invalid').removeClass('is-invalid')
                $('#form-login').find('.invalid-feedback').remove()
            }
        })
    }()
</script>
@endpush