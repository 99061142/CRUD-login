<div class="text-center container">
    <h1 class="my-4">Sign up</h1>
    <div class="border border-dark px-5 pt-5">
        <?= form_open("signup"); ?>
            <span class="text-danger float-left"><?= $email_error ?></span>
            <input class="w-100 py-2 mb-4" type="text" name="email" value="<?= $email ?>" placeholder="Enter email" />
            
            <span class="text-danger float-left"><?= $username_error ?></span>
            <input class="w-100 py-2 mb-4" type="text" name="username" value="<?= $username ?>" placeholder="Enter username" />
            
            <span class="text-danger float-left"><?= $password_error ?></span>
            <input class="w-100 py-2 mb-5" type="password" name="password" value="<?= $password ?>" placeholder="Enter password" />

            <button class="w-100 btn btn-success" type="submit">Sign up</button>
        </form>
        <hr />
        <a href="login">Already have an account? Log In</a>
    </div>
</div>