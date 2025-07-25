<?php
session_start();
require 'db_connect.php';
require 'check_if_added.php';

// Fetch categories
$categories = $conn->query("SELECT * FROM categories");

// Fetch products, optionally filtered by category
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$product_query = $category_filter ? "SELECT * FROM products WHERE category_id = $category_filter" : "SELECT * FROM products";
$products = $conn->query($product_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifestyle Store - Shop Like Jumia</title>
    <link rel="shortcut icon" href="img/lifestyleStore.png" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #bannerImage {
            background: url('img/banner.jpg') no-repeat center center;
            background-size: cover;
            height: 400px;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        #bannerContent h1 { font-size: 2.5em; font-weight: bold; }
        #bannerContent p { font-size: 1.2em; }
        .category-sidebar { background: #f8f8f8; padding: 15px; border-radius: 5px; }
        .category-sidebar h4 { margin-bottom: 15px; }
        .category-sidebar ul { list-style: none; padding: 0; }
        .category-sidebar ul li { padding: 10px 0; }
        .category-sidebar ul li a { color: #333; text-decoration: none; }
        .category-sidebar ul li a:hover { color: #f28c38; }
        .thumbnail img { height: 50px; object-fit: cover; } /* 1/4 size (original ~200px) */
        .thumbnail { border: 1px solid #ddd; border-radius: 5px; transition: transform 0.2s; padding: 10px; }
        .thumbnail:hover { transform: scale(1.05); }
        .footer { background: #333; color: white; padding: 20px 0; }
        .footer a { color: #f28c38; margin: 0 10px; }
        .search-bar { margin: 15px 0; }
        .carousel-caption { background: rgba(0, 0, 0, 0.5); border-radius: 5px; }
        .category-section { margin-bottom: 30px; }
        .category-section h3 { color: #f28c38; }
        .category-description { font-style: italic; color: #666; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div>
        <?php require 'header.php'; ?>

        <!-- Search Bar -->
        <div class="container search-bar">
            <form action="index.php" method="GET" class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for products..." style="width: 80%;">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>
        </div>

        <!-- Banner -->
        <div id="bannerImage">
            <div class="container">
                <center>
                    <div id="bannerContent">
                        <h1>We sell lifestyle.</h1>
                        <p>Flat 40% OFF on all premium brands.</p>
                        <a href="#products" class="btn btn-danger">Shop Now</a>
                    </div>
                </center>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container" id="products">
            <div class="row">
                <!-- Category Sidebar -->
                <div class="col-md-3">
                    <div class="category-sidebar">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="index.php">All Products</a></li>
                            <?php while ($category = $categories->fetch_assoc()) { ?>
                                <li><a href="?category=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
                            <?php } $categories->data_seek(0); ?>
                        </ul>
                    </div>
                </div>

                <!-- Product Listings by Category -->
                <div class="col-md-9">
                    <div class="jumbotron">
                        <h1>Welcome to our Lifestyle Store!</h1>
                        <p>We have the best cameras, watches, shirts, and more for you.</p>
                    </div>

                    <?php
                    // Group products by category
                    $categories->data_seek(0); // Reset pointer
                    while ($category = $categories->fetch_assoc()) {
                        $category_id = $category['id'];
                        $category_name = htmlspecialchars($category['name']);
                        $category_description = htmlspecialchars($category['description']);
                        $products->data_seek(0); // Reset products pointer
                        $has_products = false;
                        ?>
                        <div class="category-section">
                            <h3><?php echo $category_name; ?></h3>
                            <p class="category-description"><?php echo $category_description; ?></p>
                            <div class="row">
                                <?php
                                while ($product = $products->fetch_assoc()) {
                                    if ($product['category_id'] == $category_id) {
                                        $has_products = true;
                                        ?>
                                        <div class="col-md-6 col-sm-6"> <!-- 2 products per row -->
                                            <div class="thumbnail">
                                                <a href="cart.php">
                                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                                </a>
                                                <center>
                                                    <div class="caption">
                                                        <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                                                        <p>Price: Rs. <?php echo number_format($product['price'], 2); ?></p>
                                                        <?php if (!isset($_SESSION['email'])) { ?>
                                                            <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                                        <?php } else {
                                                            if (check_if_added_to_cart($product['id'])) {
                                                                echo '<a href="#" class="btn btn-block btn-success disabled">Added to cart</a>';
                                                            } else { ?>
                                                                <a href="cart_add.php?id=<?php echo $product['id']; ?>" class="btn btn-block btn-primary" name="add">Add to cart</a>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php if (!$has_products) { ?>
                                <p>No products available in this category.</p>
                            <?php } ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <center>
                    <p>Copyright © Lifestyle Store. All Rights Reserved. | Contact Us: +91 90000 00000</p>
                    <p>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </p>
                    <p>This website is developed by Sajal Agrawal</p>
                </center>
            </div>
        </footer>
    </div>

    <!-- JavaScript for Search -->
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                let searchTerm = $('input[name="search"]').val().toLowerCase();
                $('.thumbnail').each(function() {
                    let productName = $(this).find('h4').text().toLowerCase();
                    if (productName.includes(searchTerm) || searchTerm === '') {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
