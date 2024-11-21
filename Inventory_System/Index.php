<?php
include 'Database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    $query = $db->prepare("INSERT INTO Products (name, description, quantity, price, image_url) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("ssids", $name, $description, $quantity, $price, $image_url);

    if ($query->execute()) {
        echo "<p style='color:green;'>Product added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $query->error . "</p>";
    }
}

// Fetch products to display in the table
$query = $db->query("SELECT * FROM Products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h1>Inventory Management</h1>

    <!-- Add Product Form -->
    <h2>Add New Product</h2>
    <form method="POST" action="index.php">
        <label>Product Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required></textarea><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="1" required><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" step="0.01" min="0.01" required><br><br>

        <label>Image URL:</label><br>
        <input type="text" name="image_url"><br><br>

        <button type="submit">Add Product</button>
    </form>

    <!-- Inventory Table -->
    <h2>Current Inventory</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $query->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>$<?php echo number_format($row['price'], 2); ?></td>
                    <td><img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width:50px; height:auto;"></td>
                    <td><a href="product.php?id=<?php echo $row['id']; ?>">View</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
000000000000