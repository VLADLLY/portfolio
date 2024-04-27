<?php 
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : '';
    $project_description = isset($_POST['project_description']) ? $_POST['project_description'] : '';

    // Check if image file is selected
    if ($_FILES['project_image']['name']) {
        $project_image = $_FILES['project_image']['name'];
        $target = "../Admin/uploadS/" . basename($project_image);
        move_uploaded_file($_FILES['project_image']['tmp_name'], $target);
    } else {
        $project_image = '';
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `blog`(`project_name`, `project_description`, `project_image`) VALUES ('$project_name','$project_description','$project_image')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<?php include '../includes/admin.php'; ?>
<div class="container">
  <h2>Insert Data</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="project_name">Project Name:</label>
      <input type="text" class="form-control" id="project_name" name="project_name" required>
    </div>
    <div class="form-group">
      <label for="project_description">Project Description:</label>
      <input type="text" class="form-control" id="project_description" name="project_description" required>
    </div>
    <div class="form-group">
      <label for="project_image">Project Image:</label>
      <input type="file" class="form-control" id="project_image" name="project_image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>

<style>
  .container{
    position: relative;
    margin: 0px auto;
    width: 700px;
    padding: 20px;
    background-color: #000;
    color: #fff;
    border: 1px solid #ccc;
    border-radius: 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    top: 10%;
    left: 500%;
  }
</style>
