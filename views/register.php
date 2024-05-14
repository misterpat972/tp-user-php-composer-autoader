<div class="container mt-5">
    <h2 class="text-center p-4">Formulaire d'Inscription</h2>
    <form class="mb-4" action="/register-submit" method="post">
        <div class="row">
            <div class="form-group
            col-md-6">
                <label for="name">Nom :</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group
            col-md-6">
                <label for="firstname">Prénom :</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
        </div>
        <div class="form-group
        ">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="row">
            <div class="form-group
            col-md-6">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group col-md-6">
                <label for="passConfirm">Confirmer votre mot de passe :</label>
                <input type="password" class="form-control" id="passConfirm" name="passConfirm" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>
