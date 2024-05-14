<div class="container my-5">
    <h2 class="text-center p-4">Bienvenue  - <?= $_SESSION['user']['nom'] ?></h2>
    <form action="/pdfdownload" method="post" enctype="multipart/form-data">
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
        <button type="submit" class="btn btn-danger">Télécharger ma fiche en PDF</button>
    </form>

    <h2 class="text-center p-4">Envoyer mes informations par mail</h2>
    <form action="/sendPdfByEmail" method="post" class="mt-4">
        <div class="form-group">
            <label for="subject">Sujet :</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>

        <div class="form-group">
            <label for="content">Message :</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Envoyer par mail</button>
    </form>
</div>

