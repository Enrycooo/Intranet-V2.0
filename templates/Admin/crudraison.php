<?php ob_start();?>
<!-- New create modal -->
<?php

?>
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=crudRaison&id=<?=$id?>' method='post'>
            <?php
            $action = 'create';
            ?>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="form3">Libellé de la raison</label>
          <input type="text" id="form3" class="form-control validate" name='libelle'>
          <input type="hidden" name="action" value="create">

        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Créer une raison</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End create modal -->

<!-- New update modal -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=crudRaison&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="libelleedit">Libellé de la raison</label>
          <input type="text" id="libelleedit" class="form-control validate" name='libelle'>
          <input type="hidden" id="dataId" name="id_raison">
          <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary">Modifier la raison</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End update modal -->
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-6 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Toutes les raisons !</h4>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            Ajouter une nouvelle raison
            </button>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-6">
        <div class="table-responsive">
          <table class="table table-striped table-bordered text-center" id="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Raison</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_raison = $crud->id_raison;
                ?>
                <tr>
                    <td data-id="<?= $id_raison ?>"><?= $id_raison ?></td>
                    <td data-id="<?= $id_raison ?>"><?= $crud->libelle ?></td>
                    <td>
                        <div class='d-flex text-center'>
                        <button data-id="<?= $id_raison ?>" type="button" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#update">Modifier</button>
                        &nbsp;
                        <form action='index.php?action=crudRaison&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_raison' value='<?=$id_raison?>'>
                            <button data-id="<?= $id_raison ?>" type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            <input type="hidden" name="action" value="delete">
                        </form>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <button class="btn btn-primary" onclick="exportData()">Exporter en Excel</button>
  </div>
<script>
    // Récupération des données de la cellule lorsque le bouton "Modifier" est cliqué
    var editButtons = document.querySelectorAll(".edit");

    editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var dataId = button.getAttribute("data-id");
        var row = document.querySelector(`td[data-id="${dataId}"]`).parentNode;
        var cellData = row.querySelector("td:nth-child(2)").textContent;

        // Mise des données récupérées dans l'input du modal
        document.querySelector("#libelleedit").value = cellData;
        document.querySelector("#dataId").value = dataId;
      });
    });
</script>
<script type="text/javascript">
function exportData(){
    /* Get the date of today for the file */
    let today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric'};
    today = today.toLocaleDateString('fr-FR', options);
    
    /* Get the HTML data using Element by Id */
    var table = document.getElementById("table");
 
    /* Declaring array variable */
    var rows =[];
 
      //iterate through rows of table
    for(var i=0,row; row = table.rows[i];i++){
        //rows would be accessed using the "row" variable assigned in the for loop
        //Get each cell value/column from the row
        column1 = row.cells[0].innerText;
        column2 = row.cells[1].innerText;
 
    /* add a new records in the array */
        rows.push(
            [
                column1,
                column2
            ]
        );
 
        }
        csvContent = "data:text/csv;charset=utf-8,";
         /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray){
            row = rowArray.join(",");
            csvContent += row + "\r\n";
        });
 
        /* create a hidden <a> DOM node and set its download attribute */
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Raisons-conges-"+today+".csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
}
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>