<?php
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $webname = isset($_POST['webname']) ? $_POST['webname'] : '';
    
    // Check if image file is selected
    if ($_FILES['logo']['name']) {
        $logo = $_FILES['logo']['name'];
        $target = "../Admin/uploadS/" . basename($logo);
        move_uploaded_file($_FILES['logo']['tmp_name'], $target);
    } else {
        $logo = '';
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `navbar`(`Webname`, `Logo`) VALUES ('$webname', '$logo')";

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
            <label for="webname">Website Name:</label>
            <input type="text" class="form-control" id="webname" name="webname" required>
        </div>
        <div class="form-group">
            <label for="logo">  Logo:</label>
            <input type="file" class="form-control" id="logo" name="logo">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<style>
    .container {
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
