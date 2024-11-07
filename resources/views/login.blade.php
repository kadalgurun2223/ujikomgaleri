@extends('layout.app')

@section('konten')
<div id="js-preloader" class="js-preloader">
  <div class="preloader-inner">
    <span class="dot"></span>
    <div class="dots">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</div>

<header class="header-area header-sticky">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <a href="" class="logo">
            <h2>GALERI FOTO</h2>
          </a>
          <ul class="nav">
            <li><a href="konten" class="active">Beranda</a></li>
            <li><a href="{{ route('logout') }}" class="active p-3">LOGOUT</a></li>
          </ul>
          <a class='menu-trigger'>
            <span>Menu</span>
          </a>
        </nav>
      </div>
    </div>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="main-profile">
              <div class="row">
                <div class="col-lg-4">
                  <img src="assets/images/profile.jpg" alt="" style="border-radius: 23px;">
                </div>
                <div class="col-lg-4 align-self-center">
                  <div class="main-info header-text">
                    <span>User</span>
                    <h4>{{ Auth::user()->name }}</h4>
                    <p>Upload konten mu disini</p>
                    <div class="main-border-button">
                      <!-- Upload Modal Trigger -->
                      <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-white">Upload</a>

                      <!-- Upload Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="exampleModalLabel">Upload Konten</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>

                            <div class="modal-body">
                              <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                  <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                  @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                  @enderror
                                </div>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control @error('judul') is-invalid @enderror" placeholder="Judul" name="judul">
                                  @error('judul')
                                    <p class="text-danger">{{ $message }}</p>
                                  @enderror
                                </div>
                                <div class="input-group mb-3">
                                  <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi" name="deskripsi" rows="4"></textarea>
                                  @error('deskripsi')
                                    <p class="text-danger">{{ $message }}</p>
                                  @enderror
                                </div>
                                <button type="submit" class="btn btn-primary text-white mt-3">Simpan</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-lg-4 align-self-center">
                  <ul>
                    <li>Username<span>{{ Auth::user()->username }}</span></li>
                    <li>Email<span>{{ Auth::user()->email }}</span></li>
                    <li>Alamat<span>{{ Auth::user()->alamat }}</span></li>
                  </ul>
                </div>
              </div>

              <!-- Album Section -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="clips">
                    <div class="heading-section">
                      <h4>Album</h4>
                    </div>
                    <div class="row">
                      @forelse($contents as $content)
                        <div class="col-lg-4 col-sm-6 mb-4">
                          <div class="item">
                            <div class="thumb" style="width: 100%; height: 200px; overflow: hidden; border-radius: 20px;">
                              <img src="{{ asset('/storage/contents/'.$content->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                            </div>
                            <div class="down-content mt-3">
                              <ul class="list-unstyled">
                                <div class="d-flex align-items-center">
                                  <h3 class="me-2">{{ $content->judul }}</h3>
                                  <a href="{{ route('content.edit', $content->id) }}" class="btn btn-dark">
                                    <i class="bi bi-pencil"></i>
                                  </a>
                                </div>
                                <p class="text-muted">{{ $content->tanggal }}</p>
                                <p><i class="text-white">{{ Str::limit($content->deskripsi, 20) }}</i></p>

                                <!-- Action Buttons -->
                                <div class="d-flex align-items-center mt-2">
                                  <form action="{{ route('like', $content->id) }}" method="POST" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">
                                      <i class="bi {{ auth()->user()->hasLiked($content) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                      {{ $content->likes()->count() }}
                                    </button>
                                  </form>

                                  <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#komen-{{ $content->id }}">
                                    <i class="bi bi-chat">{{ $content->comments->count() }}</i>
                                  </button>

                                  <form action="{{ route('content.delete', $content->id) }}" method="POST" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-dark">
                                      <i class="bi bi-trash"></i>
                                    </button>
                                  </form>
                                </div>

                                <script>
                                  function confirmDelete() {
                                    return confirm('Yakin ingin menghapus konten ini?');
                                  }
                                </script>

                                <!-- Comment Modal -->
                                <div class="modal fade" id="komen-{{ $content->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Komentar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <p><b>Komentar :</b></p>
                                        <hr>
                                        @foreach ($content->comments as $comment)
                                          <div class="card mb-2">
                                            <div class="card-body">
                                              <p><b>{{ $comment->user->username }}</b></p>
                                              <p>{{ $comment->komentar }}</p>
                                            </div>
                                          </div>
                                        @endforeach

                                        <form action="{{ route('comment', $content->id) }}" method="POST">
                                          @csrf
                                          <div class="mb-3">
                                            <label for="komentar" class="form-label">Komentar</label>
                                            <input type="text" class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" placeholder="Tulis komentar">
                                            @error('komentar')
                                              <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                          </div>
                                          <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </ul>
                            </div>
                          </div>
                        </div>
                      @empty
                        <p>Data kosong</p>
                      @endforelse
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@parent
@endsection
