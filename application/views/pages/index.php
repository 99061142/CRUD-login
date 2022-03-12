<div class="text-center container">
    <h1 class="my-4"><?= $form_title; ?></h1>
    <div class="border border-dark px-5 pt-5">
        <?= form_open("form_submit/{$form_submit}"); ?>
            <input class="w-100 py-2" type="text" name="email" value="<?= $email ?>" placeholder="Enter email" required />
            <input class="w-100 py-2 my-5" type="password" name="password" value="<?= $password ?>" placeholder="Enter password" required />
            <button class="w-100 btn btn-success" type="submit"><?= $form_title; ?></button>
        </form>
        <hr />
        <a href="<?= $form_href; ?>"><?= $form_href_text; ?></a>
    </div>
</div>