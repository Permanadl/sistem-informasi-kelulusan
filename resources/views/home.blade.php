
<!DOCTYPE html>
<html lang="en">
<head>

<meta name="robots" content="noindex, nofollow" />    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Ava Template</title>
<link rel="shortcut icon" href="{{ asset('front/iconsmk.png') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Lato:400,400i|Roboto:500" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('') }}front/css/style.css">
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/css/core.css">
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/css/rtl/theme-default.css" />
<link rel="stylesheet" href="{{ asset('') }}assets/vendor/libs/toastr/toastr.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
<style>
    .hero{
        background-image: url('{{ asset("storage/asset/banner647.jpg") }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 900px;
    }

    #form-container{
        position: absolute;
        bottom: -100px;
        width: 100%;
        max-width: 100%;
        padding-left: 200px;
        padding-right: 200px;
    }

    div.form{
        width: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        min-width: 100%;
        padding-top: 50px; 
        padding-bottom: 50px;
        border-radius: 1rem;
    }

    .form .form-title{
        margin-bottom: 30px;
    }

    .form .form-title .title{
        font-size: 30px;
        font-weight: bolder;
        margin-bottom: 5px !important
    }

    .form .form-title .clock{
        font-weight: bolder;
        margin-top: 5px !important;
    }

    .form form{
        width: 50%;
        margin: auto;
    }

    .form .form-group{
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .form .button{
        width: 100% !important;
    }

    .features{
        margin-top: 50px;
    }

    #modal-primer .modal-dialog{
        background-color: #fff !important
    }
