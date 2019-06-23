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
</head>
<body>
    <div class="toolbar__wrapper">
        <a href="./../home/"><img class="back" src="./../../../assets/arrow.png" /></a>
        <img src="./../../../assets/vetor_lamp.png" class="toolbar__img"/>
    </div>
    <div class="content__wrapper">
        <p class="content__wrapper--title">Seu Perfil</p>
        <hr class="content__wrapper--line" />
        <div class="profile__wrapper">
            <p>Nome: <?php echo $_SESSION['name']; ?></p>
            <p>Email: <?php echo $_SESSION['email']; ?></p>
            <p>Cargo: <?php echo $_SESSION['job_role']; ?></p>
            <p>É Responsável: <?php if($_SESSION['is_responsable'] == 0) { echo 'Não'; } else { echo 'Sim'; } ?></p>
            <button class="exit__button" onclick="location.href='./../../procedures/action/logout.php';">Sair</button>
        </div>
    </div>
    <div class="footer__wrapper">
        <a href="./../plus_prod/"><img src="./../../../assets/plus_product.png" /></a>
        <a href="./../less_prod/"><img src="./../../../assets/less_product.png" /></a>
        <a href=""><img src="./../../../assets/profile-active.png" /></a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function validate() {
            var prod_type = insert_form.prod_type.value;
            var entry_type = insert_form.entry_type.value;
            var prod_name = insert_form.prod_name.value;
            var prod_desc = insert_form.prod_desc.value;
            var prod_amount = insert_form.prod_amount.value;
            var expiration_date = insert_form.expiration_date.value;
            var prod_value = insert_form.prod_value.value;
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