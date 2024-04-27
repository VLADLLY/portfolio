<?php 
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FN = isset($_POST['FN']) ? $_POST['FN'] : '';
    $LN = isset($_POST['LN']) ? $_POST['LN'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $skill = isset($_POST['skill']) ? $_POST['skill'] : '';

    // Check if image file is selected
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "../Admin/uploadS/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = '';
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `landing`(`FN`, `LN`, `role`, `content`, `skill`, `image`) VALUES ('$FN','$LN','$role','$content','$skill', '$image')";

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
      <label for="FN">First Name:</label>
      <input type="text" class="form-control" id="FN" name="FN" required>
    </div>
    <div class="form-group">
      <label for="LN">Last Name:</label>
      <input type="text" class="form-control" id="LN" name="LN" required>
    </div>
    <div class="form-group">
      <label for="role">Role:</label>
      <input type="text" class="form-control" id="role" name="role" required>
    </div>
    <div class="form-group">
      <label for="content">Content:</label>
      <input type="text" class="form-control" id="content" name="content" required>
    </div>
    <div class="form-group">
      <label for="skill">Skill:</label>
      <input type="text" class="form-control" id="skill" name="skill" required>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="image" name="image">
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
