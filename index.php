<?php
session_start();
require 'check_if_added.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifestyle Store - Shop Like Jumia</title>
    <link rel="shortcut icon" href="img/lifestyleStore.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jQuery -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- Font Awesome for icons (like Jumia) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Custom styles inspired by Jumia */
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
        #bannerContent h1 {
            font-size: 2.5em;
            font-weight: bold;
        }
        #bannerContent p {
            font-size: 1.2em;
        }
        .category-sidebar {
            background: #f8f8f8;
            padding: 15px;
            border-radius: 5px;
        }
        .category-sidebar h4 {
            margin-bottom: 15px;
        }
        .category-sidebar ul {
            list-style: none;
            padding: 0;
        }
        .category-sidebar ul li {
            padding: 10px 0;
        }
        .category-sidebar ul li a {
            color: #333;
            text-decoration: none;
        }
        .category-sidebar ul li a:hover {
            color: #f28c38;
        }
        .thumbnail img {
            height: 200px;
            object-fit: cover;
        }
        .thumbnail {
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: transform 0.2s;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .footer {
            background: #333;
            color: white;
            padding: 20px 0;
        }
        .footer a {
            color: #f28c38;
            margin: 0 10px;
        }
        .search-bar {
            margin: 15px 0;
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div>
        <?php require 'header.php'; ?>

        <!-- Search Bar -->
        <div class="container search-bar">
            <form action="products.php" method="GET" class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search for products..." style="width: 80%;">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>
        </div>

        <!-- Featured Products Carousel -->
        <div id="featuredCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#featuredCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#featuredCarousel" data-slide-to="1"></li>
                <li data-target="#featuredCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="img/cannon_eos.jpg" alt="Cannon EOS" style="height: 400px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h3>Cannon EOS - 40% OFF</h3>
                        <p>Shop now for the best deals!</p>
                    </div>
                </div>
                <div class="item">
                    <img src="img/titan301.jpg" alt="Titan Watch" style="height: 400px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h3>Titan Model #301</h3>
                        <p>Luxury watches at unbeatable prices!</p>
                    </div>
                </div>
                <div class="item">
                    <img src="img/raymond.jpg" alt="Raymond Shirt" style="height: 400px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h3>Raymond Shirts</h3>
                        <p>Elegance in every thread!</p>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#featuredCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#featuredCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>

        <!-- Banner from index.php -->
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
                            <li><a href="?category=cameras">Cameras</a></li>
                            <li><a href="?category=watches">Watches</a></li>
                            <li><a href="?category=shirts">Shirts</a></li>
                            <li><a href="?category=all">All Products</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Product Listings -->
                <div class="col-md-9">
                    <div class="jumbotron">
                        <h1>Welcome to our Lifestyle Store!</h1>
                        <p>We have the best cameras, watches, and shirts for you. No need to hunt around, we have all in one place.</p>
                    </div>

                    <!-- Product Grid -->
                    <div class="row">
                        <!-- Cameras -->
                        <?php
                        $products = [
                            ['id' => 1, 'name' => 'Cannon EOS', 'price' => 36000.00, 'image' => 'img/cannon_eos.jpg', 'category' => 'cameras'],
                            ['id' => 2, 'name' => 'Sony DSLR', 'price' => 40000.00, 'image' => 'img/sony_dslr.jpeg', 'category' => 'cameras'],
                            ['id' => 3, 'name' => 'Sony DSLR', 'price' => 50000.00, 'image' => 'img/sony_dslr2.jpeg', 'category' => 'cameras'],
                            ['id' => 4, 'name' => 'Olympus DSLR', 'price' => 80000.00, 'image' => 'img/olympus.jpg', 'category' => 'cameras'],
                            ['id' => 5, 'name' => 'Titan Model #301', 'price' => 13000.00, 'image' => 'img/titan301.jpg', 'category' => 'watches'],
                            ['id' => 6, 'name' => 'Titan Model #201', 'price' => 3000.00, 'image' => 'img/titan201.jpg', 'category' => 'watches'],
                            ['id' => 7, 'name' => 'HMT Milan', 'price' => 8000.00, 'image' => 'img/hmt.JPG', 'category' => 'watches'],
                            ['id' => 8, 'name' => 'Favre Leuba #111', 'price' => 18000.00, 'image' => 'img/favreleuba.jpg', 'category' => 'watches'],
                            ['id' => 9, 'name' => 'Raymond', 'price' => 1500.00, 'image' => 'img/raymond.jpg', 'category' => 'shirts'],
                            ['id' => 10, 'name' => 'Charles', 'price' => 1000.00, 'image' => 'img/charles.jpg', 'category' => 'shirts'],
                            ['id' => 11, 'name' => 'HXR', 'price' => 900.00, 'image' => 'img/HXR.jpg', 'category' => 'shirts'],
                            ['id' => 12, 'name' => 'PINK', 'price' => 1200.00, 'image' => 'img/pink.jpg', 'category' => 'shirts'],
                        ];

                        // Filter products by category if selected
                        $category = isset($_GET['category']) ? $_GET['category'] : 'all';
                        foreach ($products as $product) {
                            if ($category === 'all' || $product['category'] === $category) {
                        ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="thumbnail">
                                <a href="cart.php">
                                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                </a>
                                <center>
                                    <div class="caption">
                                        <h3><?php echo $product['name']; ?></h3>
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
                        <?php }
                        } ?>
                    </div>
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

    <!-- JavaScript for Search (Basic Example) -->
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                let searchTerm = $('input[name="search"]').val().toLowerCase();
                $('.thumbnail').each(function() {
                    let productName = $(this).find('h3').text().toLowerCase();
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
