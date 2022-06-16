<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-white" href="homepage">Todo</a>

    <ul class="navbar-nav mr-auto">    
        <li class="nav-item">
            <a class="nav-link text-white">Make board</a>
        </li>
    </ul>

    <form>
        <input class="form-control" type="search" placeholder="Search" />
    </form>

    <div class="btn-group">
        <button type="button" class="btn btn-secondary bg-danger rounded-circle d-flex justify-content-center ml-2 mr-3 text-uppercase" id="accounts-info" style="height:40px; width:40px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">    
            <?= $_SESSION['email'][0]; ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="accounts-info">
            <a class="text-dark text-decoration-none" href="settings">Settings</a>
        
            <div class="dropdown-divider"></div>
            
            <a class="text-dark text-decoration-none" href="logout">Log out</a>
        </div>
    </div>
</nav>