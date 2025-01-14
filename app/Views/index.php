<?= $this->extend('template/dashboard-admin2.php') ?>
<?= $this->section('app') ?>
  <div class="content-wrapper">
    <div class="page-heading">
            <h3>Dashboard</h3>
    </div>
    <div class="page-content">
      <div class="row">
        <div class="col-auto col-lg-12 col-md-6 mx-auto">
          <div class="card">
            <div class="card-body">
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                  <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                  <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets/images/news1.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/images/news2.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/images/news3.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

    
  </div>
           








      
  <style>
    .carousel {
      width: 100%;              /* Lebar penuh */
      height: auto;             /* Tinggi 60% dari tinggi layar */
            /* Batasi tinggi maksimal */
    }

    .carousel-item img {
      object-fit: cover;        /* Menyesuaikan gambar */
      width: 100%;
      height: 50vh;
     
     

    }
  </style>
               
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->endSection() ?>