<?php
session_start();
require 'db_connect.php';

// Check if user is admin (basic check, enhance for production)
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}

// Handle category creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_category'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $conn->query("INSERT INTO categories (name, description) VALUES ('$name', '$description')");
}

// Handle category editing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_category'])) {
    $id = (int)$_POST['id'];
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $conn->query("UPDATE categories SET name='$name', description='$description' WHERE id=$id");
}

// Handle category deletion
if (isset($_GET['delete_category'])) {
    $id = (int)$_GET['delete_category'];
    $conn->query("DELETE FROM categories WHERE id=$id");
}

$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Lifestyle Store</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <style>
        .admin-container { padding: 20px; }
        .form-container { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container admin-container">
        <h2>Manage Categories</h2>

        <!-- Create Category Form -->
        <div class="form-container">
            <h4>Create Category</h4>
            <form method="POST">
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <button type="submit" name="create_category" class="btn btn-primary">Create</button>
            </form>
        </div>

        <!-- Category List -->
        <h4>Existing Categories</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($category = $categories->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                    <td><?php echo htmlspecialchars($category['description']); ?></td>
                    <td>
                        <!-- Edit Form -->
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $category['id']; ?>">Edit</button>
                        <a href="?delete_category=<?php echo $category['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?php echo $category['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                            <div class="form-group">
                                                <label for="name">Category Name:</label>
                                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <textarea class="form-control" name="description"><?php echo htmlspecialchars($category['description']); ?></textarea>
                                            </div>
                                            <button type="submit" name="edit_category" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
