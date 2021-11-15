<div class="alert alert-success mx-5" role="alert">
<?php
echo 'L utilisateur '. $_POST['login']. ' a bien été mis à jour !</p>';
?>
</div>

   <?php
     require_once (File::build_path(array("view","utilisateur","list.php")));
   ?>