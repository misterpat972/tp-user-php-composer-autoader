<div class="container col-6 mt-4">
    <h2>Connexion</h2>
    <form class="" method="POST" action="/login-submit">
        <div class="form-group">
            <label for="username">Mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <a href="/register">Pas encore inscrit ?</a>
    </form>
</div>
