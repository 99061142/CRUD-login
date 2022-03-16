<div style="margin: 0px 25%;">
    <div class="d-flex justify-content-center my-5">
        <div class="btn btn-secondary bg-danger rounded-circle justify-content-center ml-2 mr-3 text-uppercase" id="accounts-info" style="height:60px; width:60px; font-size:20px; padding: 15px 0px;">    
            <?= $_SESSION['email'][0]; ?>
        </div>
        <p class="mt-3 font-weight-bold">@<?= $username ?></p>
    </div>

    <div class="">
        <ul class="list-unstyled font-weight-bold d-flex justify-content-around">
            <li>
                <a class="border border-dark py-1 px-4 text-decoration-none text-dark" href="profile">PROFILE</a>
            </li>
            </li>
                <a class="border border-dark py-1 px-4 text-decoration-none text-dark" href="settings">SETTINGS</a>
            </li>
        </ul>
    </div>