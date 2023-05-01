@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="card-title">Jurusan</h4>
        <a href="{{ route('jurusan.create') }}" class="btn btn-primary add">Tambah</a>
    </div>
    <div class="card-body">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@push('vendors')
<script src="{{ asset('') }}assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="{{ asset('') }}assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
@endpush

@push('js')
{!! $dataTable->scripts() !!}
<script>
    'use strict'

    var jurusanJs = function(){
        $('.add').on('click', function(e){
            e.preventDefault()

            handleAjax($(this).attr('href'))
            .onSuccess((response)=>{
                bsModal().show(response)
                storeFunction()

                return
            })
            .execute()
        })

        $('#jurusan-table').on('click', '.action', function(e){
            e.preventDefault()

            const url = $(this).attr('href')

            if ($(this).text() == 'Hapus') {
                alert().options({
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, Hapus',
                    text: 'Hapus data ini?',
                    title: 'Warning!'
                }).confirmation({
                    onConfirm: function(){
                        handleAjax(url, 'delete')
                        .onSuccess((response)=>{
                            dataTable('jurusan-table').reload()
                            toastInit(response.status, response.message)
                        })
                        .onError((e)=>{
                            toastInit('error', e.responseJSON?.message)
                        })
                        .execute({
                            headers:{
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                    }
                })

                return
            }

            handleAjax(url)
            .onSuccess((response)=>{
                bsModal().show(response)
                storeFunction()
            })
            .execute()
        })

        function storeFunction(){
            handleSubmitFormAjax('form')
            .onSuccess((response)=>{
                bsModal().hide()
                dataTable('jurusan-table').reload()
                toastInit('success', response.message)
            })
            .onError((e)=>{
                const errors = e.responseJSON?.errors
                if (typeof errors === 'object') {
                    showValidationErrors(errors)
                    return
                }
                toastInit('error', e.responseJSON?.message)
            })
            .init({
                beforeSend: function(){
                    submitLoader('form')
                    $('#form').find('.invalid-feedback').remove()
                    $('#form').find('.is-invalid').removeClass('is-invalid')
                }
            })
        }
    }()
</script>
@endpush