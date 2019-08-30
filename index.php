<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Thinking APP | Pensando no SEU futuro</title>
    <link rel="icon" type="image/x-icon" href="./assets/Logo_THINKING.png" />
    <link href="./style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css"/>
</head>

<body>
    <div class="content__wrapper">
        <form method="POST" name="login_form" class="form__wrapper">
            <img src="./assets/Logo_THINKING.png" class="form__img" alt="Logo Lar" />
            <div class="form__input--email">
                <input class="form__input--email-input" type="email" id="email" name="email" placeholder="Email" required/>
            </div>
            <div class="form__input--email">
                <input class="form__input--email-input" type="password" id="password" name="password" placeholder="Senha" required/>
            </div>
            <input type="submit" class="form__input--submit" onClick="return validate()" value="Login" />
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <script>
        function validate() {
            var email = login_form.email.value;
            var password = login_form.password.value;
            if (email == ""){
                swal('Preencha o seu email');
                login_form.email.focus();
                return false;
            }
            else if (password == ""){
                swal('Preencha sua senha');
                login_form.password.focus();
                return false;
            }
            else {
                swal("Efetuando o login...");
                // Método post do Jquery
                $.post('./src/procedures/action/login.php', {
                    email:email,
                    password:password
                }, function(resposta){
                    if(resposta == true){
                        alert("Houve um problema nas suas credenciais!");
                    }
                    else {
                        window.location.href = "./src/pages/home/";
                    }
                });
                return false;
            }
        }
    </script>
</body>

</html>