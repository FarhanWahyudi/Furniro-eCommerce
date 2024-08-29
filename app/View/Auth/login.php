<div class="box-container">
    <div class="img">
        <img src="/Assets/Auth/web-shopping.png" alt="">
    </div>
    <div class="login-container">
        <div class="login">
            <div class="title">
                <h1>Welcome<br>Back</h1>
                <p>Hey! Good to see you again</p>
            </div>
            <form method="post" action="/login">
                <div class="form">
                    <i class="fa-solid fa-envelope"></i>
                    <input name="email" type="email" placeholder="Email">
                </div>
                <div class="form">
                    <i class="fa-solid fa-key"></i>
                    <input name="password" type="password" placeholder="Password">
                </div>
                <?php if (isset($model['error'])) { ?>
                    <p class="error"><?= $model['error'] ?></p>
                <?php } ?>
                <button type="submit">Sign In</button>
            </form>
            <p class="signup-link">Don't have an account? <a href="/register">Sign Up</a></p>
        </div>
    </div>
</div>