<?php 
include '../includes/connect.php';

// Initialize variables to store existing data
$id = '';
$logo = '';
$url = '';
$owner_rights = '';

// Check if ID parameter is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];

    // Fetch existing data from the database based on ID
    $sql = "SELECT * FROM social WHERE id = '$id'";
    $result = $conn->query($sql);

    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign existing data to variables
        $logo = $row['logo'];
        $url = $row['url'];
        $owner_rights = $row['owner_rights'];
    } else {
        echo "Record not found.";
        exit();
    }
}

// Check if form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $updated_logo = isset($_POST['logo']) ? $_POST['logo'] : '';
    $updated_url = isset($_POST['url']) ? $_POST['url'] : '';
    $updated_owner_rights = isset($_POST['owner_rights']) ? $_POST['owner_rights'] : '';


    // Update record in the database
    $sql_update = "UPDATE social SET logo='$updated_logo', url='$updated_url', owner_rights='$updated_owner_rights' WHERE id='$id'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully.";
        header("location:social.php"); // Redirect to the social page after updating
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
<?php include '../includes/admin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Data</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h2>Update Data</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
    <!-- Hidden input field to store ID -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="form-group">
      <label for="url">URL:</label>
      <input type="text" class="form-control" id="url" name="url" value="<?php echo $url; ?>" required>
    </div>
    <div class="form-group">
      <label for="owner_rights">Owner Rights:</label>
      <input type="text" class="form-control" id="owner_rights" name="owner_rights" value="<?php echo $owner_rights; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
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
