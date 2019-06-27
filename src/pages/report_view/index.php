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
        <a href="./../home/"><img class="back" src="./../../../assets/arrow.png" /></a>
        <img src="./../../../assets/vetor_lamp.png" class="toolbar__img"/>
    </div>
    <div class="content__wrapper">
        <p class="content__wrapper--title">Visualizar Relatórios</p>
        <hr class="content__wrapper--line" />
        <div class="cards__wrapper">
            <div class="card__wrapper">
                <img class="card__wrapper--img" src="./../../../assets/graphics.png" />
                <p class="card__wrapper--text--graphics">Relatório Diário</p>
                <button class="card__wrapper--view" onclick="location.href='./../report';">Gerar</button>
            </div>
            <div class="card__wrapper">
                <img class="card__wrapper--img" src="./../../../assets/graphics.png" />
                <p class="card__wrapper--text--graphics">Relatório Semanal</p>
                <button class="card__wrapper--view" onclick="location.href='./../report';">Gerar</button>
            </div>
            <div class="card__wrapper">
                <img class="card__wrapper--img" src="./../../../assets/graphics.png" />
                <p class="card__wrapper--text--graphics">Relatório Mensal</p>
                <button class="card__wrapper--view" onclick="location.href='./../report';">Gerar</button>
            </div>
            <div class="card__wrapper">
                <img class="card__wrapper--img" src="./../../../assets/graphics.png" />
                <p class="card__wrapper--text--graphics">Relatório Anual</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementsByClassName("line-chart");
        var chartGraph = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                datasets: [{
                    label: "TAXA DE CLIQUES - 2017",
                    data: [5,10,5,14,20,15,6,14,8,12,15,5,10],
                    borderWidth: 6,
                    borderColor: 'rgba(77,166,253,0.85)',
                    backgroundColor: 'transparent'
                }]
            }
        });
    </script>
</body>

</html>