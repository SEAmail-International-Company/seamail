<?php
require_once("php/web_class.php");

if(isset($_COOKIE["theme"])) $theme = $_COOKIE["theme"];
else $theme = "dark";

$web = new Web("SEAmail - Connexion");
$web->addNavBar($theme);
$web->addSection("Formulaire de connexion", "Veuillez compléter le formulaire ci-dessous pour vous connecter à votre compte SEAmail.");
$web->addToBody(<<<HTML
<div class="container is-fluid">
    <form method="POST" id="loginForm">
        <div class="field">
            <label class="label">Nom d'utilisateur</label>
            <p class="control has-icons-left is-expanded">
                <input class="input" name="username" id="username" type="text" placeholder="Nom d'utilisateur" autofocus>
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                </span>
                <p class="help" id="statebox_username"></p>
            </p>
        </div>
        <div class="field">
            <label class="label">Mot de passe</label>
            <p class="control has-icons-left is-expanded has-addons">
                <input class="input" id="password" name="password" type="password" placeholder="Mot de passe">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
                <p class="help" id="statebox_password"></p>
                <p class="help">Doit contenir plus de 12 caractères parmis lesquels au moins une majuscule, une minuscule, un caractère spécial ([|-_\`"#~!@{}[]+=%*&°) et un chiffre.</p>
            </p>
        </div>
        <div class="field is-grouped is-grouped-left mt-5">
            <p class="control">
                <input class="button is-info" type="submit" value="Connexion">
            </p>
            <p class="control">
                <a class="button is-info is-outlined" href="inscription.php">
                Pas encore membre ?
                </a>
            </p>
        </div>
    </form> 
</div> 

<script>
$("form").submit(function(e){

    e.preventDefault();

    var data = new FormData(this);
    var statebox_username = $("#statebox_username");
    var statebox_password = $("#statebox_password");
    var input_username = $("#username");
    var input_password = $("#password");
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){

    if (this.readyState == 4 && this.status == 200){

        var res = this.response;

        if (res.success){

            document.location.href = "index.php";

        }else{

            statebox_username.html(res.msg_username);
            statebox_password.html(res.msg_password);

            if(res.msg_username != "Ce champ est correct."){

                statebox_username.addClass("is-danger");
                input_username.addClass("is-danger");
                
            }else{

                statebox_username.removeClass("is-danger");
                input_username.removeClass("is-danger");
                statebox_username.addClass("is-success");
                input_username.addClass("is-success");

            }

            if(res.msg_password != "Ce champ est correct."){

                statebox_password.addClass("is-danger");
                input_password.addClass("is-danger");

            }else{

                statebox_password.removeClass("is-danger");
                input_password.removeClass("is-danger");
                statebox_password.addClass("is-success");
                input_password.addClass("is-success");

            }

        }

    }else if (this.readyState == 4){

        console.log("Fichier de la requête introuvable...")

    }

}

xhr.open("POST", "php/connexion_php.php", true)
xhr.responseType = "json"
xhr.send(data)

})
/*function verifInput(inputType){

    var ERR = 0;
    var MSG_ERR = "";
    var STATUS = [];
    var invalid_email = "L'adresse mail entrée n'est pas valide.";
    var empty_input = "Le champ " + inputType + " est requis et ne peut être vide.";
    var invalid_password = "Le mot de passe ne respecte pas les règles requises";
    var value = $("#"+inputType).val();

    if(value.length != 0){
        if(inputType == "password"){

            var pass_res = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{12,})");
            var is_correct_pass = pass_res.test(value)

            if(is_correct_pass) {
                ERR = 0;
            }else{
                ERR = -2;
                MSG_ERR = invalid_password;
            } 
            
        }else if(input == "email"){

            const res = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var is_email = res.test(String(value).toLowerCase());

            if(is_email) {
                ERR = 0;
            }else{
                ERR = -3;
                MSG_ERR = invalid_email;
            } 
        }
    }else{
        ERR = -1;
        MSG_ERR = empty_input;
    }

    STATUS[0] = ERR;
    STATUS[1] = MSG_ERR;

    if(STATUS[0] != 0){
        $("#statebox_" + inputType).html(MSG_ERR);
        $("#statebox_" + inputType).addClass("is-danger");
        $("#" + inputType).addClass("is-danger");
        event.preventDefault();
    }

    return STATUS;
}*/
</script>
HTML);

echo $web->toHTML($theme);