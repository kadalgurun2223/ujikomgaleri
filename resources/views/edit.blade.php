<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Konten</title>

    <style>
        .gradient-custom {
          background: rgb(0, 153, 204);
          background: -webkit-linear-gradient(to right, rgba(0, 153, 204, 1), rgba(0, 204, 153, 1));
          background: linear-gradient(to right, rgba(0, 153, 204, 1), rgba(0, 204, 153, 1));
        }
      </style>

  </head>
  <body>
    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 h-100">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5">

                <form action="{{ route('content.update', $content->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-md-5 mt-md-4 pb-5">
                    <h2 class="fw-bold mb-2 text-uppercase text-center">Edit Konten</h2>
                    <p class="text-white-50 mb-5 text-center">Silakan masukkan judul dan deskripsi konten Anda!</p>

                    <!-- Judul -->
                    <div class="form-outline form-white mb-4">
                      <label for="judul" class="form-label">Judul</label>
                      <input type="text" id="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $content->judul) }}">
                      @error('judul')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-outline form-white mb-4">
                      <label for="deskripsi" class="form-label">Deskripsi</label>
                      <input type="text" id="deskripsi" class="form-control form-control-lg @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi', $content->deskripsi) }}">
                      @error('deskripsi')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="text-center">
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Simpan</button>
                    </div>

                  </div>
                </form>

                <div class="text-center mt-3">
                  <a href="{{ route('konten.index') }}" class="text-white-50 fw-bold">Kembali ke Halaman Konten</a>
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
