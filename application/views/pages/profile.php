    <h3 class="h5">ABOUT</h3>
    <hr />

    <div class="w-75">
        <?= form_open(""); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" />
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea class="form-control" id="bio"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-5">Submit</button>
        </form>
    </div>
</div>
