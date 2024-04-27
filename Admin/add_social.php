<?php
include '../includes/connect.php';

// Function to sanitize input for security
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $logo = isset($_FILES['logo']) ? $_FILES['logo']['name'] : '';
    $url = sanitize_input($_POST['url']);
    $owner_rights = sanitize_input($_POST['owner_rights']);
    
    
    // Prepare and execute SQL statement
    $sql = "INSERT INTO `social`(`url`, `owner_rights`) VALUES ( '$url', '$owner_rights')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<?php include '../includes/admin.php'; ?>
<div class="container">
    <h2>Add New Social Media Entry</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
    
        <div class="form-group">
            <label for="url">URL:</label>
            <input type="text" class="form-control" id="url" name="url" required>
        </div>
        <div class="form-group">
            <label for="owner_rights">Owner Rights:</label>
            <input type="text" class="form-control" id="owner_rights" name="owner_rights" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<style>
    .container {
        position: relative;
        margin: 0 auto;
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
