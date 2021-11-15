<div class="mx-5 py-4">
<div class="text-center py-4">
  <?php
  if ($_GET['action']=="update"){
        echo '<img class="mx-5" src="./upload/'.htmlspecialchars($_GET['idProduit']).'" width="200px">';
  }
  ?>
</div>
<form class="text-center" method="post" action="?action=<?php echo $effect ?>&controller=<?php echo static::$object ?>" enctype="multipart/form-data">
    <div class="form-row mb-4">
        <div class="col">
          <input class="form-control" type="text" placeholder="Nom du produit" name="nomProduit" id="nomProduit_id" value="<?php echo htmlspecialchars($v->get("nomProduit"))?>" required/>
        </div>
        <div class="col">
          <select class="browser-default custom-select" name="categorieProduit" id="categorieProduit_id">
                <option value="" disabled selected>Sélectionner la catégorie</option>
                <?php
                foreach ($tab_cat as $va)
                  echo '<option value="'.htmlspecialchars($va->get("id")).'">'.htmlspecialchars($va->get("valeur")).'</option>';
                ?>
            </select>
        </div>
    </div>
    <div class="form-row mb-4">
      <input class="form-control" type="text" placeholder="Description" name="descriptionProduit" id="descriptionProduit_id" value="<?php echo htmlspecialchars($v->get("descriptionProduit"))?>" required/>
    </div>
    <div class="form-row mb-4">
        <div class="col">
          <input class="form-control" type="number" placeholder="Prix" min="0.01" max="10000.00" step="0.01" name="prixProduit" id="prixProduit_id" value="<?php echo htmlspecialchars($v->get("prixProduit"))?>" required/>
        </div>
        <div class="col">
          <input class="form-control" type="number" placeholder="Quantité" min="1" max="10000" step="1" name="quantite" id="quantite_id" value="<?php echo htmlspecialchars($v->get("quantite"))?>" required="required" />
        </div>
    </div>

    <input class="form-control" type="file" name="nom-du-fichier" <?php if ($_GET['action']=="create") {
            echo "required";}?>>
    <input id="idProduit" name="idProduit" type="hidden" value="<?php echo $_GET['idProduit']; ?>">
    <button class="btn btn-info my-4 btn-block orange accent-4" type="submit">Envoyer</button>
</form>


</div>