</style>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <main>
            <section class="hero text-center">
                <div class="modal fade" id="modal-primer" data-bs-backdrop="static" tabindex="-1" aria-hidden="true"></div>
                <div class="container-sm" id="form-container">
                    <div class="hero-inner">
                        <div class="hero-browser">
                            <div class="bubble-3 is-revealing">
                                <svg width="427" height="286" viewBox="0 0 427 286" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs>
                                        <path d="M213.5 286C331.413 286 427 190.413 427 72.5S304.221 16.45 186.309 16.45C68.396 16.45 0-45.414 0 72.5S95.587 286 213.5 286z" id="bubble-3-a"/>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <mask id="bubble-3-b" fill="#fff">
                                            <use xlink:href="#bubble-3-a"/>
                                        </mask>
                                        <use fill="#4E8FF8" xlink:href="#bubble-3-a"/>
                                        <path d="M64.5 129.77c117.913 0 213.5-95.588 213.5-213.5 0-117.914-122.779-56.052-240.691-56.052C-80.604-139.782-149-201.644-149-83.73c0 117.913 95.587 213.5 213.5 213.5z" fill="#1274ED" mask="url(#bubble-3-b)"/>
                                        <path d="M381.5 501.77c117.913 0 213.5-95.588 213.5-213.5 0-117.914-122.779-56.052-240.691-56.052C236.396 232.218 168 170.356 168 288.27c0 117.913 95.587 213.5 213.5 213.5z" fill="#75ABF3" mask="url(#bubble-3-b)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="bubble-4 is-revealing">
                                <svg width="230" height="235" viewBox="0 0 230 235" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs>
                                        <path d="M196.605 234.11C256.252 234.11 216 167.646 216 108 216 48.353 167.647 0 108 0S0 48.353 0 108s136.959 126.11 196.605 126.11z" id="bubble-4-a"/>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <mask id="bubble-4-b" fill="#fff">
                                            <use xlink:href="#bubble-4-a"/>
                                        </mask>
                                        <use fill="#7CE8DD" xlink:href="#bubble-4-a"/>
                                        <circle fill="#3BDDCC" mask="url(#bubble-4-b)" cx="30" cy="108" r="108"/>
                                        <circle fill="#B1F1EA" opacity=".7" mask="url(#bubble-4-b)" cx="265" cy="88" r="108"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="hero-browser-inner is-revealing">
                                <div class="form">
                                    <div class="form-title">
                                        <h1 class="title">PENGUMUMAN KELULUSAN</h1>
                                        <h4 class="clock">{{ $clock }}</h4>
                                    </div>
                                    <form action="{{ route('cek-kelulusan') }}" id="cek-kelulusan">
                                        <div class="form-group">
                                            <input type="text" class="input" name="nis" placeholder="Masukan NIS">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="input" name="nisn" placeholder="Masukan NISN">
                                        </div>
                                        <div class="form-group">
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <button class="button button-cek button-primary button-block" type="submit">Cek Kelulusan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="bubble-1 is-revealing">
                                <svg width="61" height="52" viewBox="0 0 61 52" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs>
                                        <path d="M32 43.992c17.673 0 28.05 17.673 28.05 0S49.674 0 32 0C14.327 0 0 14.327 0 32c0 17.673 14.327 11.992 32 11.992z" id="bubble-1-a"/>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <mask id="bubble-1-b" fill="#fff">
                                            <use xlink:href="#bubble-1-a"/>
                                        </mask>
                                        <use fill="#FF6D8B" xlink:href="#bubble-1-a"/>
                                        <path d="M2 43.992c17.673 0 28.05 17.673 28.05 0S19.674 0 2 0c-17.673 0-32 14.327-32 32 0 17.673 14.327 11.992 32 11.992z" fill="#FF4F73" mask="url(#bubble-1-b)"/>
                                        <path d="M74 30.992c17.673 0 28.05 17.673 28.05 0S91.674-13 74-13C56.327-13 42 1.327 42 19c0 17.673 14.327 11.992 32 11.992z" fill-opacity=".8" fill="#FFA3B5" mask="url(#bubble-1-b)"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="bubble-2 is-revealing">
                                <svg width="179" height="126" viewBox="0 0 179 126" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs>
                                        <path d="M104.697 125.661c41.034 0 74.298-33.264 74.298-74.298s-43.231-7.425-84.265-7.425S0-28.44 0 12.593c0 41.034 63.663 113.068 104.697 113.068z" id="bubble-2-a"/>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <mask id="bubble-2-b" fill="#fff">
                                            <use xlink:href="#bubble-2-a"/>
                                        </mask>
                                        <use fill="#838DEA" xlink:href="#bubble-2-a"/>
                                        <path d="M202.697 211.661c41.034 0 74.298-33.264 74.298-74.298s-43.231-7.425-84.265-7.425S98 57.56 98 98.593c0 41.034 63.663 113.068 104.697 113.068z" fill="#626CD5" mask="url(#bubble-2-b)"/>
                                        <path d="M43.697 56.661c41.034 0 74.298-33.264 74.298-74.298s-43.231-7.425-84.265-7.425S-61-97.44-61-56.407C-61-15.373 2.663 56.661 43.697 56.661z" fill="#B1B6F1" opacity=".64" mask="url(#bubble-2-b)"/>
                                    </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="newsletter section" style="margin-top: 100px">
                <div class="container-sm">
                    <div class="newsletter-inner section-inner">
                        <div class="newsletter-header text-center is-revealing">
                            <h2 class="section-title mt-0">Punya akses admin?</h2>
                            <p class="section-paragraph">Klik tombol untuk login sebagai admin</p>
                        </div>
                        <div class="footer-form newsletter-form field field-grouped is-revealing text-center">
                            <a class="button button-primary button-block button-shadow m-auto" href="{{ route('login') }}">Login Admin</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer text-light">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
                        <a href="">
                            <img src="{{ asset('front/iconsmk.png') }}" width="50px" alt="">
                        </a>
                    </div>
                    <ul class="footer-links list-reset">
                        <li>
                            <a href="https://smknsituraja.sch.id/contact/" target="_blank">Kontak</a>
                        </li>
                        <li>
                            <a href="https://smknsituraja.sch.id" target="_blank">Tentang Kami</a>
                        </li>
                    </ul>
                    <ul class="footer-social-links list-reset">
                        <li>
                            <a href="https://facebook.com" target="_blank">
                                <i class="fa-brands fa-facebook fa-2x"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-brands fa-twitter fa-2x"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UC1kJP2hlzdhnGJcMeH69zdA" target="_blank">
                                <i class="fa-brands fa-youtube fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="footer-copyright text-white">&copy; 
                        <script>
                            document.write(new Date().getFullYear())
                        </script> SMK Negeri Situraja
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('') }}assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('') }}assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('') }}assets/vendor/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('') }}assets/vendor/libs/toastr/toastr.js"></script>
    <script src="{{ asset('') }}front/js/main.min.js"></script>
    <script src="{{ asset('') }}assets/js/helper.js"></script>

    <script>
        'use strict'

        var homeJs = function(){
            $('#cek-kelulusan').on('submit', function(e){
                e.preventDefault()

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('.error').text('')
                        $('.button-cek').attr('disabled', true)
                        .html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Memproses...`)
                    },
                    success: function(response){
                        bsModal().show(response)
                    },
                    error: function(e){
                        const error = e.responseJSON?.message
                        $('.error').text(error)
                    },
                    complete: function(){
                        $('.button-cek').removeAttr('disabled').text('CEK KELULUSAN')
                    }
                })
            })
        }()
    </script>
</body>
</html>
