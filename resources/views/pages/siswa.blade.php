@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/select2/select2.css" />
@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="card-title">Data Siswa</h4>
        <div>
            <a href="{{ url('data-siswa/export') }}" class="btn btn-success export">Export</a>
            <a href="{{ url('data-siswa/import') }}" class="btn btn-success import">Import</a>
            <a href="{{ route('data-siswa.create') }}" class="btn btn-primary add">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@push('vendors')
<script src="{{ asset('') }}assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="{{ asset('') }}assets/vendor/libs/select2/select2.js"></script>
@endpush

@push('js')
{!! $dataTable->scripts() !!}
<script>
    'use strict'

    var siswaJs = function(){
        $('.add').on('click', function(e){
            e.preventDefault()

            handleAjax($(this).attr('href'))
            .onSuccess((response)=>{
                bsModal().show(response)
                storeFunction()
                select().init()

                return
            })
            .execute()
        })

        $('.export').on('click', function(e){
            e.preventDefault()

            handleAjax($(this).attr('href'))
            .onSuccess((response)=>{
                bsModal().show(response)
                select().init()
                storeFunction({
                    success: function(response, status, xhr){
                        let disposition = xhr.getResponseHeader('content-disposition'),
                            matches = /"([^"]*)"/.exec(disposition),
                            filename = (matches != null && matches[1] ? matches[1] : `Data Siswa.xls`);

                        let blob = new Blob([response], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        })

                        
                        let link = document.createElement('a')
                        
                        link.href = window.URL.createObjectURL(blob)
                        link.download = filename
                        
                        document.body.appendChild(link)
                        link.click()
                        document.body.removeChild(link)
                    },
                    xhrFields: {
                        responseType: 'blob'
                    }
                })
            })
            .execute()
        })

        $('.import').on('click', function(e){
            e.preventDefault()

            handleAjax($(this).attr('href'))
            .onSuccess((response)=>{
                bsModal().show(response)
                storeFunction()
            })
            .execute()
        })

        $('#siswa-table').on('click', '.action', function(e){
            e.preventDefault()

            const url = $(this).attr('href')

            handleAjax(url)
            .onSuccess((response)=>{
                bsModal().show(response)
                select().init()
                storeFunction()
            })
            .execute()
        })
        
        function storeFunction(options = {}){
            const initOptions = {
                beforeSend: function(){
                    submitLoader('form')
                    $('#form').find('.invalid-feedback').remove()
                    $('#form').find('.is-invalid').removeClass('is-invalid')
                }
            }

            if (typeof options === 'object') {
                for (const [key, value] of Object.entries(options)) {
                    initOptions[key] = value
                }
            }

            handleSubmitFormAjax('form')
            .onSuccess((response)=>{
                bsModal().hide()
                dataTable('siswa-table').reload()
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
            .init(initOptions)
        }
    }()
</script>
@endpush