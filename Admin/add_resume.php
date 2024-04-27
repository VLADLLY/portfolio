<?php
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $school = isset($_POST['school']) ? $_POST['school'] : '';
    $project_thesis = isset($_POST['project_thesis']) ? $_POST['project_thesis'] : '';
    
    // Check if image file is selected
    if ($_FILES['school_image']['name']) {
        $school_image = $_FILES['school_image']['name'];
        $target = "../Admin/uploads/" . basename($school_image);
        move_uploaded_file($_FILES['school_image']['tmp_name'], $target);
    } else {
        $school_image = '';
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `resume`(`Course`, `School`, `Project/Thesis`, `School Image`) VALUES ('$course', '$school', '$project_thesis', '$school_image')";

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
    <h2>Insert Data into Resume Table</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course">Course:</label>
            <input type="text" class="form-control" id="course" name="course" required>
        </div>
        <div class="form-group">
            <label for="school">School:</label>
            <input type="text" class="form-control" id="school" name="school" required>
        </div>
        <div class="form-group">
            <label for="project_thesis">Project/Thesis:</label>
            <input type="text" class="form-control" id="project_thesis" name="project_thesis" required>
        </div>
        <div class="form-group">
            <label for="school_image">School Image:</label>
            <input type="file" class="form-control" id="school_image" name="school_image">
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
