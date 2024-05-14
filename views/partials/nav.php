<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/account">Mon compte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Déconnexion</a>
            </li>
            <?php else : ?>
            <li class="nav-item active">
                <a class="nav-link" href="/login">Se connecter | Inscription</a>
            </li>
           <?php endif; ?>
        </ul>
    </div>
</nav>