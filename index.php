<?php require_once 'partials/header.php' ?>

<div class="row">
    <div class="col-4 d-flex flex-column justify-content-center align-items-end"> Bonjour, je m'appelle
        <h1 class=" ms-5 my-3" id="presentation"><span class="txt-rotate" data-period="2000" data-rotate='[ "Brinda Hountondji" ]'></span></h1>
        <h2 class="ms-5 mb-5">Developpeuse WEB</h2>
    </div>
    <div class="col-8">
        <div class="d-flex justify-content-center"><img src="img/bh.png" style="width: 40%; border-radius: 100%;"></div>
    </div>
</div>
<div class="ms-5  ">
    <div class="d-flex">
        <div class="mb-3 button"><i class="fa-solid fa-mobile-screen-button fa-xl mx-2 "></i> 0684008368</div>
        <div class="mb-3 button"><a href="mailto:brinda.hount@hotmail.com"><i class="fa-solid fa-envelope fa-xl mx-2"></i>Email me!</a></div>
        <div class="mb-3 button"><i class="fa-solid fa-location-dot fa-xl mx-2"></i> 91300, Massy</div>
        <a class="mb-3 button" target="_blank" href="https://github.com/brindahtj"><i class="fa-brands fa-github fa-xl me-2"></i> Github</a>
        <a class='mb-3 button' href="https://www.linkedin.com/in/brinda-hountondji/"><i class="fa-brands fa-linkedin fa-xl me-2"></i> Linkedin</a>
    </div>
</div>
<div>
    <div class="d-flex justify-content-center my-5">
        <h2 id="competences">Skills</h2>
    </div>
    <div class="row">
        <div class="col d-flex flex-column align-items-center">
            <h4> Design</h4>
            <ul>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-figma "></i> Figma</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-bootstrap "></i>Bootstrap</li>
            </ul>
        </div>
        <div class="col d-flex flex-column align-items-center">
            <h4> Front-end</h4>
            <ul>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-react "></i> React</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-react "></i> React Native</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-html5 "></i> HTML</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-css3-alt "></i> CSS</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-sass "></i> Sass</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-js "></i> JavaScript</li>
            </ul>
        </div>
        <div class="col d-flex flex-column align-items-center">
            <h4 class=""> Back-end</h4>
            <ul>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-php "></i> PHP</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-symfony "></i> Symfony</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-angular "></i> Angular</li>
            </ul>
        </div>
        <div class="col d-flex flex-column align-items-center">
            <h4> Other</h4>
            <ul>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-wordpress"></i> WordPress</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-github"></i> Github</li>
                <li class="button button__color button__color--smaller"><i class="fa-solid fa-caret-up fa-xl "></i> Vercel</li>
            </ul>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center my-5">
    <h2 id="projets">Projets</h2>
</div>
<?php
$query = $pdo->query("SELECT * FROM projets");
$product = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row d-flex ">
    <?php foreach ($product as $key => $data) : ?>

        <div class="col d-flex  flex-column align-items-center"><a href="<?= $data['lien'] ?>"><img class="img-project" src="img/<?= $data['image'] ?>" alt=""></a>
            <div>
                <h4><?= $data['titre'] ?></h4>
                <span><?= substr($data['description'], 0, 30) . "<a href='#'> Lire la suite</a>" ?></span>
                <?php $langages = explode(",", $data['langage']); ?>
                <ul class="d-flex ">
                    <?php foreach ($langages as $key => $langage) : ?>
                        <li class="button button__color button__color--smaller"><i class="fa-brands fa-<?= $langage ?> "></i> <?= $langage ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    <?php endforeach ?>

    <!-- 
    <div class="col d-flex flex-column align-items-center"><a href="https://radom-meal2.vercel.app/"> <img class="img-project" src="img/randomMeal.png" alt=""></a>
        <div>
            <h4>Generateur de recette aleatoire</h4>
            <ul class="d-flex ">
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-html5 "></i> HTML</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-css3-alt "></i> CSS</li>
                <li class="button button__color button__color--smaller"><i class="fa-brands fa-js "></i> JavaScript</li>
            </ul>
        </div>
    </div>
    </div>
    <div class=" row more">
        <div class="col d-flex flex-column align-items-center"><a href="https://frontend-mentor-1-seven.vercel.app/"><img class="img-project" src="img/frontendmentor.png" alt=""></a>
            <div>
                <h4>Exemple de carte produit</h4>
                <ul class="d-flex ">
                    <li class="button button__color button__color--smaller"><i class="fa-brands fa-html5 "></i> HTML</li>
                    <li class="button button__color button__color--smaller"><i class="fa-brands fa-css3-alt "></i> CSS</li>
                </ul>
            </div>
        </div>
        <div class="col-4 d-flex flex-column align-items-center"><a href="https://countries-api-dusky-nu.vercel.app/"><img class="img-project" src="img/countries.png" alt=""></a>
            <div>
                <h4>Site d'infos general des pays</h4>
                <ul class="d-flex ">
                    <li class="button button__color button__color--smaller"><i class="fa-brands fa-html5 "></i> HTML</li>
                    <li class="button button__color button__color--smaller"><i class="fa-brands fa-css3-alt "></i> CSS</li>
                    <li class="button button__color button__color--smaller"><i class="fa-brands fa-css3-alt "></i> JS</li>
                </ul>
            </div>
        </div>
        <div class="col-4 d-flex flex-column align-items-center"><a href="https://brindahtj.github.io/bootstrapBeginner/bootstrap.html"><img class="img-project" src="img/bootstrap.png" alt=""></a>
            <div>
                <h4>Site e-commerce bootstrap</h4>
                <ul class="d-flex ">
                    <li class="button button__color button__color--smaller"><i class="fa-brands fa-html5 "></i> Bootstrap</li>
                </ul>
            </div>
        </div>
        <div class="col-4 d-flex flex-column align-items-center"><a href="https://moviz-nine.vercel.app/"><img class="img-project" src="img/moviz.png" alt=""></a>
            <div>
                <h4>Site de films</h4>
                <ul class="d-flex ">
                    <li class="button button__color button__color--smaller"><i class="fa-brands fa-react "></i> React</li>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="d-flex justify-content-center">
        <button class="button btn-more">More</button>
        <button class="button  hidden btn-less">Less</button>
    </div>


    <?php require_once 'partials/footer.php' ?>