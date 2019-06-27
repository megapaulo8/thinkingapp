<?php
    session_start();
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['name']) == true)){
        session_destroy();
        header('Location: ./../../../');
    }
    require_once './../../procedures/classes/product.php';
    $products = new Product();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Thinking APP | Pensando no SEU futuro</title>
    <link rel="icon" type="image/x-icon" href="./../../../assets/Logo_THINKING.png" />
    <link href="./style.css" rel="stylesheet" />
</head>
<body>
    <div class="toolbar__wrapper">
        <img src="./../../../assets/vetor_lamp.png" class="toolbar__img"/>
    </div>
    <div class="content__wrapper">
        <p class="content__wrapper--title">Gerencie seu Estoque</p>
        <hr class="content__wrapper--line" />
        <div class="cards__wrapper">
            <div class="card__wrapper">
                <p class="card__wrapper--amount"><?php $type = 'food'; echo $products->getProductsTotal($type); ?></p>
                <p class="card__wrapper--typeprod">Alimentos</p>
                <button class="card__wrapper--view" onclick="location.href='./../view_prod/?type=food';">Visualizar</button>
            </div>
            <div class="card__wrapper">
                <p class="card__wrapper--amount"><?php $type = 'procedural_material'; echo $products->getProductsTotal($type); ?></p>
                <p class="card__wrapper--typeprod">Materiais de Procedimento</p>
                <button class="card__wrapper--view" onclick="location.href='./../view_prod/?type=procedural_material';">Visualizar</button>
            </div>
            <div class="card__wrapper">
                <p class="card__wrapper--amount"><?php $type = 'medicine'; echo $products->getProductsTotal($type); ?></p>
                <p class="card__wrapper--typeprod">Medicamentos</p>
                <button class="card__wrapper--view" onclick="location.href='./../view_prod/?type=medicine';">Visualizar</button>
            </div>
            <div class="card__wrapper">
                <img class="card__wrapper--img" src="./../../../assets/graphics.png" />
                <p class="card__wrapper--text--graphics">Gerar Relatório</p>
                <button class="card__wrapper--view" onclick="location.href='./../report';">Gerar</button>
            </div>
        </div>
    </div>
    <div class="footer__wrapper">
        <a href="./../plus_prod/" class="footer__wrapper--link">
            <img class="footer__wrapper--button" src="./../../../assets/plus-button.png" />
            <p class="footer__wrapper--text">Produto</p>
        </a>
        <a href="./../less_prod/" class="footer__wrapper--link">
            <img class="footer__wrapper--button" src="./../../../assets/minus.png" />
            <p class="footer__wrapper--text">Produto</p>
        </a>
        <a href="./../profile/" class="footer__wrapper--link">
            <img class="footer__wrapper--button" src="./../../../assets/user.png" />
            <p class="footer__wrapper--text">Perfil</p>
        </a>
    </div>
</body>

</html>