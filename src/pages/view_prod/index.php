<?php
    session_start();
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['name']) == true)){
        session_destroy();
        header('Location: ./../../../');
    }
    require_once './../../procedures/classes/product.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'./thinkingapp/src/procedures/classes/dbconnection.php';
    $connection = new Connection();
    $type = $_GET['type'];
    if ($_GET['type'] == 'food'){
        $title = 'Alimentos';
    }
    else if ($_GET['type'] == 'medicine'){
        $title = 'Medicamentos';
    }
    else {
        $title = 'Mat. de Procedimentos';
    }
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
        <p class="content__wrapper--title"><?php echo $title; ?></p>
        <hr class="content__wrapper--line" />
        <table class="products__wrapper">
            <tr>
                <th>Tipo de Entrada</th>
                <th>Nome</th>
                <th>Quantia</th>
                <th>Data de Validade</th>
                <th>Valor (R$)</th>
            </tr>
            <?php
                $result_prodlist = mysqli_query($connection->connection(),"SELECT * FROM products WHERE prod_type = '{$type}' ORDER BY expiration_date ASC");
                while ($prod_info = mysqli_fetch_assoc($result_prodlist)){
                    $expiration_date = $prod_info['expiration_date'];
                    $expiration_date = date("d-m-Y",strtotime($expiration_date));
                    $expiration_date = str_replace("-","/",$expiration_date);
                    if ($prod_info['entry_type'] == 'purchase'){
                        $entry_type = 'Compra';
                    }
                    else if ($prod_info['entry_type'] == 'donation'){
                        $entry_type = 'Doação';
                    }
                    echo '
                    <tr>
                        <td>'.$entry_type.'</td>
                        <td>'.$prod_info['name'].'</td>
                        <td>'.$prod_info['amount'].'</td>
                        <td>'.$expiration_date.'</td>
                        <td>'.$prod_info['value'].'</td>
                    </tr>
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
            <img class="footer__wrapper--button" src="./../../../assets/minus.png" />
            <p class="footer__wrapper--text">Produto</p>
        </a>
        <a href="./../profile/" class="footer__wrapper--link">
            <img class="footer__wrapper--button" src="./../../../assets/user.png" />
            <p class="footer__wrapper--text">Perfil</p>
        </a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function validate() {
            let prod_type = insert_form.prod_type.value;
            let entry_type = insert_form.entry_type.value;
            let prod_name = insert_form.prod_name.value;
            let prod_desc = insert_form.prod_desc.value;
            let prod_amount = insert_form.prod_amount.value;
            let expiration_date = insert_form.expiration_date.value;
            let prod_value = insert_form.prod_value.value;
            if (prod_type == ""){
                alert('Escolha o tipo do Produto');
                insert_form.prod_type.focus();
                return false;
            }
            else if (entry_type == ""){
                alert('Escolha o tipo de Entrada');
                insert_form.entry_type.focus();
                return false;
            }
            else if (prod_name == ""){
                alert('Digite o nome do Produto');
                insert_form.prod_name.focus();
                return false;
            }
            else if (prod_desc == ""){
                alert('Escreva uma descrição para o Produto');
                insert_form.prod_desc.focus();
                return false;
            }
            else if (prod_amount == ""){
                alert('Escolha a quantidade do Produto');
                insert_form.prod_amount.focus();
                return false;
            }
            else if (expiration_date == ""){
                alert('Digite a data de Validade');
                insert_form.expiration_date.focus();
                return false;
            }
            else if (prod_value == ""){
                alert('Digite o valor total do Produto');
                insert_form.prod_value.focus();
                return false;
            }
            else {
                alert("Inserindo no banco de dados...");
                // Método post do Jquery
                $.post('./../../procedures/action/insertProduct.php', {
                    prod_type:prod_type,
                    entry_type:entry_type,
                    prod_name:prod_name,
                    prod_desc:prod_desc,
                    prod_amount:prod_amount,
                    expiration_date:expiration_date,
                    prod_value:prod_value
                }, function(resposta){
                    if(resposta == '1'){
                        alert('Produto inserido com sucesso no Banco de Dados!');
                        document.getElementById('prod_type').value='';
                        document.getElementById('entry_type').value='';
                        document.getElementById('prod_name').value='';
                        document.getElementById('prod_desc').value='';
                        document.getElementById('prod_amount').value='';
                        document.getElementById('expiration_date').value='';
                        document.getElementById('prod_value').value='';
                    }
                    else {
                        alert('Erro! Produto não inserido');
                        document.getElementById('prod_type').value='';
                        document.getElementById('entry_type').value='';
                        document.getElementById('prod_name').value='';
                        document.getElementById('prod_desc').value='';
                        document.getElementById('prod_amount').value='';
                        document.getElementById('expiration_date').value='';
                        document.getElementById('prod_value').value='';
                    }
                });
                return false;
            }
        }
    </script>
</body>

</html>