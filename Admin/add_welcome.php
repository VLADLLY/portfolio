<?php include '../includes/connect.php'; ?>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $description = $_POST['description'] ?? '';

    // Prepare SQL statement
    $sql = "INSERT INTO welcome (Description) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("s", $description);

    // Execute statement
    if ($stmt->execute()) {
        $message = "Data inserted successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data into Welcome Table</title>
</head>
<body>
<?php include '../includes/admin.php'; ?>
    <div class="container">
    <h1>Insert Data into Welcome Table</h1>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" class="btn btn-primary" value="Submit">
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
    background-color: #fff;
    color: #000;
    border: 5px solid #ccc;
    border-radius: 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    top: 10%;
    left: 500%;
  }
</style>