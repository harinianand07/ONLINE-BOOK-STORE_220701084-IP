<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      body {
          margin-top: 60px;
          background-color: #f8f9fa;
      }

      .navbar-nav .dropdown:hover .dropdown-menu {
          display: block;
      }

      .dropdown-menu {
          margin-top: 0;
      }

      .cart-container {
          margin: 20px auto;
          max-width: 800px;
          background-color: #fff;
          border-radius: 8px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
          padding: 20px;
      }

      .cart-item {
          display: flex;
          align-items: center;
          margin-bottom: 15px;
          border-bottom: 1px solid #ddd;
          padding-bottom: 15px;
      }

      .cart-item img {
          width: 80px;
          height: auto;
          margin-right: 20px;
          object-fit: contain;
      }

      .cart-actions {
          display: flex;
          align-items: center;
          gap: 10px;
      }

      .quantity {
          width: 50px;
          text-align: center;
      }

      .btn-remove {
          background-color: #ff4d4d;
          color: white;
      }

      .total-section {
          text-align: right;
          margin-top: 20px;
      }

      .btn-checkout {
          width: 100%;
      }
      </style>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (dark)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

    
<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Bookify</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="genresDropdown" role="button">
                Genres
            </a>
            <ul class="dropdown-menu" aria-labelledby="genresDropdown">
                <li><a class="dropdown-item" href="./fictional.html">Fictional Books</a></li>
                <li><a class="dropdown-item" href="./non-fictional.php">Non-Fictional Books</a></li>
                <li><a class="dropdown-item" href="./childrenbooks.php">Children Book World</a></li>
            </ul>
        </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./mycart.php">myCart</a>
          </li>
        </ul>
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
        <li class="nav-item">
          <a class="btn btn-outline-light" href="./login.php">Login</a>
        </li>

        <li class="nav-item">
    <form action="logout.php" method="POST">
        <button type="submit" class="btn btn-danger nav-link">Logout</button>
    </form>
        </li>

      </div>
    </div>
  </nav>
</header>

<main>

  <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./S1.png" class="d-block w-100" alt="Image 1">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1 class="highlighted-text">JUMP INTO YOUR FAVOURITE FICTIONAL STORIES</h1>
            <p class="highlighted-text opacity-100">Get into the fav world of Potter's and much more too!</p>
            <p><a class="btn btn-lg btn-tertiary-black" href="./fictional.html">EXPLORE</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./s4.png" class="d-block w-100" alt="Image 1">
        <div class="container">
          <div class="carousel-caption">
            <h1 class="highlighted-text">WANT TO KNOW REAL NATIONWIDE LOVED INDIAN !</h1>
            <p class="highlighted-text opacity-100">Ratan Tata must be celebrated all over the world by Indians.Explore the biography about him to become one among the loved Indian and much more fictional !</p>
            <p><a class="btn btn-lg btn-tertiary-black" href="./non-fictional.html">EXPLORE NOW</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./s5.png" class="d-block w-100" alt="Image 1">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1 class="highlighted-text">CHILDREN !BY READING YOUR FAVOURITE BOOKS.</h1>
            <p class="highlighted-text opacity-100"> EXPLORE THE DREAM LAND </p>
            <p><a class="btn btn-lg btn-tertiary-black" href="./childrenbooks.html">EXPLORE DREAM LAND</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
        <img 
  src="./h1.png" 
  class="rounded-circle" 
  width="140" 
  height="140" 
  alt="Placeholder Image" 
  style="object-fit: cover;">

        <h2 class="fw-normal">FICTIONAL BOOKS</h2>
        <p>Stories born from creativity and imagination. They feature imaginary characters, worlds, <BR>and events that might not exist in reality.<BR>"Where imagination takes flight!"</p>
        <p><a class="btn btn-tertiary" href="./fictional.html">View Now »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img 
  src="./h22.png" 
  class="rounded-circle" 
  width="140" 
  height="140" 
  alt="Placeholder Image" 
  style="object-fit: cover;">
        <h2 class="fw-normal">NON-FICTIONAL BOOKS</h2>
        <p>These stories focus on real events, people, and facts. They aim to inform, inspire, or reflect reality, often through biographies,memories, or historical accounts.<BR>"Unveiling the world, one truth at a time."</p>
        <p><a class="btn btn-tertiary" href="./non-fictional.html">View Now »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img 
  src="./h3.png" 
  class="rounded-circle" 
  width="140" 
  height="140" 
  alt="Placeholder Image" 
  style="object-fit: cover;">
        <h2 class="fw-normal">CHILDREN TALES</h2>
        <p>Tailored for young minds, these stories are often simple, engaging, and carry valuable lessons. They nurture imagination and teach essential values<br> through fun narratives.<BR>"Big dreams for little minds!"</p>
        <p><a class="btn btn-tertiary" href="./childrenbooks.html">View Now »</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Eager to know more about Shantanu's Lighthouse <span class="text-body-secondary">Buy this to explore his world! Now in discount!!!</span></h2>
        <p class="lead">"Power and Wealth are not two of my main stakes"<br>-Ratan Tata</p>
      </div>
      <div class="col-md-5">
        <img 
  src="./d1.jpeg" 
  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" 
  width="500" 
  height="500" 
  alt="Placeholder Image" 
  style="object-fit: cover;">

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">THE HUNT<BR>"The world is full of obvious things which nobody by any chance ever observes."
             <span class="text-body-secondary">See for yourself.</span></h2>
        <p class="lead">Yes ! You heard it right! This book is open for sale in discount!<br> Buy before u miss the chance to jump into that world!!.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img 
        src="./d2.png" 
        class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" 
        width="500" 
        height="500" 
        alt="Placeholder Image" 
        style="object-fit: cover;">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">THE KID WHO CAME FROM SPACE <span class="text-body-secondary">YES! NOW ON SALE EXPLORE!</span></h2>
        <p class="lead">A small village in the wilds of northumberland is rocked by the disappearance of twelve-year-old Tammy.<BR>Read Next?Buy now!</p>
      </div>
      <div class="col-md-5">
        <img 
        src="./d3.png" 
        class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" 
        width="500" 
        height="500" 
        alt="Placeholder Image" 
        style="object-fit: cover;">      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>© 2017–2024 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
  </footer>
</main>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    

</body>
</html>