<?php
include '../includes/connect.php';

// Define variables and initialize with empty values
$skill_name = $skill_image = $description = "";
$skill_name_err = $skill_image_err = $description_err = "";

// Function to sanitize input for security
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate skill name
    if (isset($_POST["skill_name"]) && !empty(trim($_POST["skill_name"]))) {
        $skill_name = sanitize_input($_POST["skill_name"]);
    } else {
        $skill_name_err = "Please enter the skill name.";
    }

    // Validate description
    if (isset($_POST["description"]) && !empty(trim($_POST["description"]))) {
        $description = sanitize_input($_POST["description"]);
    } else {
        $description_err = "Please enter the description.";
    }

    // Check input errors before inserting into database
    if (empty($skill_name_err) && empty($description_err)) {
        // Check if a file is selected for image
        if (isset($_FILES['skill_image']) && $_FILES['skill_image']['error'] === UPLOAD_ERR_OK) {
            $skill_image_name = $_FILES['skill_image']['name'];
            $skill_image_tmp = $_FILES['skill_image']['tmp_name'];
            $skill_image_destination = '../admin/uploads/' . $skill_image_name;

            // Move uploaded file to destination folder
            if (move_uploaded_file($skill_image_tmp, $skill_image_destination)) {
                $skill_image = $skill_image_name;

                // Insert data into database
                $sql_insert = "INSERT INTO skill (skill_name, skill_image, description) VALUES (?, ?, ?)";
                if ($stmt = $conn->prepare($sql_insert)) {
                    $stmt->bind_param("sss", $param_skill_name, $param_skill_image, $param_description);
                    $param_skill_name = $skill_name;
                    $param_skill_image = $skill_image;
                    $param_description = $description;
                    if ($stmt->execute()) {
                        // Redirect to skill.php after successfully adding data
                        header("location: skill.php");
                        exit();
                    } else {
                        echo "Something went wrong. Please try again later.";
                    }
                }
            } else {
                $skill_image_err = "Failed to upload skill image.";
            }
        } else {
            $skill_image_err = "Please select a skill image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Blog Data</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/admin.php'; ?>
<div class="container">
  <h2>Add Blog Data</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="skill_name">Skill Name:</label>
      <input type="text" class="form-control <?php echo (!empty($skill_name_err)) ? 'is-invalid' : ''; ?>" id="skill_name" name="skill_name" value="<?php echo $skill_name; ?>" required>
      <span class="invalid-feedback"><?php echo $skill_name_err; ?></span>
    </div>
    <div class="form-group">
      <label for="skill_image">Skill Image:</label>
      <input type="file" class="form-control-file <?php echo (!empty($skill_image_err)) ? 'is-invalid' : ''; ?>" id="skill_image" name="skill_image" required>
      <span class="invalid-feedback"><?php echo $skill_image_err; ?></span>
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" id="description" name="description" rows="5" required><?php echo $description; ?></textarea>
      <span class="invalid-feedback"><?php echo $description_err; ?></span>
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