
<div class="mx-5 py-3">
<?php
 // vérification si le pannier est vide
 if (!isset($data)) {
           echo '<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Vous n\'avez pas d\'article</h4>
  <p class="mb-0">Vous n\'avez pas de d\'article dans votre panier, veuillez vous rendre à <a href="./index.php" class="alert-link">l\'accueil</a> pour consulter notre catalogue.</p>
</div>';
 } else {
     //entête du pannier
     echo '<table class="table product-table">
          <!-- Table head -->
            <thead class="mdb-color lighten-5">
              <tr>
                <th class="font-weight-bold">
                  <strong>Nom</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Quantité</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Prix</strong>
                </th>
                <th class="font-weight-bold">
                </th>
              </tr>
            </thead>
            <!-- /.Table head -->
            <tbody>';
     foreach ($data as $cle => $valeur) {
         echo '<tr><th scope="row">' . ModelProduit::select($cle)->get("nomProduit") . '</th>';
         echo '<td>' . $valeur . '</td>';
         echo '<td>' . $valeur * ModelProduit::select($cle)->get("prixProduit") . '</td>';
         echo '<td><a href="?action=delete&controller=panier&idProduit=' . $cle . '">Supprimer</a><a href="?action=read&controller=produit&idProduit=' . $cle . '"> Modifier</a></td></tr>';
     }

     // fin du panier
     echo '</tbody>
</table>';
     if ($promo != 1 && $promo != 0) {
         echo '<div class="alert alert-success" style="width: 30%" role="alert">
        Le code promotionnel a été appliqué avec succès.
    </div>';
     }
     if ($promo === 0) {
         echo '<div class="alert alert-danger" style="width: 30%" role="alert">
        Ce code n\'est pas valide.
    </div>';
     }
     echo <<< EOT
         <label for="basic-url">Code promotion</label>
    <div class="input-group mb-3" >
      <div class="input-group-prepend">
      </div>
      <form class="form-inline" method="post" action="?controller=panier&action=codePromo">
      <span class="input-group-text" id="basic-addon3">Insérer ici</span>
              <input type="text" class="form-control" id="id_codePromo" name="codePromo" >
              <button type="submit" class="btn btn-elegant">OK</button>
      </form>
    </div>
EOT;

     // ajout du prix du pannier dans la session.
     if ($promo == 1) {
         $_SESSION['prix'] = $resultat;
     } else {
         $_SESSION['prix'] = $resultat - ($resultat * $promo);
         if ($promo != 0) {
             echo 'réduction appliquée : ' . $promo * 100 . "% </br>";
         }
     }
     echo "Prix à payer : " . $_SESSION['prix'] . "€</br>";
 }
?>
</div>
<div class="text-center py-3">
      
      <?php
      if (isset($_COOKIE['panier'])) {
        echo '<a class="waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=deleteAll&controller=Panier">Vider le panier</a><a class="waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=add&controller=Commande">Procéder au paiement</a>';
      }
      ?>
</div>