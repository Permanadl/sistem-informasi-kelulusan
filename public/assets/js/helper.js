'use strict'

function bsModal(modalId = 'modal-primer'){
    const modal = document.getElementById(modalId)
    
    function show(content){
        $(modal).html(content).modal('show')
    }
    
    function hide(){
        $(modal).html('').modal('hide')
    }

    return {show, hide}
}

function dataTable(id){

    function reload(url = null){
        const table = window.LaravelDataTables[id]

        if(url){
            table.ajax.url(url).load()
            return
        }

        table.ajax.reload()
    }

    function onDraw(callback){
        if(typeof callback === 'function'){
            $('#'+id).on('draw.dt', callback)
        }
    }

    return{
        reload,
        onDraw
    }
}

function select(){
    let selectElemet = $('.select2')

    function withSelector(selector){
        selectElemet = $(selector)
        return this
    }

    function init(options = {}){
        selectElemet.each(function(){
            var $this = $(this)
            var selectOptions = {
                placeholder: $this.data('placeholder') ?? 'Pilih salah satu',
                dropdownParent: $this.parent()
            }

            if ($this.parents('.modal').length) {
                selectOptions['dropdownParent'] = $this.parents('.modal')
            }

            if (typeof options === 'object') {
                for (const [key, value] of Object.entries(options)) {
                    selectOptions[key] = value
                }
            }

            $this.wrap('<div class="position-relative"></div>').select2(selectOptions)
        })
    }

    return {withSelector, init}
}

function handleAjax(url, method = 'get'){
    function onSuccess(callback){
        if(typeof callback === 'function') this.successCallback = callback
        return this
    }

    function onError(callback){
        if(typeof callback === 'function') this.errorCallback = callback
        return this
    }

    function execute(additionalOptions = {}){
        const handler = this

        const ajaxOptions = {
            url, method,
            beforeSend: function(){
                pageLoader()
            },
            success: function(response){
                if(typeof handler.successCallback === 'function'){
                    handler.successCallback(response)
                    return
                }
                bsModal().show(response)
            },
            error: function(e){
                if (typeof handler.errorCallback === 'function') {
                    handler.errorCallback(e)
                    return
                }
            },
            complete: function(){
                pageLoader(true)
            }
        }

        $.ajax(
            joinAjaxOptions(ajaxOptions, additionalOptions)
        )
    }

    return {onSuccess, onError, execute}
}

function handleSubmitFormAjax(formId){
    
    function appendData(data){
        this.data = data
        return this
    }
    
    function setHeaders(headers){
        this.headers = headers
        return this
    }

    function onSuccess(callback){
        this.successCallback = callback
        return this
    }

    function onError(callback){
        this.errorCallback = callback
        return this
    }
    
    function init(additionalOptions = {}){
        const handler = this
        const form = $('#'+formId)

        form.on("submit", function(e){
            e.preventDefault();

            const data = new FormData(this)
            const headers = {
                'Accept': 'application/json, text-plain, */*',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

            if (typeof handler.data === 'object') {
                for (const [key, value] of Object.entries(handler.data)) {
                    data.append(key, value)
                }
            }

            if (typeof handler.headers === 'object') {
                for (const [key, value] of Object.entries(handler.headers)) {
                    headers[key] = value
                }
            }

            const ajaxOptions = {
                url: this.getAttribute('action'),
                method: this.getAttribute('method'),
                headers: headers,
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    submitLoader(formId)
                },
                success: function(response){
                    if (typeof handler.successCallback === 'function') {
                        handler.successCallback(response)
                        return
                    }
                    bsModal().hide()
                    toastInit('success', response.message)
                },
                error: function(e){
                    if (typeof handler.errorCallback === 'function') {
                        handler.errorCallback(e)
                        return
                    }

                    toastInit('error', e.responseJSON?.message)
                },
                complete: function(){
                    submitLoader(formId, true)
                }
            }

            $.ajax(
                joinAjaxOptions(ajaxOptions, additionalOptions)
            )
        })
    }

    return {onSuccess, onError, setHeaders, appendData, init}
}

function joinAjaxOptions(defaultOptions, addOptions){
    if (typeof defaultOptions === 'object' && typeof addOptions === 'object') {
        for (const [key, value] of Object.entries(addOptions)) {
            defaultOptions[key] = value
        }
    }
    
    return defaultOptions
}

toastr.options = {
    autoDismiss: true,
    newestOnTop: true,
    progressBar: true,
    positionClass: 'toast-top-right'
}

function toastInit(type, message){
    var title = {
        success: 'Sukses!',
        error: 'Gagal!',
        warning: 'Perhatian!',
        info: 'Info!'
    }

    if(type == 'error' && !message) message = 'Terjadi kesalahan, hubungi administrator!'

    toastr[type](message, title[type])
}

function showValidationErrors(errors){
    for (const [key, value] of Object.entries(errors)) {
        var input = $(`[name="${key}"]`)

        input.addClass('is-invalid')
        .parents('.form-group')
        .append(`<div class="invalid-feedback">${value}</div>`)
    }
}

function pageLoader(hide = false){
    if (hide) {
        $.unblockUI()
        return
    }

    $.blockUI({
        message: `<div class="sk-wave mx-auto">
            <div class="sk-rect sk-wave-rect"></div> 
            <div class="sk-rect sk-wave-rect"></div> 
            <div class="sk-rect sk-wave-rect"></div> 
            <div class="sk-rect sk-wave-rect"></div> 
            <div class="sk-rect sk-wave-rect"></div>
        </div>`,
        css: {
            backgroundColor: 'transparent',
            border: 0,
        },
        overlayCSS: {
            opacity: 0.5
        }
    })
}

function submitLoader(formId, hide = false){
    const form = document.getElementById(formId)
    const submitButton = $(form).find('[type="submit"]')

    if (hide) {
        const text = submitButton.data('text') ?? 'Simpan'
        submitButton.removeAttr('disabled').text(text)
        return
    }

    submitButton.attr('disabled', true)
    .html(`<span class="spinner-border me-1" role="status" aria-hidden="true"></span> Processing...`)
}

function alert(){
    let swalOptions = {
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
    }

    function options(options){
        if (typeof options === 'object') {
            for (const [key, value] of Object.entries(options)) {
                swalOptions[key] = value
            }
        }

        return this
    }

    function error(message){
        if (typeof swalOptions['title'] === 'undefined') {
            swalOptions['title'] = 'Error'
        }
        if (typeof swalOptions['text'] === 'undefined') {
            swalOptions['text'] = message ?? 'Terjadi kesalahan!'
        }
        if (typeof swalOptions['icon'] === 'undefined') {
            swalOptions['icon'] = 'error'
        }

        Swal.fire(swalOptions)
    }

    function confirmation(callbacks){
        if (typeof swalOptions['cancelButtonText'] === 'undefined') {
            swalOptions['showCancelButton'] = true
            swalOptions['cancelButtonText'] = 'Cancel'
        }
        if (typeof swalOptions['icon'] === 'undefined') {
            swalOptions['icon'] = 'warning'
        }

        Swal.fire(swalOptions).then((res)=>{
            if (res.isConfirmed) {
                if (typeof callbacks.onConfirm === 'function') {
                    callbacks.onConfirm(res)
                }
            }

            if (res.isDismissed) {
                if (typeof callbacks.onDismiss === 'function') {
                    callbacks.onDismiss(res)
                }
            }

            if (res.isDenied) {
                if (typeof callbacks.onDenied === 'function') {
                    callbacks.onDenied(res)
                }
            }
        })
    }

    return {
        options,
        error,
        confirmation
    }
}