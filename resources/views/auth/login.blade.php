
<!DOCTYPE html>

<html lang="id" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login | Sistem Informasi Kelulusan</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('') }}assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/css/rtl/theme-default.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('') }}assets/vendor/css/pages/page-auth.css" />
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mt-2">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="{{ asset('front/iconsmk.png') }}" width="30px" alt="">
                  </span>
                </a>
              </div>
              <h4 class="fw-bold text-center">SKL</h4>
              <!-- /Logo -->
              <h4 class="mb-1 pt-2">Selamat Datang! 👋</h4>
              <p class="mb-4">Silahkan masukan username dan password kamu!</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Username</label>
                  <input type="text" class="form-control" id="email" name="username" placeholder="Masukan username atau email" autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer show-password"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                @foreach ($errors->all() as $error)
                @if ($loop->first)
                <div class="text-center">
                    <p class="text-danger">{{ $error }}</p>
                </div>
                @endif
                @endforeach
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('') }}assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('') }}assets/vendor/js/bootstrap.js"></script>
    <!-- endbuild -->

    <!-- Page JS -->
    <script src="{{ asset('') }}assets/js/pages-auth.js"></script>
    <script>
      $('.show-password').on('click', function(){
        var input = $('[name="password"]'),
          type = input.attr('type')

        if (type == 'password') {
          input.attr('type', 'text')
          $(this).find('i').removeClass('ti-eye-off').addClass('ti-eye')
        } else {
          input.attr('type', 'password')
          $(this).find('i').removeClass('ti-eye').addClass('ti-eye-off')
        }
      })
    </script>
  </body>
</html>
