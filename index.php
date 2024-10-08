<?php include('header.php');?>
   


<style>
.carousel-inner img {
     max-height: 678px; /* Adjust this value to your preferred height */
    object-fit: cover; /* Ensures the image covers the area while maintaining aspect ratio */
}

.carousel-caption {
    bottom: 250px;
    padding-left: 100px;
    padding-right: 100px;
}

.slider-btn .btn {
    background-color: rgb(159, 24, 24);
    color: white;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    border: none;
    border-radius: 10px;
    background-color: rgb(159, 24, 24);
}

.slider-btn .btn:hover {
    background-color: rgb(101, 15, 15); /* Slightly darker on hover */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .carousel-caption {
        bottom: 150px;
        padding-left: 50px;
        padding-right: 50px;
        text-align: center;

    }

    .slider-btn .btn {
        padding: 8px 15px;
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .carousel-caption {
        bottom: 100px;
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
    }

    .slider-btn .btn {
        padding: 6px 10px;
        font-size: 12px;
    }
}
/* Specific style for the Learn More button */
.slider-btn .learn-more-btn {
    background-color: #524e4e; /* Set background to black */
    color: white;
}

.slider-btn .learn-more-btn:hover {
    background-color: #2c2b2b; /* Slightly lighter black on hover */
}
</style>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://static.vecteezy.com/system/resources/previews/007/849/061/original/world-blood-donor-background-free-vector.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="color: rgb(159, 24, 24); font-weight: 700; margin-bottom: 30px;">Be a Hero. Save Lives. Donate Blood</h1>
        <div class="slider-btn">
          <a href="donorform.php" class="btn">Donate</a>
      </div>      
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://www.chaudharyhospital.in/wp-content/uploads/2024/05/blood-donation-1140x628.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <div class="slider-btn">
          <a href="https://www.healthline.com/health/benefits-of-donating-blood" class="btn learn-more-btn">Learn More</a>
        
      </div>
    </div>
  </div>
    <div class="carousel-item">
      <img src="https://static.vecteezy.com/system/resources/previews/018/929/858/original/blood-donation-2d-isolated-illustration-man-in-chair-on-blood-transfusion-donor-with-smiling-nurse-flat-characters-on-cartoon-background-charity-work-and-volunteering-colourful-scene-vector.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="color: rgb(159, 24, 24); font-weight: 700; margin-bottom: 30px;">Blood Aid: The Lifeline for Those in Need</h1>
        <div class="slider-btn">
          <a href="login.php" class="btn">Sign up</a>
        
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


            
        
  
<?php include('footer.php');?>