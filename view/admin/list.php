
<div class="mx-5 py-5 px-5">
    <div class="row">
    <div class="text-center col-md-6" >
    <form method="post" class="text-center p-5" action="?action=createCodePromo&controller=admin">

        <p class="h4 mb-4">Créer un code promotionnel</p>

        <!-- Email -->
        <input type="text" name="nomCode" class="form-control mb-4" required placeholder="Nom du code promotionnel">

        <!-- Password -->
        <input type="number" name="pourcentage" class="form-control mb-4" required placeholder="Pourcentage de remise" min="1" max="100">

        <input type="number" name="expiration" class="form-control mb-4" required placeholder="Date d'expiration (en jours)" step="1">

        <!-- Sign in button -->
        <button class="btn btn-info btn-block my-4" type="submit">Créer</button>

    </form>
    </div>
    <div class="text-center col-md-6 p-5" >
        <table class="table product-table">

            <!-- Table head -->
            <thead class="mdb-color lighten-5">
            <tr>
                <th class="font-weight-bold">
                    <strong>Nom</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Date d'expiration</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Pourcentage</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Action</strong>
                </th>
            </tr>
            </thead>
            <!-- /.Table head -->

            <tbody>
            <?php
            foreach ($listCode as $valeur){
                echo '<tr> <th> '.htmlspecialchars($valeur->get("idCode")).'</th> <td>';
                echo htmlspecialchars($valeur->get("Date")) . '</td>';
                echo '<td>'.htmlspecialchars($valeur->get("pourcentage")). ' </td></th>';
                echo '<td><a class="white-text waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=deleteCodePromo&controller=admin&idCode='.rawurlencode($valeur->get("idCode")).'">Supprimer</a></td></tr>';

            }


            ?>
            </tbody>
        </table>
    </div>
    </div>
    <hr>
    <div class="row">
            <div class="col-md-6">
            <div class="text-center">
            <h6>Images caroussel Accueil</h6>
            </div>
            <form class="text-center" method="post" action="?action=carousel&controller=<?php echo static::$object ?>" enctype="multipart/form-data">
            <h6>Photo 1</h6>
            <input class="form-control" type="file" name="nom-du-fichier1" required="required">
            <h6>Photo 2</h6>
            <input class="form-control" type="file" name="nom-du-fichier2" required="required">
            <h6>Photo 3</h6>
            <input class="form-control" type="file" name="nom-du-fichier3" required="required">
            <button class="btn btn-info my-4 btn-block orange accent-4" type="submit">Envoyer</button>
            </form>
            </div>
            <hr>
            <div class="col-md-6">
            <div class="text-center"><h6>Produit à réaprovisionner</h6></div>
            <div class="text-center"><h6>(Limite 2)</h6></div>
            <table class="table product-table">

                    <!-- Table head -->
                    <thead class="mdb-color lighten-5">
                      <tr>
                        <th class="font-weight-bold">
                          <strong>Nom</strong>
                        </th>
                        <th class="font-weight-bold">
                          <strong>Action</strong>
                        </th>
                      </tr>
                    </thead>
                    <!-- /.Table head -->

                <tbody>
                <?php
                           foreach ($tab as $valeur){
                              echo '<tr> <th> '.htmlspecialchars($valeur->get("nomProduit")).'</th> <td>';
                                echo '<a class="white-text waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=update&controller=Produit&idProduit='.rawurlencode($valeur->get("idProduit")).'">Réaprovisionner</a>';
                              echo '</td>';;
                           }
                            
                        
                ?>
                 </tbody>
            </table>
            </div> 
        </div>
    </div>


      





