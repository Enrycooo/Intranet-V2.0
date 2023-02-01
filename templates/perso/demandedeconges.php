<?php ob_start();?>
<div class="container">
    <div class="row mt-4">
      <div class="col-lg-10 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Toutes mes demandes de congés!</h4>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-14">
        <div class="table-responsive">
          <table class="table table-striped table-bordered text-center" id="table" border="1">
            <thead>
              <tr>
                <th>N°</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Début type</th>
                <th>Fin type</th>
                <th>Durée</th>
                <th>Raison</th>
                <th>État</th>
                <th>Commentaire</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_conges = $crud->id_conges;
                ?>
                <tr>
                    <td data-id="<?= $id_conges ?>"><?= $id_conges ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->date_debut ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->date_fin ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->debut_type ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->fin_type ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->duree ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->raison ?></td>
                    <?php
                        if($crud->etat == 'En attente'){echo "<td data-id=".$id_conges."><span class='badge bg-warning'>" . $crud->etat . "</span></td>";}
                        elseif($crud->etat == 'Acceptee'){echo "<td data-id=".$id_conges."><span class='badge bg-success'>" . $crud->etat . "</span></td>";}
                        elseif($crud->etat !== ''){echo "<td data-id=".$id_conges."><span class='badge bg-danger' style='background-color: #ff0000;'>" . $crud->etat . "</span></td>";}
                    ?>
                    <td data-id="<?= $id_conges ?>"><?= $crud->commentaire ?></td>
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
        column3 = row.cells[2].innerText;
        column4 = row.cells[3].innerText;
        column5 = row.cells[4].innerText;
        column6 = row.cells[5].innerText;
        column7 = row.cells[6].innerText;
        column8 = row.cells[7].innerText;
        column9 = row.cells[8].innerText;
 
    /* add a new records in the array */
        rows.push(
            [
                column1,
                column2,
                column3,
                column4,
                column5,
                column6,
                column7,
                column8,
                column9
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
        link.setAttribute("download", "Conges-perso-"+today+".csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
}
</script>
<?php $content = ob_get_clean();?>

<?php require('templates/layout.php') ?>
