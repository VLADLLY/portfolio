<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio2</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
    <title>Document</title>
</head>
<body>
  <style>
    /* Paste your loader CSS here */
    .loader {
      --color: #a5a5b0;
      --size: 30px;
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 5px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999; /* Ensures loader is on top of other content */
      background-color: rgb(106 72 56); /* Set the background color to brown */
      opacity: 1; /* Initially fully visible */
      animation: fadeOut 3s forwards; /* Animation to fade out over 3 seconds */
    }

    .loader span {
      width: var(--size);
      height: var(--size);
      border: 1px solid var(--color);
      border-radius: 5px;
      animation: keyframes-rotate 2s alternate infinite ease-in-out;
    }

    .loader span:nth-child(1) {
      animation-delay: 0ms;
    }

    .loader span:nth-child(2) {
      animation-delay: 50ms;
    }

    .loader span:nth-child(3) {
      animation-delay: 100ms;
    }

    .loader span:nth-child(4) {
      animation-delay: 150ms;
    }

    @keyframes keyframes-rotate {
      50% {
        transform: rotate(360deg);
      }
    }

    @keyframes fadeOut {
      0% {
        opacity: 1; /* Start with full opacity */
      }
      100% {
        opacity: 0; /* Fade out to fully transparent */
      }
    }

    /* Hide page content initially */
    .page-content {
      display: none;
    }
  </style>
</head>
<body>

<!-- Your existing HTML code here -->

<div class="loader" id="loader">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div>

    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="../ladjaaliportfo/adminlogin/login.html"><img src="img/removeu.png" alt="" class="logo" style="width: 70px;" data-aos="zoom-in-up" data-aos-delay="800">Vlad</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" data-aos="fade-up-right" data-aos-delay="600">
          <ul class="navbar-nav">
            <a class="nav-link" href="#about">About me</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#rem">Resume</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#serve">Services</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#Blog">Blog</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#cont">Contact</a>
          </li>
      </ul>
        </div>
        <a href="#cont"><button class="button type1" data-aos="zoom-in-up" data-aos-delay="1000">
          <span class="btn-txt">Hire me</span>
        </button></a>
      </nav>

      <!-- LANDING PAGE -->
      <section id="land" class="landing" style="background-image: url(img/box1.png); height: 90vh; background-size: cover;">
        
       <?php
        include './includes/connect.php';

        $sql = "SELECT * FROM landing limit 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
            
                <img src="./admin/uploads/<?php echo $row['image'] ?>" alt="" style="height: 500px; padding-left: 400px; margin-top: 100px; border-radius: 100% 100% 100% 0%;" data-aos="zoom-in-up">
                  
                  <div class="tamad">
                    <h1 data-aos="fade-left" data-aos-delay="500"> <?php echo $row['FN'] ?><br> <?php echo $row['LN'] ?></h1>
                    <h2 data-aos="fade-left" data-aos-delay="520"><?php echo $row['role'] ?></h2>
                  </div>
                  <div class="papatyo">
                    <p></p>
                  </div>
                  <div class="tyo" data-aos="fade-up-right">
                    <p>Pro <br> <?php echo $row['skill'] ?></p>
                  </div>
                </section>
          <?php
            }
        } 
            ?>

      <!-- WELCOME -->
      <section id="welcome" class="welcome" data-aos="zoom-in">
    <div class="come">
        <div class="tatu">
            <h1><i class="fa-solid fa-door-open" data-aos="zoom-in-up" data-aos-delay="800"></i>Welcome</h1>
        </div>
        <?php
        include './includes/connect.php';

        $sql = "SELECT * FROM welcome limit 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <p><?php echo $row['Description']; ?></p>
                <?php
            }
        } else {
            ?>
            <p>To my IT portfolio! Dive into a world where innovation meets expertise. Explore my projects and witness the power of technology in action. Let's create digital transformations together.</p>
            <?php
        }
        ?>
       <a href="./adminlogin/admin_login.php"> <button class="tik"> Start now </button></a>
    </div>
</section>


<?php 
 include './includes/connect.php';

 $sql = "SELECT * FROM about_me limit 1";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      ?>
      <section class="bout" style="background-image: url(img/box1.png); width: 50%; height:600px; display: inline-block;">
        <div id="about" class="me" data-aos="fade-right" data-aos-delay="700">
          <h2 class="bayut"> About me</h2>
        
        </div>
        <div class="other">
          <p class="text" data-aos="fade-right">
          <?php echo $row['Description']; ?>
    
          </p>
        </div> 
        <img src="img/box2.png" alt=""style="width: 844px; margin-left: 844px; margin-top: -210px; height:600px; display: inline-block;" data-aos="zoom-in">
        <div>
          <img src="./admin/uploads/<?php echo $row['Image']; ?>" alt="" style="width: 27%; left: 1045px; bottom: -850px; height:400px; position: absolute;" data-aos="zoom-in" data-aos-delay="400">
      </div>    
        </div>
        </section>
        <?php  
  }}
