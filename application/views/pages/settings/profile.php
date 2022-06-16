    <h3 class="h5">ABOUT</h3>
    <hr />

    <div class="w-75">
        <?= form_open("profile_submit"); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value=<?= $username ?> />
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" name="bio" id="bio"><?= $bio ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-5">Submit</button>
        </form>
    </div>
</div>
