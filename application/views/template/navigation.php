<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-white" href="homepage">Todo</a>

    <ul class="navbar-nav mr-auto">    
        <li class="nav-item">
            <a class="nav-link text-white" href="">Make board</a>
        </li>
    </ul>

    <form>
        <input class="form-control" type="search" placeholder="Search">
    </form>

    <div class="bg-danger rounded-circle d-flex justify-content-center ml-2 mr-3" style="height:40px; width:40px;">
        <p class="mt-2 text-uppercase text-white"><?= $_SESSION['email'][0]; ?></p>
    </div>
</nav>