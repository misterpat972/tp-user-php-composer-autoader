<div class="container my-5">
    <h2 class="text-center p-4">Bienvenue  - Administrateur <?= $_SESSION['user']['nom'] ?></h2>
    <form action="update_user.php" method="post" enctype="multipart/form-data">
        <div class="form-group
            ">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $_SESSION['user']['nom'] ?>" required>
        </div>
        <div class="form-group           ">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $_SESSION['user']['prenom'] ?>" required>
        </div>
        <div class="form-group
         ">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" required>
        </div>
    </form>
<div class="row">
        <div class="col-6">
           <a href="/pdfdownload" class="btn btn-danger w-100">Télécharger ma fiche en PDF</a>
        </div>
        <div class="col-6">
            <a href="/allusersexport" class="btn btn-success w-100">Exporter les utilisateurs</a>
        </div>
    </div>
</div>

