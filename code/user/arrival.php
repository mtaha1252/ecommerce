<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Arrivals</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <link rel="stylesheet" href="arrival.css" />
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="bgim">
      <h1>Western Collection 2024</h1>
      <h2 class="dynamic-text">Grace Meets Elegance</h2>
      <button class="play-button" id="playButton">
        <i class="bx bx-play"></i>
      </button>
    </div>

    <!-- Story Modal -->
    <div class="modal" id="storyModal">
      <div class="modal-content">
        <h2>Exclusive Lawn Collection 2024</h2>
        <p>
          Western Collection 2024<br />
          Step into the world of sophistication and style with our Western
          Collection 2024. This collection embraces the modern woman's spirit,
          blending comfort and flair effortlessly. From chic blazers to flowy
          dresses, this collection has something to elevate your look.
        </p>
        <button class="close-btn" id="closeButton">Close</button>
      </div>
    </div>

    <!-- Scrolling Content Section with Video -->
    <div class="video-container">
      <video controls>
          <source src="/launch.mp4" type="video/mp4">
          Your browser does not support the video tag.
      </video>
      <div class="video-info">
          <h2>Exclusive Western Dresses Launch Video</h2>
          <p>Starring PC</p>
      </div>
  </div>


    <!-- Scroll Section for Launch Announcement -->
    <div class="launch-announcement">
      <h2>Register Yourself to get notification for upcomming Collections</h2>
      <a href="sign-up.html"><button>
     Register Yourself
    </button></a> 
    
    </div>

    <!-- Scrolling Content Section with Previous Collections -->
    <div class="content-section">
      <h2>Previous Collections</h2>
      <div class="img-grid">
        <div class="img-item">
          <img src="l4.jpeg"></img>

          <div class="img-info">
            <h3>Summer Collection 2023</h3>
            <p>Bright and bold summer styles</p>
          </div>
        </div>
        <div class="img-item">
          <img src="l10.jpg"></img>

          <div class="img-info">
            <h3>Winter Collection 2022</h3>
            <p>Cozy and chic for the cold</p>
          </div>
        </div>
        <div class="img-item">
          <img src="l6.jpeg"></img>
          <div class="img-info">
            <h3>Spring Collection 2021</h3>
            <p>Floral prints and fresh colors</p>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="footer-content">
        <div>
          <h3>Follow Us</h3>
          <div class="social-media">
            <a href="https://facebook.com"><i class="bx bxl-facebook"></i></a>
            <a href="https://twitter.com"><i class="bx bxl-twitter"></i></a>
            <a href="https://instagram.com"><i class="bx bxl-instagram"></i></a>
            <a href="https://linkedin.com"><i class="bx bxl-linkedin"></i></a>
            <a href="https://youtube.com"><i class="bx bxl-youtube"></i></a>
          </div>
        </div>
        <div>
          <h3>Contact Us</h3>
          <p>Email: support@yourwebsite.com</p>
          <p>Phone: +123 456 7890</p>
        </div>
        <div>
          <h3>Need Help?</h3>
          <div class="report-problem">
            <a href="#">Report a Problem</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        &copy; 2024 A & H Clothing. All rights reserved.
      </div>
    </footer>
    
    <script src="arrival.js"></script>
  </body>
</html>
