<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Landing Page PT RAPP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>

  <style>
    .header-animated {
      background: url('{{ asset('images/image.png') }}') no-repeat center center / cover;
      min-height: 500px;
      position: relative;
    }
    .header-overlay {
      background-color: rgba(0, 0, 0, 0.5);
      min-height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: white;
      text-align: center;
      padding: 0 15px;
    }

    /* Slide 2 - Kata Sambutan Hitam */
    .carousel-sambutan {
      background-color: #000; /* Hitam */
      color: #fff; /* Teks putih */
    }

    .carousel-sambutan .card {
      background-color: rgba(255, 255, 255, 0.05); /* Sedikit transparan */
      border: none;
    }

    /* Pastikan teks paragraf dalam card berwarna putih */
    .carousel-sambutan .card-body p {
      color: #fff;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand p-0 me-3" href="#">
            <img src="{{ asset('images/logorapp.png') }}" alt="Logo" width="125" height="90">
        </a>
        <span class="navbar-text fw-bold fs-5 mx-auto">
            WEBSITE PENGAJUAN PROPOSAL
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item">
                    <a href="#features" class="nav-link">Fitur</a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-primary mx-2">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                </li>
            </ul>
        </div>
    </div>
  </nav>

  <!-- Carousel Welcome -->
  <div id="welcomeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <header class="header-animated">
          <div class="header-overlay">
            <h1 class="fw-bold">Selamat Datang di Website Pengajuan Proposal PT RAPP !!!</h1>
            <p class="mt-3 fs-5" style="max-width: 800px;">
              Ajukan proposal kegiatan Anda dengan lebih mudah, cepat, dan transparan! 
              Melalui sistem ini, Anda dapat mengunggah proposal, memantau status pengajuan secara real-time, 
              dan mendapatkan informasi penilaian langsung dari tim Stakeholder PT RAPP.
            </p>
          </div>
        </header>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item carousel-sambutan">
        <section class="py-5" style="min-height:500px; display:flex; align-items:center;">
          <div class="container">
            <h2 class="text-center mb-4">Kata Sambutan</h2>
            <div class="row align-items-center">
              <div class="col-md-4 text-center mb-4">
                <img src="{{ asset('images/pimpinan.png') }}" alt="Foto Pimpinan" class="img-fluid rounded shadow" style="max-width: 300px;">
                <h5 class="mt-3 mb-0">Mulia Nauli</h5>
                <small>Direktur PT RAPP</small>
              </div>
              <div class="col-md-8">
                <div class="card shadow">
                  <div class="card-body fs-5">
                    <p>Assalamu’alaikum Wr. Wb.</p>

                    <p>Puji syukur kami panjatkan ke hadirat Allah SWT atas limpahan rahmat dan karunia-Nya, sehingga PT Riau Andalan Pulp and Paper (PT RAPP) dapat menghadirkan Website Pengajuan Proposal ini. Kehadiran website ini merupakan wujud komitmen kami dalam memberikan kemudahan dan transparansi bagi masyarakat, lembaga, serta pihak-pihak terkait dalam mengajukan proposal kegiatan.</p>

                    <p>Website ini dirancang agar setiap pengguna dapat menelusuri proses pengajuan proposal secara cepat, akurat, dan real-time. Dengan sistem ini, seluruh pihak dapat memantau status proposal dari awal pengajuan hingga penilaian oleh tim Stakeholder PT RAPP, sehingga meningkatkan efisiensi, transparansi, dan akuntabilitas dalam setiap proses administrasi.</p>

                    <p>Kami menyadari bahwa keberhasilan website ini sangat bergantung pada partisipasi aktif masyarakat dan pihak terkait. Oleh karena itu, kami mengajak semua pihak untuk memanfaatkan sistem ini dengan maksimal, belajar menggunakan teknologi yang tersedia, dan mengikuti setiap prosedur pengajuan proposal dengan benar. Dengan cara ini, informasi akan tersampaikan dengan cepat dan dapat diakses oleh siapa saja yang membutuhkan.</p>

                    <p>Selain itu, kami berharap website ini juga menjadi sarana edukasi bagi masyarakat dalam memahami mekanisme pengajuan proposal serta prosedur yang berlaku di PT RAPP. Melalui pemanfaatan sistem secara optimal, diharapkan setiap proposal dapat diproses dengan lebih efisien dan mendapatkan penilaian yang transparan dari tim yang berkompeten.</p>

                    <p>Demikian sambutan ini kami sampaikan. Semoga website Pengajuan Proposal PT RAPP ini memberikan manfaat sebesar-besarnya bagi semua pihak yang terlibat. Terima kasih atas kepercayaan dan kerjasamanya.</p>

                    <p>Wassalamu’alaikum Wr. Wb.</p>

                    <p>Hormat kami,<br>
                    Direktur PT RAPP<br>
                    Mulia Nauli</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- Features Section -->
  <section id="features" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Features</h2>
      <div class="row text-center">
        <div class="col-md-4">
          <i class="bi bi-speedometer2 display-4 text-primary"></i>
          <h4 class="mt-3">Fast Performance</h4>
          <p>Penggunaan website ini dapat mempermudah masyarakat mengajukan proposal.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-shield-lock display-4 text-primary"></i>
          <h4 class="mt-3">Secure</h4>
          <p>Menyimpan data pengguna secara aman.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-layout-text-sidebar-reverse display-4 text-primary"></i>
          <h4 class="mt-3">Easy to Use</h4>
          <p>Sangat mudah untuk digunakan.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Contact Us</h2>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
          <div class="col-md-6">
            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
          </div>
          <div class="col-md-6">
            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
          </div>
        </div>
        <div class="mb-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Tutorial Video Section -->
  <section id="tutorial" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Cara Menggunakan Website</h2>
      <p class="text-center mb-4">Tonton video ini untuk mengetahui langkah-langkah pengajuan proposal melalui website PT RAPP.</p>
      <div class="ratio ratio-16x9">
        <video controls>
          <source src="{{ asset('videos/tutorial.mp4') }}" type="video/mp4">
          Browser Anda tidak mendukung video HTML5.
        </video>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2025 PT RAPP. All Rights Reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
