<?php 
    session_start();
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['name']) == true)){
        session_destroy();
        header('Location: ./../../../');
    }
    require_once './../../procedures/classes/product.php';
    require_once './../../procedures/classes/dbconnection.php';
    $connection = new Connection();
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
        <p class="content__wrapper--title">Saída de um Produto</p>
        <hr class="content__wrapper--line" />
        <table class="products__wrapper">
            <tr>
                <th>Nome</th>
                <th>Quantia</th>
                <th>Data de Validade</th>
                <th>Retirar</th>
            </tr>
            <?php
                $result_prodlist = mysqli_query($connection->connection(),"SELECT * FROM products ORDER BY expiration_date ASC");
                while ($prod_info = mysqli_fetch_assoc($result_prodlist)){
                    $expiration_date = $prod_info['expiration_date'];
                    $expiration_date = date("d-m-Y",strtotime($expiration_date));
                    $expiration_date = str_replace("-","/",$expiration_date);
                    echo '
                    <tr>
                        <td>'.$prod_info['name'].'</td>
                        <td>'.$prod_info['amount'].'</td>
                        <td>'.$expiration_date.'</td>
                        <td class="modal__delete--prod"><a href="#openModal-'.$prod_info['id'].'" class="modal__delete--button">Retirar</a></td>
                    </tr>
                    <div id="openModal-'.$prod_info['id'].'" class="modalDialog">
                        <div>
                        <a href="#close-'.$prod_info['id'].'" title="Close" class="closeModal"></a><br>
                        <h2 class="modal__title">Retirar Produtos</h2><br>
                        <p>Nome do Produto: <font color="green">'.$prod_info['name'].'</font></p>
                        <p>Quantidade total do Produto: <font color="green">'.$prod_info['amount'].'</font></p>
                        <form method="POST" name="insert_form" action="./../../procedures/action/deleteProduct.php">
                        <div>
                            <input type="number" onkeypress="return isNumberKey(event)" name="amount" id="amount" class="modal__output--number" placeholder="Quantidade para retirar" required />
                        </div><br>
                        <input type="text" class="id__hidden" name="id" value="'.$prod_info['id'].'" id="id"></input>
                        <button type="submit" class="modal__output--submit">Confirmar</button>
                        </form>
                        </div>
                    </div>
                    ';
                }
            ?>
        </table>
    </div>
    <div class="footer__wrapper">
        <a href="./../plus_prod/" class="footer__wrapper--link">
            <img class="footer__wrapper--button" src="./../../../assets/plus-button.png" />
            <p class="footer__wrapper--text">Produto</p>
        </a>
        <a href="./../less_prod/" class="footer__wrapper--link">
            <img class="footer__wrapper--button-active" src="./../../../assets/minus.png" />
            <p class="footer__wrapper--text-active">Produto</p>
        </a>
        <a href="./../profile/" class="footer__wrapper--link">
            <img class="footer__wrapper--button" src="./../../../assets/user.png" />
            <p class="footer__wrapper--text">Perfil</p>
        </a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>
</body>

</html>