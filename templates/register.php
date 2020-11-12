<?=$view->partial('partials/header')?>

<div class="row justify-content-center" style="padding-top: 10rem">
    <div class="col-4">
        <form class="form-signin" method="post" action="/register">
            <h1 class="h3 mb-3 font-weight-normal">Register</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>

            <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
            <input type="password" id="inputConfirmPassword" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
            
            <button class="btn btn-lg btn-primary btn-block mt-5" type="submit">Register</button>
        </form>
    </div>
</div>

<?=$view->partial('partials/footer')?>
