<?=$view->partial('partials/header')?>

<div class="d-flex text-center" style="height:100%; align-items: center">
    <div class="row" style="margin: auto">
        <div class="col-sm">
            <h1>Welcome to Stack!</h1>
        </div>
        <div class="col-sm">
            <form class="form-signin" method="post" action="/login">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block mt-5" type="submit">Sign in</button>
            </form>
            <div class="mt-5">
                <p>You don't have an account?</p>
                <a href="/register" class="btn btn-lg btn-success btn-block" type="submit">Register</a>
            </div>
        </div>
    </div>
</div>

<?=$view->partial('partials/footer')?>
