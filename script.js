function register(){
    console.log("Hide/Show se lance");
    show("register");
    hide("login");
    $("error").innerHTML="";
}
/*VERIFICATION CÔTÉ CLIENT // Confort de l'utilisateur*/
function verif(){
    console.log("Verif_je me lance ! ");
/* Création des variables nécessaires.*/
/* Récupération des 2 valeurs à chaque lever de touche ou changement ( coller de la souris ).*/
    var test_1=false;
    var test_2=false;
    var identifiant = $("identifiant").value;
    var password_p=$("password_p").value;
/* Création des expressions régulières et établir ses règles.*/
    var reg_identifiant=new RegExp(/^[a-zA-Z]{5,16}$/);
    var reg_password=new RegExp(/^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{8,16}$/);
/* Test des expressions régulières sur les valeurs récupérées. test_1 et test_2 seront 1 ou 0.*/
    var result_1=reg_identifiant.test(identifiant);
    if(result_1==true){
        $("identifiant").style.borderColor="green";
        test_1=true;
    }else{
        $("identifiant").style.borderColor="red";
        $("cercle").style.visibility="visible";
    }
    var result_2=reg_password.test(password_p);
    if(result_2==true){
        $("password_p").style.borderColor="green";
        test_2=true;
    }else{
        $("password_p").style.borderColor="red";
    }
    // Cacher bouton si vérification mauvaise pour connexion.
    if(test_1 && test_2){
        $("button_login").style.visibility="visible";
    }else{
        $("button_login").style.visibility="hidden";
    }
}
window.addEventListener("load",function(){
    $("button_register").addEventListener("click",register);
    $("content").addEventListener("keyup",verif);
    $("content").addEventListener("onchange",verif);
});