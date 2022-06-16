<div class="text-center container">
    <h1 class="my-4">Login</h1>
    <div class="border border-dark px-5 pt-5">
        <?= form_open("login"); ?>
            <span class="text-danger float-left"><?= $email_error ?></span>
            <input class="w-100 py-2 mb-4" type="text" name="email" value="<?= $email ?>" placeholder="Enter email" />
            
            <span class="text-danger float-left"><?= $password_error ?></span>
            <input class="w-100 py-2 mb-5" type="password" name="password" value="<?= $password ?>" placeholder="Enter password" />
            
            <button class="w-100 btn btn-success" type="submit">Login</button>
        </form>
        <hr />
        <a href="signup">Sign up for an account</a>
    </div>
</div>