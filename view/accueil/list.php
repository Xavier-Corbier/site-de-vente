 <!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" style="height: 400px;top: -40px;">
  <!--Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <!--First slide-->
    <div class="carousel-item active">
      <img class="d-block w-100" src="./upload/accueil1"
        alt="First slide" style="height: 400px;">
    </div>
    <!--/First slide-->
    <!--Second slide-->
    <div class="carousel-item">
      <img class="d-block w-100" src="./upload/accueil2"
        alt="Second slide" style="height: 400px;">
    </div>
    <!--/Second slide-->
    <!--Third slide-->
    <div class="carousel-item">
      <img class="d-block w-100" src="./upload/accueil3"
        alt="Third slide" style="height: 400px;">
    </div>
    <!--/Third slide-->
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
 <div class="mx-5 py-4">
  <h3>Nos Produits</h3>
    <table class="table product-table">

        <tbody>
    <?php
                   foreach ($tab_Produit as $Produit) {
                    echo '<tr> <th> '.htmlspecialchars($Produit->get("nomProduit")).'</a>';
                    if($Produit->get("quantite")){
                    	echo '<p style="color:green;">En stock</p></th>';
                    } else {
                    	echo '<p style="color:red;">Rupture de Stock</p></th>';
                    }
                    echo '<td> <a href="?action=read&idProduit='.rawurlencode($Produit->get("idProduit")).'&controller=Produit"><img class="mx-5" src="./upload/'.htmlspecialchars($Produit->get("idProduit")).'" alt="Produit '.htmlspecialchars($Produit->get("nomProduit")).'" width="200px"> </a></td>';
                    echo '<td> <p>';
                      if ((strlen($Produit->get("descriptionProduit"))>50)) {
                        echo htmlspecialchars(substr($Produit->get("descriptionProduit"),0,50)).'...';
                      } else {
                        echo htmlspecialchars($Produit->get("descriptionProduit"));
                      }
                      echo ' </p> </td>';
                    echo '<td>'.$Produit->get("prixProduit").' <i class="fas fa-euro-sign"></i> </td> </tr>';
                    }
                
        ?>
         </tbody>
</table>
 </div>

