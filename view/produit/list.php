<div class="mx-5 py-4">
    <table class="table product-table">
        <tbody>
        <?php
        foreach ($tab_Produit as $Produit) {
            echo '<tr> <th> <a href="?action=read&idProduit='.rawurlencode($Produit->get("idProduit")).'&controller=Produit">'.htmlspecialchars($Produit->get("nomProduit")).'</a></th>';
            echo '<td>'.$Produit->get("prixProduit").' <i class="fas fa-euro-sign"></i> ';
            if (Session::is_admin()) {
                echo '<a href="?action=delete&idProduit='.rawurlencode($Produit->get("idProduit")).'&controller=Produit"><i class="material-icons">delete</i></a>';
                echo '<a href="?action=update&controller=Produit&idProduit='.rawurlencode($Produit->get("idProduit")).'"><i class="material-icons">edit</i></a>' . '</td>';
            } else {
                echo '</td>';
            }
            echo '</tr>';
        }
        if (Session::is_admin()) {
            echo '
<div class="text-center py-3">
      <a class="waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=create&controller=Produit">Créer un produit</a>
</div>';
        }

        ?>
        </tbody>
    </table>
</div>
