<?php
require_once 'functions.php';
$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = inputCleaning('firstname');
    $email = inputCleaning('email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Email is not valid!";
    };
    $password = inputCleaning('password');
    $confirmpassword = inputCleaning('confirmpassword');
    if ($password === $confirmpassword) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $error['confirmpassword'] =  "the password is not the same!";
    }

    $query = "SELECT * FROM admin WHERE email=:email";

    $data = $pdo->prepare($query);
    $data->bindValue(':email', $email, PDO::PARAM_STR);
    $data->execute();

    if ($data->rowCount() > 0) {
        $error['emaildb'] =  "The email already exists in the database";
    }



    if (count($error) == 0) {
        $query3 = "INSERT INTO `admin`(  `firstname`, `email`, `password` ) VALUES (:firstname, :email, :password)";
        $req = $pdo->prepare($query3);
        $req->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->bindParam(':password', $password, PDO::PARAM_STR);
        $result = $req->execute();

        if ($result) {
            echo "You've been registered successfully";
            header('Location: login.php');
        }
    } else {
        var_dump($error);
    }
}

?>
<?php require_once 'partials/header.php' ?>

<div class="container">

    <main class="form-signin w-100 m-auto">
        <h1 class="h3 mb-3 fw-normal text-center">
            Inscrivez-vous
        </h1>

        <form class="p-5" method="POST" enctype="multipart/form-data">
            <div class="info mb-3 row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="firstname" id="firstname" class="form-control form-control-lg form-control form-control-lg-lg" placeholder="Entrez votre prénom">
                        </div>
                        <div id="helpBlock" class="form-text"> <?= isset($error['empty']) ? $error['empty']  : "" ?></div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Entrez votre mot de passe">
                        </div>
                        <div id="helpBlock" class="form-text"><?= isset($error['empty']) ? $error['empty']  : "" ?></div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="Entrez votre email">
                        </div>
                        <div id="helpBlock" class="form-text"><?= isset($error['empty']) ? $error['empty']  : "" ?><?= isset($error['email']) ? $error['email']  : "" ?> <?= isset($error['emaildb']) ? $error['emaildb']  : "" ?></div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="confirmpassword" id="confirm-password" class="form-control form-control-lg" placeholder="Confirmez votre mot de passe">
                        </div>
                        <div id="helpBlock" class="form-text"><?= isset($error['empty']) ? $error['empty']  : "" ?><?= isset($error['confirmpassword']) ? $error['confirmpassword']  : "" ?></div>
                    </div>
                </div>
            </div>

            <div class="d-flex mb-3">
                Déjà inscrit ? <a href="login.php" class="text-decoration-none text-dark mx-1"> Connectez-vous</a>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">
                S'inscrire
            </button>
        </form>

    </main>

</div>



<?php require_once 'partials/footer.php' ?>