<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body style="background-color: #503b31;">
    <!-- NAVBAR -->
  <div class="sidebar">
        <div class="background">
            <button class="menu__icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span></span>
            <span></span>
            <span></span>
            </button>
            </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel" >Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

        <div class="offcanvas-body">
                  <!-- <li class="list-group-item"><a href="navbar.php" class="link-light">Navbar</a></li>
                  <div class="collapse" id="NavbarSection">
                  </div>   -->
                  <li class="list-group-item"><a href="landing.php" class="link-light">Landing</a></li>
                  <div class="collapse" id="LandingSection">
                  </div>
                  <li class="list-group-item"><a href="welcome.php" class="link-light">Welcome</a></li>
                  <div class="collapse" id="WelcomeSection">
                  </div>
                  <li class="list-group-item"><a href="aboutme.php" class="link-light">About Me</a></li>
                  <div class="collapse" id="aboutMeSection">
                  </div>
                  <li class="list-group-item"><a href="resume.php" class="link-light">Resume</a></li>
                  <div class="collapse" id="resumeSection">
                  </div>
                  <li class="list-group-item"><a href="skill.php" class="link-light">Skills</a></li>
                  <div class="collapse" id="skillsSection">
                  </div>
                  <li class="list-group-item"><a href="blog.php" class="link-light">Blog</a></li>
                  <div class="collapse" id="blogSection">
                  </div>
                  <li class="list-group-item"><a href="contact.php" class="link-light">Contact</a></li>
                  <div class="collapse" id="contactSection">
                  </div>
                  <li class="list-group-item"><a href="social.php" class="link-light">Social</a></li>
                  <div class="collapse" id="SocialSection">
                  </div>
              <form method="post" action="logout.php" class="link-light">
                <button type="submit" name="logout">Logout<i class="bi bi-arrow-left-square"></i></button>
            </form>
        </div>
      </div>
      
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
      
    <!-- NAVBAR -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
          var offcanvasElement = document.getElementById('offcanvasExample');
          var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
    
          // Override the default behavior of offcanvas close
          var closeButton = offcanvasElement.querySelector('.btn-close');
          closeButton.addEventListener('click', function () {
            offcanvas.hide(); // Hide the offcanvas
            // Add custom animation to close slowly
            var offcanvasBackdrop = document.querySelector('.offcanvas-backdrop');
            offcanvasBackdrop.style.transition = 'opacity 0.5s';
            offcanvasBackdrop.style.opacity = '0';
            setTimeout(function () {
              offcanvasBackdrop.style.display = 'none';
            }, 500); // 0.5s is the duration of transition
          });
        });
      </script>
</body>
</html>