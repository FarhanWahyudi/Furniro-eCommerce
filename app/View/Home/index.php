<!-- NAVBAR -->
<div class='navbar-container'>
    <div class='logo-container'>
        <img src="/Assets/Furniro-logo.png" alt="logo">
        <h3>Furniro</h3>
    </div>
    <div class='link-container'>
        <ul>
            <li>Home</li>
            <li>Shop</li>
            <li>About</li>
            <li>Contact</li>
        </ul>
    </div>
    <div class='icon-container'>
        <ul>
            <li>
                <img src="/Assets/Icons/account.png" alt="account">
            </li>
            <li>
                <img src="/Assets/Icons/search.png" alt="search">
            </li>
            <li>
                <img src="/Assets/Icons/heart.png" alt="heart">
            </li>
            <li>
                <img src="/Assets/Icons/shopping-cart.png" alt="shopping-cart">
            </li>
        </ul>
    </div>
</div>

<!-- BANNER -->
<div class="banner-container">
    <div class="banner">
        <div class="info">
            <h4>New Arrival</h4>
            <h1>Discover Our<br/> New Collection</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae, ratione? Temporibus quam delectus non provident.</p>
        </div>
        <button class="banner-button">BUY NOW</button>
    </div>
</div>

<!-- BROWSE -->
<div class="browse-container">
    <div class="container">
        <div class="title">
            <h1>Browse The Range</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
        </div>
        <div class="browse">
            <div class="album">
                <img src="Assets/Browse/dining-room.png" alt="dining room">
                <h3>Dining</h3>
            </div>
            <div class="album">
                <img src="Assets/Browse/living-room.png" alt="living room">
                <h3>Living</h3>
            </div>
            <div class="album">
                <img src="Assets/Browse/bedroom.png" alt="bedroom">
                <h3>Bedroom</h3>
            </div>
        </div> 
    </div>
</div>

<!-- FEATURED PRODUCTS -->
 <div class="products-container">
    <div class="container">
        <h1>Our Products</h1>
        <div class="products">
            <?php foreach($model['products'] as $product) { ?>
                <div class="card">
                    <div class="img-container">
                        <img src="/Assets/dummy-product.png" alt="product">
                        <?php if ($product['discount_price']) { ?>
                            <div class="label">-<?= number_format((($product['price'] - $product['discount_price']) / $product['price']) * 100, 0) ?>%</div>
                        <?php } ?>
                    </div>
                    <div class="desc">
                        <h3><?= $product['product_name'] ?></h3>
                        <p><?= $product['category_name'] ?></p>
                        <div class="price">
                            <h4>Rp <?= $product['price'] ?></h4>
                            <?php if ($product['discount_price']) { ?>
                                <h5>Rp <?= $product['discount_price'] ?></h5>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="pop-up">
                        <button>Add to cart</button>
                        <div class="links">
                            <div class="link">
                                <img src="/Assets/Popup/share.png" alt="share">
                                <p>Share</p>
                            </div>
                            <div class="link">
                                <img src="/Assets/Popup/compare.png" alt="compare">
                                <p>Compare</p>
                            </div>
                            <div class="link">
                                <img src="/Assets/Popup/heart.png" alt="heart">
                                <p>Like</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="card">
                <div class="img-container">
                    <img src="/Assets/dummy-product.png" alt="product">
                    <div class="label">-50%</div>
                </div>
                <div class="desc">
                    <h3>Syltherine</h3>
                    <p>Stylish cafe chair</p>
                    <div class="price">
                        <h4>Rp 2.500.000</h4>
                        <h5>Rp 3.500.000</h5>
                    </div>
                </div>
                <div class="pop-up">
                    <button>Add to cart</button>
                    <div class="links">
                        <div class="link">
                            <img src="/Assets/Popup/share.png" alt="share">
                            <p>Share</p>
                        </div>
                        <div class="link">
                            <img src="/Assets/Popup/compare.png" alt="compare">
                            <p>Compare</p>
                        </div>
                        <div class="link">
                            <img src="/Assets/Popup/heart.png" alt="heart">
                            <p>Like</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="show-button">Show More</button>
    </div>
 </div>

 <!-- FOOTER -->
  <div class="footer-container">
    <div class="container">
        <div class="footer">
            <div class="brand-info">
                <h2>Furniro.</h2>
                <p>400 University Drive Suite 200 Coral Gables,</br>
                FL 33134 USA</p>
            </div>
            <div class='links-container'>
                <div class="links">
                    <p>Links</p>
                    <ul>
                        <li>Home</li>
                        <li>Shop</li>
                        <li>About</li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
            <div class='help-container'>
                <div class="help">
                    <p>Help</p>
                    <ul>
                        <li>Payment Options</li>
                        <li>Returns</li>
                        <li>Privacy Policies</li>
                    </ul>
                </div>
            </div>
            <div class="newsletter-container">
                <div class="newsletter">
                    <p>Newsletter</p>
                    <div class="input">
                        <input type="email" placeholder="Enter Your Email Address">
                        <button>SUBSCRIBE</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <h5>2024 furniro. All rights reverved</h5>
        </div>
    </div>
  </div>