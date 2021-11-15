<div class="mx-5 py-4">
    <table class="table product-table">
        <table class="table product-table">

            <!-- Table head -->
            <thead class="mdb-color lighten-5">
            <tr>
                <th class="font-weight-bold">
                    <strong>IdCommande</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>idProduit</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Quantite</strong>
                </th>
        <tbody>
        <?php
        foreach ($tab_detail as $detail) {
            echo '<tr> <th>'. $detail["idCommande"] .'</th>';
            echo '<td> ' .$detail["idProduit"] .'</td>';
            echo '<td>'.$detail["quantite"].'</td> </tr>';
        }

        ?>
        </tbody>
    </table>
</div>
<?php
if (Session::is_user($_SESSION["login"]) && ! (ModelCommande::select($tab_detail[0]["idCommande"])->get("statut") == "Annulée")) {
    echo '<div class="text-center py-3" style="padding-top:40px;">
	  	<a class="waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=updateCommandeAnnuler&controller=commande&idCommande='. $tab_detail[0]["idCommande"].'">Annuler Commande</a>
</div>';
}

?>
