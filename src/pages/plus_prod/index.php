<?php
    session_start();
    if ((!isset($_SESSION['email']) == true) && (!isset($_SESSION['name']) == true)){
        session_destroy();
        header('Location: ./../../../');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" />
</head>
<body>
    <div class="toolbar__wrapper">
        <a href="./../home/"><img class="back" src="./../../../assets/arrow.png" /></a>
        <img src="./../../../assets/vetor_lamp.png" class="toolbar__img"/>
    </div>
    <div class="content__wrapper">
        <p class="content__wrapper--title">Adicione um novo Produto</p>
        <hr class="content__wrapper--line" />
        <form method="POST" name="insert_form" class="card__wrapper">
            <select class="card__wrapper--select" id="prod_type" name="prod_type" required>
                <option value="" selected disabled>Produto</option> 
                <option value="food">Alimento</option>
                <option value="medicine">Medicamentos</option>
                <option value="procedural_material">Mat. de Procedimentos</option>
            </select>
            <select class="card__wrapper--select" id="entry_type" name="entry_type" required>
                <option value="" selected disabled>Entrada</option> 
                <option value="purchase">Compra</option>
                <option value="donation">Doação</option>
                <option value="SUS">SUS</option>
            </select>
            <input type="text" class="card__wrapper--input" id="prod_name" name="prod_name" placeholder="Nome do Produto" required />
            <textarea id="prod_desc" name="prod_desc" class="card__wrapper--textarea" rows="2" cols="40" placeholder="Descrição do Produto" required></textarea>
            <select class="card__wrapper--select" id="prod_amount" name="prod_amount" required>
                <option value="" selected disabled>Quantidade</option> 
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <input type="text" class="card__wrapper--input" id="expiration_date" name="expiration_date" placeholder="Data de Validade (ou deixe em branco)" />
            <input type="text" class="card__wrapper--input" id="prod_value" name="prod_value" placeholder="Valor (ou deixe em branco)" />
            <button type="submit" class="card__wrapper--button" onClick="return validate()">Adicionar</button>
        </form>
    </div>
    <div class="footer__wrapper">
        <a href=""><img src="./../../../assets/plus_product-active.png" /></a>
        <a href="./../less_prod/"><img src="./../../../assets/less_product.png" /></a>
        <a href="./../profile/"><img src="./../../../assets/profile.png" /></a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="jquery.maskMoney.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#expiration_date').mask('99/99/9999');
            return false;
        });
        $(function() {
            $('#prod_value').maskMoney();
        })
        function validate() {
            var prod_type = insert_form.prod_type.value;
            var entry_type = insert_form.entry_type.value;
            var prod_name = insert_form.prod_name.value;
            var prod_desc = insert_form.prod_desc.value;
            var prod_amount = insert_form.prod_amount.value;
            var expiration_date = insert_form.expiration_date.value;
            var prod_value = insert_form.prod_value.value;
            if (prod_type == ""){
                swa1('Escolha o tipo do Produto');
                insert_form.prod_type.focus();
                return false;
            }
            else if (entry_type == ""){
                swa1('Escolha o tipo de Entrada');
                insert_form.entry_type.focus();
                return false;
            }
            else if (prod_name == ""){
                swa1('Digite o nome do Produto');
                insert_form.prod_name.focus();
                return false;
            }
            else if (prod_desc == ""){
                swa1('Escreva uma descrição para o Produto');
                insert_form.prod_desc.focus();
                return false;
            }
            else if (prod_amount == ""){
                swa1('Escolha a quantidade do Produto');
                insert_form.prod_amount.focus();
                return false;
            }
            else if (expiration_date == ""){
                swa1('Digite a data de Validade');
                insert_form.expiration_date.focus();
                return false;
            }
            else if (prod_value == ""){
                swa1('Digite o valor total do Produto');
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
                    if(resposta = '1'){
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