<div style="margin: 0px 20%;">
    <h1 class="text-center my-4">Do you really want to delete your account?</h1>
        <?= form_open("delete-account"); ?>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-danger btn-block" name="yes">Yes</button>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-success btn-block" name="no">No</button>
                </div>
            </div>
        </form>
    </div>
</div>