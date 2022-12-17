<?php
	$dsn = 'PRIVATE';
	$user = 'PRIVATE';
	$password = 'PRIVATE';
    $nom="Huygebaert";
    $prenom="Gabriel";
    $classe="Student in first year of bachelor’s degree in computer management";
    $title="Forum";
    $pattern_identifiant='/^[a-zA-Z]{5,16}$/';
    $pattern_password='/^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{8,16}$/';
    $pattern_mail='/^\S+@\S+\.\S+$/';
    $info_pattern="  ID  :  Doit contenir de 5 à 16 lettres.".'<br>'."
                            Ne peut contenir ni chiffre, ni symbole spécial, ni espace.".'<br><br>'."

                    MDP :   Doit contenir de 8 à 16 caractères dont au moins, une minuscule, une majuscule et un chiffre.".'<br>'."
                            Ne peut contenir ni symbole spécial, ni espace.".'<br><br>'."
                    
                    E-mail : Doit respecter le format abc@def.ijk".'<br>'."
                            Peut contenir des lettres ou des chiffres.".'<br>'."
                            Accepte tous les noms de domaines possibles.";".'<br>'";