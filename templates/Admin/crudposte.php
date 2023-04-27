<?php ob_start();?>
<!-- Create modal -->
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
      <form name="form4" action='index.php?action=crudPoste&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="form3">Libellé du poste</label>
          <input type="text" id="form3" class="form-control validate" name='libelle'>
          <input type="hidden" name="action" value="create">

        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Créer un poste</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End create modal -->

<!-- Edit modal -->
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
      <form name="form4" action='index.php?action=crudPoste&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="libelleedit">Libellé du poste</label>
          <input type="text" id="libelleedit" class="form-control validate" name='libelle'>
          <input type="hidden" id="dataId" name="id_poste">
          <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary">Modifier le poste</button>
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
          <h4 class="text-primary">Tout les postes !</h4>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            Ajouter un nouveau poste
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
                <th>Postes</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_poste = $crud->id_poste;
                ?>
                <tr>
                    <td data-id="<?= $id_poste ?>"><?= $id_poste ?></td>
                    <td data-id="<?= $id_poste ?>"><?= $crud->libelle ?></td>
                    <td>
                        <div class='d-flex text-center'>
                        <button data-id="<?= $id_poste ?>" type="button" class="btn btn-sm btn-primary update" data-bs-toggle="modal" data-bs-target="#update">Modifier</button>
                        &nbsp;
                        <form action='index.php?action=crudPoste&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_poste' value='<?=$id_poste?>'>
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
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
    var editButtons = document.querySelectorAll(".update");

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
function exportData() {
  /* Get the date of today for the file */
  let today = new Date();
  const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric'};
  today = today.toLocaleDateString('fr-FR', options);

  /* Get the HTML data using Element by Id */
  var table = document.getElementById("table");

  /* Filter the table rows to exclude the 3rd column */
  var rows = Array.from(table.rows).map(row => {
    var cells = Array.from(row.cells);
    cells.splice(2, 1); // Remove the 3rd cell
    return cells.map(cell => cell.innerText);
  });

  /* Create a new workbook */
  var workbook = XLSX.utils.book_new();

  /* Add the filtered rows to a new worksheet */
  var worksheet = XLSX.utils.sheet_add_aoa(XLSX.utils.json_to_sheet(rows), []);

  /* Add the worksheet to the workbook */
  XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

  /* Save the workbook as an Excel file */
  XLSX.writeFile(workbook, "Raisons-conges-"+today+".xlsx");
}
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>