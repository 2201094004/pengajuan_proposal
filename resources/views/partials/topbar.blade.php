<style>
    .navbar-large {
        padding: 1.5rem 1rem; /* Mengatur padding lebih besar */
        font-size: 1.25rem; /* Memperbesar ukuran font */
    }
    .navbar-large .navbar-brand {
        font-size: 1.5rem; /* Memperbesar teks "Dashboard" */
    }
    .navbar-large img {
        width: 50px; /* Memperbesar ukuran logo */
        height: 50px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-large">
    <div class="container-fluid">
        <img src="{{ asset('images/logorapp.png') }}" alt="Logo Stmik" class="me-2">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
