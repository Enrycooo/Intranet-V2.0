<?php ob_start();?>
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
      <form name="form4" action='index.php?action=crudconges&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de début<span class="text-danger"></span></label> 
                    <input type="datetime-local" id="date_debut" name="date_debut"> 
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time" name='debut_type'>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de fin<span class="text-danger"></span></label> 
                    <input type="datetime-local" id="date_fin" name="date_fin"> 
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time2" name='fin_type'>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Raison<span class="text-danger"></span></label>
                    <select class="select form-control-lg" name="raison" id="raison">
                        <option value="0" hidden>Choisissez une raison</option>
                        <?php
                        foreach($raisons as $raison){
                        ?>
                        <option value="<?= htmlspecialchars($raison->id_raison) ?>">
                        <?= htmlspecialchars($raison->libelle) ?></option>
                        <?php
                        } 
                        ?>
                     </select>
                </div>
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">État<span class="text-danger"></span></label>
                    <select class="select form-control-lg" name="etat" id="etat">
                        <option value="0" hidden>Choisissez un état</option>
                        <?php
                        foreach($etats as $etat){
                        ?>
                        <option value="<?= htmlspecialchars($etat->id_etat) ?>">
                        <?= htmlspecialchars($etat->libelle) ?></option>
                        <?php
                        } 
                        ?>
                     </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label">Commentaire<span class="text-danger"></span></label>
                    <input type="text" id="commentaire" name="commentaire"> 
                </div>
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Duree<span class="text-danger"></span></label> 
                    <input type="text" id="duration" name="duree" value=""> 
                </div>
            </div>
            <input type="hidden" id="dataId" name="id_conges">
            <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary">Modifier le congés</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End update modal -->
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-10 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Toutes les demandes de congés!</h4>
        </div>
        <div>
            <a class="btn btn-danger" href="index.php?action=createCongesAdmin&id=<?=$id?>"><i class="fas fa-heart pe-2"></i>Ajouter un congés</a>
        </div>
      </div>
    </div>
    <hr>
    <center>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="inlineCheckbox1"><span class='badge bg-warning'>En attente</span></label>
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="En attente">
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="inlineCheckbox2"><span class='badge bg-success'>Acceptée</span></label>
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Acceptee">
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="inlineCheckbox3"><span class='badge bg-danger'>Annulée</span></label>
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Annulee">
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="inlineCheckbox4"><span class='badge bg-danger'>Rejetée</span></label>
            <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="Rejetee">
        </div>
    </center>
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
                <th>Employé</th>
                <th>Actions</th>
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
                    <td data-id="<?= $id_conges ?>" hidden><?= $crud->commentaire ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->nom ." ". $crud->prenom?></td>
                    <td>
                        <div class='d-flex text-center'>
                        <button data-id="<?= $id_conges ?>" type="button" class="btn btn-sm btn-primary update exclude-cell" data-bs-toggle="modal" data-bs-target="#update">Modifier</button>
                        &nbsp;
                        <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                            <button type="submit" class="btn btn-sm btn-danger exclude-cell">Supprimer</button>
                            <input type="hidden" name="action" value="delete">
                        </form>
                        &nbsp;
                        <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                            <input type='hidden' name='id_etat' value='3'>
                            <button type="submit" class="btn btn-sm btn-success exclude-cell">Acceptée</button>
                            <input type="hidden" name="action" value="etat">
                        </form>
                        &nbsp;
                        <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                            <input type='hidden' name='id_etat' value='4'>
                            <button type="submit" class="btn btn-sm btn-warning exclude-cell">Refusée</button>
                            <input type="hidden" name="action" value="etat">
                        </form>
                        &nbsp;
                        <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                            <input type='hidden' name='id_etat' value='5'>
                            <button type="submit" class="btn btn-sm btn-warning exclude-cell">Annulée</button>
                            <input type="hidden" name="action" value="etat">
                        </form>
                        &nbsp;
                        <form action='index.php?action=pdf&id=<?=$id?>&id_conges=<?=$id_conges?>' method='post'>
                              <button type='submit' class='btn btn-sm btn-primary exclude-cell'>Pdf</button>
                        </form>
                        </div>
                    </td>
                    <td class="exclude-cell" style="display:none;" data-id="<?= $id_conges ?>"><?= $crud->id_raison ?></td>
                    <td class="exclude-cell" style="display:none;" data-id="<?= $id_conges ?>"><?= $crud->id_etat ?></td>
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
<script src='assets/js/moment.js'></script>
<script type="text/javascript">
    //Javascript pour le filtrage (en attente, acceptée, etc)
    var table = document.getElementById('table');
    const checkboxes = [
    document.getElementById('inlineCheckbox1'),
    document.getElementById('inlineCheckbox2'),
    document.getElementById('inlineCheckbox3'),
    document.getElementById('inlineCheckbox4')
    ];

    const selectedStates = [];

    for (const checkbox of checkboxes) {
        checkbox.addEventListener("change", function() {
            if (checkbox.checked) {
                selectedStates.push(checkbox.value);
            } else {
                selectedStates.splice(selectedStates.indexOf(checkbox.value), 1);
            }
            for (let i = 1; i < table.rows.length; i++) {
                const row = table.rows[i];
                if (selectedStates.indexOf(row.cells[7].textContent) === -1) {
                    row.style.display = "none";
                } else {
                    row.style.display = "table-row";
                }
            }
            if (selectedStates.length === 0) {
                for (let i = 1; i < table.rows.length; i++) {
                  table.rows[i].style.display = "table-row";
                }
            }
        });
    }

    
    function treatAsUTC(date) {
        var result = new Date(date);
        result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
        return result;
    }
    
    // Récupération des données de la cellule lorsque le bouton "Modifier" est cliqué
    var editButtons = document.querySelectorAll(".update");

    editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var dataId = button.getAttribute("data-id");
        var row = document.querySelector(`td[data-id="${dataId}"]`).parentNode;
        //Stockage de toutes les cellules du tableau dans une var
        var dataCell = row.querySelector("td:nth-child(2)").textContent;
        var dataCell2 = row.querySelector("td:nth-child(3)").textContent;
        var cellData3 = row.querySelector("td:nth-child(4)").textContent;
        var cellData4 = row.querySelector("td:nth-child(5)").textContent;
        var cellData5 = row.querySelector("td:nth-child(6)").textContent;
        var cellData6 = row.querySelector("td:nth-child(12)").textContent;
        var cellData7 = row.querySelector("td:nth-child(13)").textContent;
        var cellData8 = row.querySelector("td:nth-child(9)").textContent;
        //Envoie des dates au modal
        //du à des problème de format de date, nous utilisons moment.js
        //une librairie JS pour les format de date
        var dateMomentObject = moment(dataCell, "DD.MM.YYYY HH:mm");
        var dateMomentObject2 = moment(dataCell2, "DD.MM.YYYY HH:mm");
        var dataDate = dateMomentObject.toDate();
        var dataDate2 = dateMomentObject2.toDate();
        dataDate.setHours(dataDate.getHours() - 3);
        dataDate2.setHours(dataDate2.getHours() - 3);
        var dateInput = document.querySelector("#date_debut");
        dateInput.value = dataDate.toISOString().slice(0 ,16);
        var dateInput2 = document.querySelector("#date_fin");
        dateInput2.value = dataDate2.toISOString().slice(0 ,16);
        
        console.log(dataDate);
        console.log(dataDate2);
        
        //Envoie des options de temps au modal
        var optionValue = cellData3;
        var selectInput = document.querySelector("#time");
        selectInput.value = optionValue;
        var option = document.createElement("option");
        option.textContent = optionValue;
        option.value = optionValue;
        
        var optionValue2 = cellData4;
        var selectInput2 = document.querySelector("#time2");
        selectInput2.value = optionValue2;
        var option2 = document.createElement("option");
        option2.textContent = optionValue2;
        option2.value = optionValue2;
        
        //Envoie des options de raison et d'état au modal
        var optionValue4 = cellData6;
        var selectInput4 = document.querySelector("#raison");
        selectInput4.value = optionValue4;
        var option4 = document.createElement("option");
        option4.textContent = optionValue4;
        option4.value = optionValue4;
        
        var optionValue5 = cellData7;
        var selectInput5 = document.querySelector("#etat");
        selectInput5.value = optionValue5;
        var option5 = document.createElement("option");
        option5.textContent = optionValue5;
        option5.value = optionValue5;
        
        //Envoie des valeur d'input au modal
        document.querySelector("#commentaire").value = cellData8;
        document.querySelector("#dataId").value = dataId;
        document.querySelector("#duration").value = cellData5;
        
        setTimeout(difference,1000);
        
        function difference(){
            setTimeout(difference,1000);
        var time = document.querySelector('#time').selectedIndex;
        var time2 = document.querySelector('#time2').selectedIndex;
        var date1 = new Date(document.querySelector('#date_debut').value);
        var date2 = new Date(document.querySelector('#date_fin').value);
        var millisecondsPerDay = 24 * 60 * 60 * 1000;
        const diffDays = ((treatAsUTC(date2) - treatAsUTC(date1)) / millisecondsPerDay);
        
        // Get the difference in whole weeks
        var wholeWeeks = diffDays / 7 | 0;

        // Estimate business days as number of whole weeks * 5
        var days = wholeWeeks * 5;

        // If not even number of weeks, calc remaining weekend days
        if (diffDays % 7) {
          date1.setDate(date1.getDate() + wholeWeeks * 7);

          while (date1 < date2) {
            date1.setDate(date1.getDate() + 1);

            // If day isn't a Sunday or Saturday, add to business days
            if (date1.getDay() !== 6 && date1.getDay() !== 6) {
              ++days;
            }
          }
        }
        
        if(time === 1 && time2 === 0){
            days = (days - 1);
        }
        if(time === 1 && time2 === 1){
            days = (days - 0.5);
        }
        if(time === 0 && time2 === 0){
            days = (days - 0.5);
        }
        
        document.querySelector('#duration').value = days + 1;
        }
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
        column3 = row.cells[2].innerText;
        column4 = row.cells[3].innerText;
        column5 = row.cells[4].innerText;
        column6 = row.cells[5].innerText;
        column7 = row.cells[6].innerText;
        column8 = row.cells[7].innerText;
        column9 = row.cells[8].innerText;
        column10 = row.cells[9].innerText;
 
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
                column9,
                column10
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
        link.setAttribute("download", "Conges-"+today+".csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
}
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>