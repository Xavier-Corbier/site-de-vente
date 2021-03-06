<div class="mx-5 py-5 px-5">
    <?php
    if(!empty($tab_Commande)) {
        echo '<table class="table product-table">

        <!-- Table head -->
        <thead class="mdb-color lighten-5">
        <tr>
            <th class="font-weight-bold">
                <strong>IdCommande</strong>
            </th>
            <th class="font-weight-bold">
                <strong>login</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Date de Commande</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Prix</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Statut</strong>
            </th>';
    }?>
            <?php
            if(Session::is_admin()) {
                    echo '<th class="font-weight-bold">
                    <strong>Action</strong>
                </th>';
            }
            ?>
        </tr>
        </thead>
        <!-- /.Table head -->

        <tbody>
        <?php
        if(!empty($tab_Commande)) {
            foreach ($tab_Commande as $valeur) {
                echo '<tr> <th><a href="?controller=commande&action=detailCommande&idCommande=' . htmlspecialchars($valeur->get("idCommande")) . '"> '.$valeur->get("idCommande").'</a></th>';
                echo '<td>' . htmlspecialchars($valeur->get("login")) . '</td>';
                echo '<td>' . htmlspecialchars($valeur->get("dateCommande")) . '</td>';
                echo '<td>' . htmlspecialchars($valeur->get("prix")) . ' </td>';
                echo '<td>' . htmlspecialchars($valeur->get("statut")) . '</td>';
                if (Session::is_admin()&&$valeur->get("statut")=="En cours") {
                    echo '<td><a class="white-text waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=updateCommandeEnvoyee&controller=commande&idCommande=' . rawurlencode($valeur->get("idCommande")) . '">Envoyer ?</a></td>';
                } else if(Session::is_admin()&&$valeur->get("statut")=="Envoy??e"){
                    echo '<td>A ??t?? envoy??e</td>';
                }
                else if(Session::is_admin()&&$valeur->get("statut")=="Annul??e"){
                    echo '<td>Annul??e</td>';
                }
                echo '</tr>';
            }
        }else{
            echo '<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Vous n\'avez pas de commande</h4>
  <p class="mb-0">Vous n\'avez pas de commande en cours, veuillez vous rendre ?? <a href="./index.php" class="alert-link">l\'accueil</a> pour proc??der ?? des achats.</p>
</div>';
        }


        ?>
        </tbody>
    </table>


</div>