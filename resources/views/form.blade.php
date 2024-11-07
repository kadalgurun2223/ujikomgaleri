<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Gallery </title>

    <style>
      .gradient-custom {
        background: #6a11cb;
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
      }
    </style>

    <link rel="stylesheet" href="css/bebas.css">
  </head>
  <body>
    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <form action="{{ route('login') }}" method="POST">
                  @if (Session::has('success'))
                    <p class="text-primary">{{ Session::get('success') }}</p>
                  @endif
                  @if (Session::has('error'))
                    <p class="text-danger">{{ Session::get('error') }}</p>
                  @endif
                  @csrf

                  <div class="mb-md-5 mt-md-4 pb-5">
                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Silakan masukkan username dan password Anda!</p>

                    <div data-mdb-input-init class="form-outline form-white mb-4">
                      <label for="loginEmail" class="form-label">Email</label>
                      <input type="text" id="loginEmail" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                      @error('email')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>

                    <div data-mdb-input-init class="form-outline form-white mb-4">
                      <label for="loginPassword" class="form-label">Password</label>
                      <input type="password" id="loginPassword" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password">
                      @error('password')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>

                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                  </div>
                </form>

                <div>
                  <p class="mb-0">Belum punya akun? <a href="signup" class="text-white-50 fw-bold">Sign Up</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
