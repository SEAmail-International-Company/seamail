function verifForm(inputArray, urlRedirection, urlPhpFile, id){

    $("#" + id).submit(function(e){

        e.preventDefault();

        var data = new FormData(this);
        var xhr = new XMLHttpRequest();
        var statebox = [];
        var input = [];

        for (inputType in inputArray){
            statebox[inputArray[inputType]] = $("#statebox_"+inputArray[inputType]);
            input[inputArray[inputType]] = $("#"+inputArray[inputType]);
        }

        xhr.onreadystatechange = function(){

            if (this.readyState == 4 && this.status == 200){

                var res = this.response;

                if (res.success && urlRedirection != "") {
                    document.location.href = urlRedirection;
                }else if(res.success && urlRedirection == "") {
                    $("#"+id).get(0).reset();
                    const InputFile = document.querySelector('#piece_jointe_message .file-name');
                    InputFile.textContent = "Aucun fichier uploadé";
                    $("#salon_msg").load("php/chat_php.php");
                }else{
                    for (cle in input){
                        statebox[cle].html(res.msg[cle]);

                        if(res.msg[cle] != "Ce champ est correct.") changeInputStatus(cle, true);
                        else changeInputStatus(cle, false);
                    }
                }

            }else if (this.readyState == 4) console.log("Fichier de la requête introuvable.")
        }

        xhr.open("POST", urlPhpFile, true)
        xhr.responseType = "json"
        xhr.send(data)

    });
}