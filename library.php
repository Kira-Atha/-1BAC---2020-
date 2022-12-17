<?php
function dis_menu($login){
    include('config.php'); ?>
    <div class="menu">
        <ul class="dropdownmenu">
            <?php if(!$login){
                echo '<li><a href="index.php">Login</a></li>';
            }?>
            <?php if($login){
                echo '<li><a href="logout.php">Deconnexion</a></li>';
                echo '<li><a href="content.php">Voir tous les sujets</a></li>';
            }?>
        </ul>
    </div>
<?php }
    function dis_footer(){
        include('config.php');
        echo '<div class="footer">Informations<br>';
            echo $nom.' | '.$prenom.' | '.$classe.'<br>';
            echo "HEPH Condorcet [WEB] Juin 2020";
        echo '</div>';
        }
    function dis_header(){
        include('config.php');
        ?>
        <div class="border_header">
            <div class="border_two_header">
                <div class="header">
                    <img src="42.png" class="img_header"><?php echo $title; ?><img src="42.png" class="img_header"><br>
                    <img src="trait.png" class="trait_header">
                </div>
            </div>
        </div>
<?php }