?>
      <!-- RESUME -->
      
      <?php 
      include './includes/connect.php';

      $sql = "SELECT * FROM resume limit 1";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>
      <section id="rem" class="ume" style="height: 40vh;">
        <div class="python">
          <h1 data-aos="fade-right">Education</h1>
          <p data-aos="fade-right" data-aos-delay="100">  <?php echo $row['Course']; ?><br>
          <?php echo $row['School']; ?> <br>
          <?php echo $row['Project/Thesis']; ?> 
            
            </p>
        </div>
        <img src="./admin/uploads/<?php echo $row['School Image'] ?>" alt="" class="tata" style="border-radius: 50% 20% 50% 10%;" data-aos="zoom-in" data-aos-delay="500">
      </section>

      <?php
        }
      }
      ?>
    

<!-- <section>
    <div class="area" >
                  <ul class="circles">
                          <li></li>
                          <li></li>
                          <li></li>
                          <li></li>
                          <li></li>
                          <li></li>
                          <li></li>
                          <li></li>
                          <li></li>
                          <li></li>
                  </ul>
          </div >
      </section> -->


      <section id="serve" class="services" style="background-color: white;">
        <div class="serv">
          <h1 data-aos="fade-right">Skills</h1>
          <p data-aos="fade-right">Welcome to my services! I offer a comprehensive range of skills including graphic design, front-end development, and proficiency in Microsoft Word, Excel, and PowerPoint. Whether you need captivating visuals, seamless interfaces, or polished documents, I got you covered. Let me bring your vision to life!</p>
        </div>

        <?php 
include './includes/connect.php';

$sql = "SELECT * FROM Skill ";
$result = $conn->query($sql);
?>

<div class="skills-container">
  <?php 
  // Loop through each row of the result set
  while ($row = $result->fetch_assoc()) {
    ?>
    <div class="skill-item" data-aos="zoom-in" data-aos-delay="500">
      <div class="image-wrapper">
        <img src="./admin/uploads/<?php echo $row['skill_image']; ?>" height="200" width="auto" alt="" class="skill-image">
      </div>
      <div class="skill-details">
        <h1><?php echo $row['skill_name']; ?></h1>
        <p><?php echo $row['description']; ?></p>
      </div>
    </div>
    <?php 
  }
  ?>
</div>

<?php 
?>

</section>
<style>
  .skills-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; 
}

.skill-item {
  width: 300px; 
  margin-right: 20px; 
  margin-bottom: 20px; 
}

.image-wrapper {
  text-align: center;
}

.skill-image {
  height: 200px; 
  width: auto; 
}

.skill-details {
  text-align: center;
}
.area .circles {
  z-index: 0;
  margin: auto;

}
</style>

    
      <!-- BLOG -->
      <?php 
include './includes/connect.php';

$sql = "SELECT * FROM blog limit 6";
$result = $conn->query($sql);
?>

<section id="Blog" class="glob">
  <div class="gallery">
    <h1 class="tabu"><i class="fa-solid fa-camera-retro"><br></i>MY GALLERY</h1>
  </div>
  <div class="para">
    <p>Welcome to my services! I offer a comprehensive range of skills including graphic design, front-end development, and proficiency in Microsoft Word, Excel, and PowerPoint. Whether you need captivating visuals, seamless interfaces, or polished documents, I got you covered. Let me bring your vision to life!</p>
  </div>

  <?php while($row = $result->fetch_assoc()): ?>
    <section id="card<?php echo $row['id']; ?>" class="card<?php echo $row['id']; ?>">
      <img src="./admin/uploads/<?php echo $row['project_image']; ?>" alt="" style="width: 100%;" height="100%">
      <div class="card<?php echo $row['id']; ?>__content">
        <p class="card<?php echo $row['id']; ?>__title"><?php echo $row['project_name']; ?></p>
        <p class="card<?php echo $row['id']; ?>__description"><?php echo $row['project_description']; ?></p>
      </div>
    </section>
  <?php endwhile; ?>
</section>

      </section>
    
      <section id="cont" class="contact" style="background-image: url(img/box1.png); width: 100%; height: 90vh; position: static;">
        <div class="conz">
          <h1 data-aos="fade-right" data-aos-delay="500"><i class="fa-solid fa-phone" style="font-size: 33px; margin-right: 10px;"></i>Contact Me</h1>
        </div>
        <div class="tayo">
          <p data-aos="fade-right" data-aos-delay="600">You may contact me in any concern here in the contact section.</p>
        </div>
        <div class="E">
          <h5 data-aos="fade-right" data-aos-delay="600">Email</h5>
            <p data-aos="fade-right" data-aos-delay="600">ladjaalivladimir4@gmail.com</p>
        </div>
        <div class="PH">
          <h5 data-aos="fade-right" data-aos-delay="600">Phone</h5>
            <p data-aos="fade-right" data-aos-delay="600">09626120798</p>
        </div>
        <div class="W">
          <h5 data-aos="fade-right" data-aos-delay="600">Work</h5>
            <p data-aos="fade-right" data-aos-delay="600">Monday to Friday 9pm to 12am (GMT)</p>
        </div>

        <?php 
