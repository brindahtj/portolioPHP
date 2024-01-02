<?php
require_once 'functions.php';
define('URL', " http://localhost/PHP/portfolio/img");
define('BASE', $_SERVER['DOCUMENT_ROOT'] . '/PHP/portfolio/img/');
$error = [];


if (!empty($_GET)) {
    $id = $_GET['id'];
    if ($_GET['action'] == 'edit') {

        $sql = "SELECT * FROM projets WHERE id_projet= :id_projet";
        $req = $pdo->prepare($sql);
        $req->bindParam(':id_projet', $id, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch();
        var_dump($result);

        if ($req->rowCount() == 0) {

            header('Location: admin.php');
        } else {

            if (isset($_POST['submit'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $titre = inputCleaning('titre');
                    $description = inputCleaning('description');
                    $lien = inputCleaning('lien');
                    $langage = implode(",", $_POST["langage"]);

                    $img = '';

                    if (!empty($_FILES['photo']['name'])) {
                        $img = $_FILES['photo']['name'];
                        var_dump($img);
                        $image = time() . '-' . rand(1, 9999) . '-' . bin2hex(random_bytes(8)) . '-' . $img;
                        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                        $ext = strtolower($ext);
                        $tabExtension = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'webp'];
                        if (in_array($ext, $tabExtension)) {

                            // je verifie que le fichier ne dépasse 8 Mo
                            if ($_FILES['photo']['size'] <= 8000000) {
                                move_uploaded_file($_FILES['photo']['tmp_name'], BASE . $image);
                            } else {
                                $error['img'] = "photo must be smaller to 8Mo ";
                            }
                        } else {
                            $error['ext'] =  "the extension is not valid.";
                        }
                    }


                    if (empty($_GET)) {
                        if (count($error) == 0) {
                            $query1 = "UPDATE `projets` SET `titre`=:titre,`description`=:description,`langage`=:langage,`image`=:image,`lien`=:lien WHERE id_projet=:id_projet";
                            $req = $pdo->prepare($query1);
                            $req->bindParam(':titre', $titre, PDO::PARAM_STR);
                            $req->bindParam(':description', $description, PDO::PARAM_STR);
                            $req->bindParam(':langage', $langage, PDO::PARAM_STR);
                            $req->bindParam(':image', $image, PDO::PARAM_STR);
                            $req->bindParam(':lien', $lien, PDO::PARAM_STR);
                            $req->bindParam(':id_projet', $id, PDO::PARAM_INT);
                            $result = $req->execute();

                            if ($result) {
                                echo "The product have been edited successfully";
                            }
                        } else {
                            var_dump($error);
                        }
                    }
                }
            } elseif ($_GET['action'] == 'delete') {


                $sql3 = "SELECT * FROM projet WHERE id_projet= :id_projet";
                $req = $pdo->prepare($sql3);
                $req->bindParam(':id_projet', $id, PDO::PARAM_INT);
                $result3 = $req->execute();
                if ($req->rowCount() == 0) {
                    header('Location: admin.php');
                } else {
                    $sql4 = "DELETE FROM `projet` WHERE id_projet=:id_projet";
                    $req = $pdo->prepare($sql4);
                    $req->bindParam(':id_projet', $id, PDO::PARAM_INT);
                    $result4 = $req->execute();
                    if ($result4) {
                        echo "The product have been deleted successfully";
                    }
                }
            }
        }
    }
}


?>
<?php
require_once 'partials/header.php'
?>
<div class="content">
    <h2 class="text-center">Modifier un projet</h2>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre du projet" value="<?= !empty($result['titre']) ? $result['titre'] : "" ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Description du projet"><?= !empty($result['description']) ? $result['description'] : "" ?></textarea>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                <input type="text" name="lien" class="form-control" id="lien" placeholder="Lien du projet" value="<?= !empty($result['lien']) ? $result['lien'] : "" ?>">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="langage[]" value="react" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    <i class="fa-brands fa-react "></i> React
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="langage[]" value="html" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    <i class="fa-brands fa-html5 "></i> HTML
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="langage[]" value="php" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    <i class="fa-brands fa-php "></i> PHP
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="langage[]" value="css" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    <i class="fa-brands fa-css3 "></i> CSS
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="langage[]" value="js" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    <i class="fa-brands fa-js "></i> Javascript
                </label>
            </div>
            <div class="input-group mb-3">
                <input type="file" name="photo" class="form-control" id="photo">
                <img src="img/<?= !empty($result['image']) ? $result['image'] : "" ?>" alt="<?= !empty($result['titre']) ? $result['titre'] : "" ?>" width="100px" height="100px">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Modifier le projet</button>
        </form>
        <!-- Tableau des projets -->
        <h2 class="text-center mt-5">Liste des projets</h2>
        <table class="table table-responsive table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>

                    <th>Titre</th>
                    <th>Description</th>
                    <th>Langages</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $pdo->query("SELECT * FROM projets");
                $product = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($product as $key => $data) : ?>

                    <tr>
                        <td><?= $data['titre'] ?></td>
                        <td><?= $data['description'] ?></td>
                        <td><?= $data['langage'] ?></td>
                        <td><img src="img/<?= $data['image'] ?>" alt=" <?= $data['titre'] ?>" width="100" class="img-fluid"></td>
                        <td>
                            <a href="edit.php?action=edit&id=<?= $data['id_projet'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="edit.php?action=delete&id=<?= $data['id_projet'] ?>" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash3"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>

    </div>
</div>
<!-- Fin du contenu du tableau de bord -->
<?php require_once 'partials/footer.php' ?>