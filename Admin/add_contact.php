<?php
include '../includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
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

<?php include '../includes/admin.php'; ?>
<div class="container">
    <h2>Add New Contact</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="work">Work:</label>
            <input type="text" class="form-control" id="work" name="work" required>
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
