<?php
    include("config.php");
?><!doctype html>
<html lang="FR">
<head>
    <meta name="author" content="HUYGEBAERT Amandine">
    <link rel="stylesheet" href="style.css">
    <script src="common.js"></script>
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="42.png" />
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <div class="content">
        <?php
        dis_header();
        dis_menu();
        ?>
        <div class="login">
            <fieldset>
                <legend class="legend">Login</legend>
                <form method="post" action="hash.php">
                    <p>Identifiant : <input type="text" name="identifiant"></p>
                    <p>Password : <input type="text" name="password_p"></p>
                    <p>Pseudo : <input type="text" name="pseudo">
                        <input type="hidden" name="test" value="0">
                    <input type="submit" value="s'inscrire" class="button"></p>
                </form>
            </fieldset>
        </div>
        <?php dis_footer();?>
    </div>
</body>
</html>