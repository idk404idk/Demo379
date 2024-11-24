<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

// إضافة تعليق جديد
if (isset($_POST['add_testimonial'])) {
    if (!empty($user_id)) {
        $comment = htmlspecialchars($_POST['comment']);
        $insert_testimonial = $conn->prepare("INSERT INTO `testimonials` (user_id, comment, created_at) VALUES (?, ?, NOW())");
        $insert_testimonial->execute([$user_id, $comment]);

        $message[] = 'Your comment has been submitted!';
    } else {
        $message[] = 'Please login to leave a comment.';
    }
}

// استرجاع الإحصائيات
$products_count = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$customers_count = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
$orders_count = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();

// جلب الشهادات التي تمت الموافقة عليها فقط
$select_testimonials = $conn->prepare("
    SELECT t.comment, u.name, t.created_at 
    FROM testimonials t
    JOIN users u ON t.user_id = u.id
    WHERE t.is_approved = TRUE
    ORDER BY t.created_at DESC
");
$select_testimonials->execute();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCEngine.com</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
<?php include 'components/user_header.php'; ?>


<div class="pg1-slider">
    <div class="pg1-list">
        <!-- الشريحة الأولى -->
        <div class="pg1-item pg1-active">
            <img src="images/adspg1.webp">
            <div class="pg1-content">
                <p>Welcome to PCEngine</p>
                <h2>Your Gateway to Advanced PC Components</h2>
                <p>
                    Discover premium PC components designed for performance and durability.
                </p>
            </div>
        </div>

        <!-- الشريحة الثانية -->
        <div class="pg1-item">
            <img src="images/forhbg5.jpg">
            <div class="pg1-content">
                <p>Unleash the Power</p>
                <h2>High-Performance for Every Gamer</h2>
                <p>
                    Build your dream PC with the latest cutting-edge technologies.
                </p>
            </div>
        </div>

        <!-- الشريحة الثالثة -->
        <div class="pg1-item">
            <img src="images/forhbg9.webp">
            <div class="pg1-content">
                <p>Innovate</p>
                <h2>Experience the Future of Computing</h2>
                <p>
                    Upgrade your setup with advanced hardware solutions for every need.
                </p>
            </div>
        </div>

        <!-- الشريحة الرابعة -->
        <div class="pg1-item">
            <img src="images/forhbg11.webp">
            <div class="pg1-content">
                <p>Power Meets Elegance</p>
                <h2>Components Designed to Perform</h2>
                <p>
                    Sleek, stylish, and built to power through every task.
                </p>
            </div>
        </div>

        <!-- الشريحة الخامسة -->
        <div class="pg1-item">
            <img src="images/forhbg12.jpg">
            <div class="pg1-content">
                <p>Customer-Centric</p>
                <h2>Excellence in Every Order</h2>
                <p>
                    Enjoy seamless shopping and customer support tailored to you.
                </p>
            </div>
        </div>
    </div>

    <div class="pg1-arrows">
        <button id="pg1-prev"><</button>
        <button id="pg1-next">></button>
    </div>
</div>
    </div>
</div>

<div class="Xslider" style="
        --width: 100px;
        --height: 50px;
        --quantity: 10;
    ">
        <div class="Xlist">
    <div class="Xitem" style="--position: 1">
        <a href="https://www.asus.com" target="_blank">
            <img src="images/logoasus.png" alt="ASUS Logo">
        </a>
    </div>
    <div class="Xitem" style="display: none;">
        <a href="https://www.example2.com" target="_blank">
            <img src="images/slider1_22.png" alt="Slider 1">
        </a>
    </div>
    <div class="Xitem" style="--position: 3">
        <a href="https://www.kingston.com" target="_blank">
            <img src="images/logoKingston.png" alt="Kingston Logo">
        </a>
    </div>
    <div class="Xitem" style="display: none;">
        <a href="https://www.example4.com" target="_blank">
            <img src="images/slider1_4.png" alt="Slider 4">
        </a>
    </div>
    <div class="Xitem" style="--position: 5">
        <a href="https://www.xpg.com" target="_blank">
            <img src="images/logoxpg.png" alt="XPG Logo">
        </a>
    </div>
    <div class="Xitem" style="display: none;">
        <a href="https://www.example6.com" target="_blank">
            <img src="images/slider1_6.png" alt="Slider 6">
        </a>
    </div>
    <div class="Xitem" style="--position: 7">
        <a href="https://www.bequiet.com" target="_blank">
            <img src="images/logobequiet.png" alt="Be Quiet Logo">
        </a>
    </div>
    <div class="Xitem" style="display: none;">
        <a href="https://www.example8.com" target="_blank">
            <img src="images/slider1_8.png" alt="Slider 8">
        </a>
    </div>
    <div class="Xitem" style="--position: 9">
        <a href="https://www.gskill.com" target="_blank">
            <img src="images/logootrident.png" alt="G.Skill Trident Logo">
        </a>
    </div>
    <div class="Xitem" style="display: none;">
        <a href="https://www.example10.com" target="_blank">
            <img src="images/slider1_10.png" alt="Slider 10">
        </a>
    </div>
</div>

    </div>


<!-- قسم الإحصائيات -->
<section class="statistics">
    <h2 class="section-heading">Why Choose Us?</h2>
    <div class="stats-container">
        <div class="stat-card">
            <h3 class="stat-number" data-target="<?= $products_count ?? 0; ?>">0</h3>
            <p>Products Available</p>
        </div>
        <div class="stat-card">
            <h3 class="stat-number" data-target="<?= $customers_count ?? 0; ?>">0</h3>
            <p>Happy Customers</p>
        </div>
        <div class="stat-card">
            <h3 class="stat-number" data-target="<?= $orders_count ?? 0; ?>">0</h3>
            <p>Orders Delivered</p>
        </div>
    </div>
</section>

<section class="what-we-offer">
    <h2 class="section-heading">What We Offer</h2>
    <div class="offer-container">
        <div class="offer-card">
            <i class="fas fa-box-open"></i>
            <h3>High-Quality Products</h3>
            <p>We ensure top-notch quality for all our products.</p>
        </div>
        <div class="offer-card">
            <i class="fas fa-shipping-fast"></i>
            <h3>Fast Delivery</h3>
            <p>Quick and secure delivery to your doorstep.</p>
        </div>
        <div class="offer-card">
            <i class="fas fa-headset"></i>
            <h3>24/7 Support</h3>
            <p>Our team is available to assist you anytime.</p>
        </div>
    </div>
</section>


   
    






    <div class="carousel">
    <div class="list">
        <div class="item">
            <img src="images/rampg1.webp" alt="RAM">
            <div class="introduce">
                <div class="title">RAM</div>
                <div class="topic">High-Performance Memory</div>
                <div class="des">
                Get the best performance for your device with advanced RAM memory ideal for gaming and work.                </div>
                <button class="seeMore" onclick="window.location.href='ram.php'">SEE MORE &#8599</button>
            </div>
        </div>

        <div class="item">
            <img src="images/shopmotherboard2.png" alt="Motherboard">
            <div class="introduce">
                <div class="title">Motherboards</div>
                <div class="topic">Powerful Motherboards</div>
                <div class="des">Browse our range of motherboards compatible with all modern processors for optimal performance.
                </div>
                <button class="seeMore" onclick="window.location.href='motherboards.php'">SEE MORE &#8599</button>
            </div>
        </div>

        <div class="item">
            <img src="images/casepg1.webp" alt="Case">
            <div class="introduce">
                <div class="title">Cases</div>
                <div class="topic">Stylish PC Cases</div>
                <div class="des">
                Choose from a wide range of cases to suit your device design and needs.                </div>
                <button class="seeMore" onclick="window.location.href='cases.php'">SEE MORE &#8599</button>
            </div>
        </div>

        <div class="item">
            <img src="images/psubg.png" alt="Power Supply">
            <div class="introduce">
                <div class="title">Power Supplies</div>
                <div class="topic">Reliable Power</div>
                <div class="des">
                Reliable power solutions to keep your computer running safely and efficiently.                </div>
                <button class="seeMore" onclick="window.location.href='power_supplies.php'">SEE MORE &#8599</button>
            </div>
        </div>

        <div class="item">
            <img src="images/storagepg.png" alt="Storage">
            <div class="introduce">
                <div class="title">Storage</div>
                <div class="topic">Fast and Secure</div>
                <div class="des">
                Explore fast and reliable storage solutions to improve your device's performance.                </div>
                <button class="seeMore" onclick="window.location.href='storage.php'">SEE MORE &#8599</button>
            </div>
        </div>
    </div>
    <div class="arrows">
        <button id="prev"><</button>
        <button id="next">></button>
        <button id="back" onclick="window.location.href='products.html'">See All &#8599</button>
    </div>
</div>


    <section class="sale-products">
    <h2 class="heading">Discover New Products</h2>
    <div class="swiper sale-products-slider">
        <div class="swiper-wrapper">
            <?php
            // جلب 6 منتجات عشوائية
            $select_random = $conn->prepare("SELECT * FROM `products` ORDER BY RAND() LIMIT 6");
            $select_random->execute();
            while ($fetch_product = $select_random->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="swiper-slide">
                <div class="product-card">
                    <form action="" method="post">
                        <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                        
                        <!-- أزرار المفضلة والمشاهدة -->
                        <button class="wishlist-btn fas fa-heart" type="submit" name="add_to_wishlist"></button>
                        <a href="product_detail.php?pid=<?= $fetch_product['id']; ?>" class="view-btn fas fa-eye"></a>
                        
                        <!-- صورة المنتج -->
                        <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>" class="product-image">

                        <!-- تفاصيل المنتج -->
                        <div class="product-name"><?= $fetch_product['name']; ?></div>
                        <div class="product-details">
                            <div class="product-price">
                                <span>SAR</span><?= $fetch_product['price']; ?><span>/-</span>
                            </div>
                            <input type="number" name="qty" class="quantity-input" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                        </div>
                        <input type="submit" value="Add to Cart" class="add-to-cart-btn" name="add_to_cart">
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<!-- قسم الشهادات -->
<section class="testimonials">
    <h2 class="section-heading">What Our Customers Say</h2>
    <div class="testimonials-container">
        <?php if ($select_testimonials->rowCount() > 0): ?>
            <?php while ($testimonial = $select_testimonials->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="testimonial-card">
                    <p>"<?= htmlspecialchars($testimonial['comment']); ?>"</p>
                    <h4>- <?= htmlspecialchars($testimonial['name']); ?></h4>
                    <small><?= date('F j, Y', strtotime($testimonial['created_at'])); ?></small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No testimonials available yet. Be the first to leave a comment!</p>
        <?php endif; ?>
    </div>

    <?php if ($user_id): ?>
        <form method="POST" class="testimonial-form">
            <textarea name="comment" placeholder="Write your comment here..." required></textarea>
            <button type="submit" name="add_testimonial">Submit</button>
        </form>
    <?php else: ?>
        <p>Please <a href="user_login.php">login</a> to write a testimonial.</p>
    <?php endif; ?>
</section>



<!-- Footer -->
<?php include 'components/footer.php'; ?>

<script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
  ></script>
  <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
  ></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.1.0/typed.umd.js" integrity="sha512-+2pW8xXU/rNr7VS+H62aqapfRpqFwnSQh9ap6THjsm41AxgA0MhFRtfrABS+Lx2KHJn82UOrnBKhjZOXpom2LQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/script.js"></script>
<script src="js/slider.js"></script>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const stats = document.querySelectorAll(".stat-number");
    const observerOptions = {
        threshold: 0.5, // يبدأ العداد عند ظهور العنصر بنسبة 50%
    };

    const startCounting = (statElement) => {
        const target = parseInt(statElement.dataset.target, 10); // القيمة النهائية
        let currentValue = 0;

        const updateCounter = () => {
            if (currentValue < target) {
                currentValue += Math.ceil(target / 100);
                statElement.textContent = currentValue;
                setTimeout(updateCounter, 20); // تحديث العد
            } else {
                statElement.textContent = target; // التأكد من القيمة النهائية
            }
        };

        updateCounter();
    };

    const observerCallback = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                startCounting(entry.target);
                observer.unobserve(entry.target); // منع التكرار
            }
        });
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);
    stats.forEach((stat) => observer.observe(stat));
    
});



</script>






</body>
</html>
