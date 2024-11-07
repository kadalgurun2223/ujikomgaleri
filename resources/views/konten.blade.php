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
              <li><a href="/profil">Profil <img src="assets/images/profile-header.jpg" alt=""></a></li>
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

          <div class="second-banner">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h4><em>Ekspresikan</em> diri anda dengan bebas dan santai</h4>
                </div>
              </div>
            </div>
          </div>

          <div class="most-popular">
            <div class="row">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4>Semua Konten Ada Disini</h4>
                </div>
                <div class="row">
                    @forelse ($contents as $content)
                      <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="card bg-dark text-white">
                          <!-- Image with Modal Trigger and Fixed Size -->
                          <img src="{{ asset('/storage/contents/'.$content->image) }}" alt=""
                               class="card-img-top"
                               data-bs-toggle="modal" data-bs-target="#detailModal-{{ $content->id }}"
                               style="height: 200px; width: 100%; object-fit: cover;">

                          <!-- Content Info -->
                          <div class="card-body">
                            <p class="card-text text-muted small mb-1">{{ $content->tanggal }}</p>
                            <h5 class="card-title mb-2">{{ $content->judul }}</h5>
                            <p class="card-text">{{ Str::limit($content->deskripsi, 20) }}</p>
                          </div>

                          <!-- Like and Comment Buttons -->
                          <div class="card-footer p-2">
                            <div class="d-inline-flex align-items-center">
                              <!-- Like Button -->
                              <form action="{{ route('like', $content->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-sm me-1 d-flex align-items-center">
                                  <i class="bi {{ auth()->user()->hasLiked($content) ? 'bi-heart-fill' : 'bi-heart' }} me-1"></i>
                                  <span>{{ $content->likes()->count() }}</span>
                                </button>
                              </form>

                              <!-- Comment Button -->
                              <button type="button" class="btn btn-dark btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#komen-{{ $content->id }}">
                                <i class="bi bi-chat me-1"></i>
                                <span>{{ $content->comments->count() }}</span>
                              </button>
                            </div>
                          </div>

                          <!-- Modal for Image Details and Uploader Info -->
                          <div class="modal fade" id="detailModal-{{ $content->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $content->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="det ailModalLabel-{{ $content->id }}">{{ $content->judul }}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                  <!-- Detail Image -->
                                  <img src="{{ asset('/storage/contents/'.$content->image) }}" alt="{{ $content->judul }}" class="img-fluid mb-3">

                                  <!-- Description and Uploader Info -->
                                  <p><strong></strong> {{ $content->deskripsi }}</p>
                                  <p><strong>Upload by:</strong> {{ $content->user->username }}</p>

                                  <!-- Like Button in Modal -->
                                  <form action="{{ route('like', $content->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">
                                      <i class="bi {{ auth()->user()->hasLiked($content) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                      {{ $content->likes()->count() }}
                                    </button>
                                  </form>

                                  <!-- Comments in Modal -->
                                  <p><strong>Komentar:</strong></p>
                                  <hr>
                                  @foreach ($content->comments as $comment)
                                    <div class="card bg-light text-dark mb-2">
                                      <div class="card-body p-2">
                                        <p><strong>{{ $comment->user->username }}:</strong> {{ $comment->komentar }}</p>
                                      </div>
                                    </div>
                                  @endforeach

                                  <!-- Add Comment Form -->
                                    <form action="{{ route('comment', $content->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                        <label for="komentar" class="form-label">Tambahkan Komentar</label>
                                        <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" rows="4" placeholder="Tulis komentar Anda"></textarea>
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
                        </div>
                      </div>
                    @empty
                      <p>Tidak ada konten.</p>
                    @endforelse
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
