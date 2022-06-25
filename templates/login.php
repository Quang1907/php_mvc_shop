<?php
include __DIR__ . '/inc/header.php';
include __DIR__ . '/inc/navbar.php'
?>
<section class="container mt-5" id="loginForm">
    <div class="row">
        <div class="col-sm-4 mx-auto">
            <h2 class="text-center">LOGIN</h2>
            <form method="post" action="">
                <?php if ($hasErrors) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($errors as $errorsMessage) : ?>
                            <strong><?= $errorsMessage ?></strong><br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="text" id="form2Example1" class="form-control" name="username" value="<?= $username ?>" />
                    <label class="form-label" for="form2Example1">Username </label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="form2Example2" class="form-control" name="password" />
                    <label class="form-label" for="form2Example2">Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submmit" class="btn btn-primary btn-block mb-4">Sign in</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                    <p>or sign up with:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/inc/footer.php' ?>