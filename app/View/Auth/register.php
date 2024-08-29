<div class="box-container">
    <div class="img">
        <img src="/Assets/Auth/web-shopping.png" alt="">
    </div>
    <div class="login-container">
        <div class="login">
            <div class="title">
                <h1>Sign Up</h1>
                <p>Hello! let's join with us</p>
            </div>
            <form method="post" action="/register">
                <div class="form">
                    <i class="fa-solid fa-envelope"></i>
                    <input name="email" type="email" placeholder="Email">
                </div>
                <div class="form">
                    <i class="fa-solid fa-key"></i>
                    <input name="password" type="password" placeholder="Password">
                </div>
                <div class="form">
                    <i class="fa-solid fa-key"></i>
                    <input name="confirmPassword" type="password" placeholder="Confirm Password">
                </div>
                <?php if (isset($model['error'])) { ?>
                    <p class="error"><?= $model['error'] ?></p>
                <?php } ?>
                <button type="submit">Sign Up</button>
            </form>
            <p class="signup-link">You already have an account? <a href="/login">Sign In</a></p>
        </div>
    </div>
</div>