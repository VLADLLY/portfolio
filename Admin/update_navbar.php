<?php 
include '../includes/connect.php';

// Initialize variables to store existing data
$id = '';
$webname = '';
$logo = '';

// Check if ID parameter is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];

    // Fetch existing data from the database based on ID
    $sql = "SELECT * FROM navbar WHERE id = '$id'";
    $result = $conn->query($sql);

    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign existing data to variables
        $webname = $row['Webname'];
        $logo = $row['Logo'];
    } else {
        echo "Record not found.";
        exit();
    }
}

// Check if form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $updated_webname = isset($_POST['webname']) ? $_POST['webname'] : '';

    // Check if a new logo file is uploaded
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $logo_name = $_FILES['logo']['name'];
        $logo_tmp = $_FILES['logo']['tmp_name'];
        $logo_destination = '../admin/uploads/' . $logo_name;

        // Move uploaded file to destination folder
        if (move_uploaded_file($logo_tmp, $logo_destination)) {
            $logo = $logo_name;
        } else {
            echo "Failed to upload logo.";
        }
    }

    // Update record in the database
    $sql_update = "UPDATE navbar SET Webname='$updated_webname', Logo='$logo' WHERE id='$id'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

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

<?php include '../includes/admin.php'; ?>
<div class="container">
  <h2>Update Data</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
    <!-- Hidden input field to store ID -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label for="webname">Website Name:</label>
      <input type="text" class="form-control" id="webname" name="webname" value="<?php echo $webname; ?>" required>
    </div>
    <div class="form-group">
      <label for="logo">Update Logo:</label>
      <input type="file" class="form-control" id="logo" name="logo">
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