include './includes/connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $work = isset($_POST['work']) ? $_POST['work'] : '';
    
    // Prepare and execute SQL statement
    $sql = "INSERT INTO `contact`(`email`, `phone`, `work`) VALUES ('$email', '$phone', '$work')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <input type="email" placeholder="Enter email" name="email" class="input">
    <input type="tel" placeholder="Contact number" name="phone" class="input">
    <textarea name="work" id="work" placeholder="How can I help you?" rows="7" cols="40" required=""></textarea>
    <button type="submit" class="button-confirm">Submit</button>
</form>
<section id="right" class="r" style="background-color: #fffdd0;">
    <div class="side">
    </div>

</section>

<style>
  .form{
    margin-bottom: 100px;
  }
</style>

      <!-- END -->
      <section id="end" class="last" style=" background-color: rgb(255, 255, 255); height: 20vh;">
        <footer>
          <img src="img/removeu.png" alt="" class="logo" style="width: 70px; position: absolute; margin-left: 100px; margin-top: 30px; border-right: black solid 3px;">
          <div>
            <h1 style="position: absolute; margin-left: 250px; font-size: 20px; margin-top: 60px;">About me</h1>
            <h1 style="position: absolute; margin-left: 450px; font-size: 20px; margin-top: 60px;" >resume</h1>
            <h1 style="position: absolute; margin-left: 600px; font-size: 20px; margin-top: 60px;">service</h1>
            <h1 style="position: absolute; margin-left: 750px; font-size: 20px; margin-top: 60px;">blog</h1>
            <h1 style="position: absolute; margin-left: 900px; font-size: 20px; margin-top: 60px;">contact</h1>
          </div>
          <?php 
include './includes/connect.php';

// Define an associative array mapping platform names to CSS properties and Font Awesome icons
$platform_data = array(
  'facebook' => array('color' => '#3b5998', 'margin_left' => '1100px', 'icon_class' => 'fa-facebook-f'),
  'twitter' => array('color' => '#55acee', 'margin_left' => '1150px', 'icon_class' => 'fa-twitter'),
  'google' => array('color' => '#dd4b39', 'margin_left' => '1200px', 'icon_class' => 'fa-google'),
  'instagram' => array('color' => '#ac2bac', 'margin_left' => '1250px', 'icon_class' => 'fa-instagram')
);

// Fetch social media links from the database
$sql_social = "SELECT `url`, `owner_rights` FROM `social`";
$result_social = $conn->query($sql_social);
?>

<div class="social-links">
  <?php 
  // Loop through each row of the result set for social media links
  while ($row_social = $result_social->fetch_assoc()) {
    // Get the data for the current platform
    $platform_data_current = $platform_data[$row_social['owner_rights']];
    ?>
    <!-- Social media link -->
    <a style="color: <?php echo $platform_data_current['color']; ?>; margin-left: <?php echo $platform_data_current['margin_left']; ?>; font-size: 17px; margin-top: 60px; position: absolute;" href="<?php echo $row_social['url']; ?>" role="button">
      <i class="fab <?php echo $platform_data_current['icon_class']; ?> fa-lg"></i>
    </a>
    <?php 
  }
  ?>
</div>


<?php 
?>


            <div class="port">
              <p>Portfolio by <b>@vladimir <br>
                All rights reserved
              </b></p>
            </div>
        </footer>
      </section>
      
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
        AOS.init();
      </script>
      <script>
        // Function to remove the loader and show the page content after 3 seconds
        setTimeout(function() {
          var loader = document.getElementById('loader');
          var pageContent = document.getElementById('page-content');
          if(loader) {
            loader.remove();
          }
          if(pageContent) {
            pageContent.style.display = 'block';
          }
        }, 5000); // 3000 milliseconds = 3 seconds
      </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
  $(document).ready(function(){
    // Initialize Slick Slider
    $('.slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: true,
      dots: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });

    // Filter cards
    $('.category-filter').on('click', function(){
      var category = $(this).data('category');
      
      // Show or hide card sections based on category
      $('.card2.website').toggle(category === 'website');
      
      // If the slider is initialized, reset it
      if ($('.slider').hasClass('slick-initialized')) {
        $('.slider').slick('unslick');
      }
      
      // Re-initialize the slider
      $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    });
  });
</script>


</body>
</html>