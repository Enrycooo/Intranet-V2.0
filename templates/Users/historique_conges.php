<?php ob_start();?>
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-6 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">L'historique des congés ajoutés !</h4>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-10">
        <div class="table-responsive">
          <table class="table table-striped table-bordered text-center" id="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Date d'ajout</th>
                <th>Nombre ajouter</th>
                <th>Motif</th>
                <th>Admin</th>
                <th>Employé</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_historique = $crud->id_historique;
                ?>
                <tr>
                    <td data-id="<?= $id_historique ?>"><?= $id_historique ?></td>
                    <td data-id="<?= $id_historique ?>"><?= $crud->date_ajout ?></td>
                    <td data-id="<?= $id_historique ?>"><?= $crud->nb_ajouter ?></td>
                    <td data-id="<?= $id_historique ?>"><?= $crud->motif ?></td>
                    <td data-id="<?= $id_historique ?>"><?= $crud->admin_nom.' '.$crud->admin_prenom ?></td>
                    <td data-id="<?= $id_historique ?>"><?= $crud->emp_nom.' '.$crud->emp_prenom ?></td>
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
        link.setAttribute("download", "Etats-conges"+today+".csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
}
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>