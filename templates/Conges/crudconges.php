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
      <div class="col-lg-11 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Toutes les demandes de congés!</h4>
        </div>
        <div>
            <form name="form4" action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                <select class="select form-control-lg" name="id_entite" id="entite">
                        <option value="0" hidden>Choisissez une entité</option>
                        <?php
                        foreach($entites as $entite){
                        ?>
                        <option value="<?= $entite->id_entite ?>">
                        <?= $entite->libelle ?></option>
                        <?php
                        } 
                        ?>
                        <option value='tous'>Toutes les entité</option>
                     </select>
                <input name='action' value='choose_entite' hidden>
                <button class='btn btn-primary' type='submit'>Choisir cette entité</button>
            </form>
        </div>
        <div>
            <a class="btn btn-danger" href="index.php?action=createCongesAdmin&id=<?=$id?>"><i class="fas fa-heart pe-2"></i>Ajouter un congés</a>
        </div>
      </div>
    </div>
    <hr>
    <?php
    if($cruds !== null){
    ?>
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
      <div class="col-lg-16">
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
                <th style="display:none;">Commentaire</th>
                <th style="display:none;">id</th>
                <th style="display:none;">id</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_conges = $crud->id_conges;
                ?>
                <tr>
                    <td data-id="<?= $id_conges ?>"><?= $id_conges ?></td>
                    <td class="col-1" data-id="<?= $id_conges ?>"><?= $crud->date_debut ?></td>
                    <td class="col-1" data-id="<?= $id_conges ?>"><?= $crud->date_fin ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->debut_type ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->fin_type ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->duree ?></td>
                    <td class="col-1" data-id="<?= $id_conges ?>"><?= $crud->raison ?></td>
                    <?php
                        if($crud->etat == 'En attente'){echo "<td data-id=".$id_conges."><span class='badge bg-warning'>" . $crud->etat . "</span></td>";}
                        elseif($crud->etat == 'Acceptee'){echo "<td data-id=".$id_conges."><span class='badge bg-success'>" . $crud->etat . "</span></td>";}
                        elseif($crud->etat !== ''){echo "<td data-id=".$id_conges."><span class='badge bg-danger' style='background-color: #ff0000;'>" . $crud->etat . "</span></td>";}
                    ?>
                    <td class="col-1" data-id="<?= $id_conges ?>"><?= $crud->nom ." ". $crud->prenom?></td>
                    <td data-id="<?= $id_conges ?>" hidden><?= $crud->commentaire ?></td>
                    <td>
                        <div class='d-flex text-center'>
                            <?php
                            if($crud->afficher == 1){
                            ?>
                            <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                                <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                                <button type="submit" class="btn btn-sm btn-danger exclude-cell">cacher du calendrier</button>
                                <input type="hidden" name="action" value="delete">
                            </form>
                            <?php
                            }else{
                            ?>
                            <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                                <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                                <button type="submit" class="btn btn-sm btn-info exclude-cell">montrer dans calendrier</button>
                                <input type="hidden" name="action" value="undelete">
                            </form>
                            <?php
                            }
                            ?>
                            &nbsp;
                            <button data-id="<?= $id_conges ?>" type="button" class="btn btn-sm btn-primary update exclude-cell" data-bs-toggle="modal" data-bs-target="#update">Modifier</button>
                            <?php
                            if($crud->id_etat == 2){
                            ?>
                            &nbsp;
                            <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                                <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                                <input type="hidden" name="id_raison" value="<?=$crud->id_raison?>">
                                <input type="hidden" name="duree" value="<?=$crud->duree?>">
                                <input type="hidden" name="id_employe" value="<?=$crud->id_employe?>">
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
                            <?php
                            }else if($crud->id_etat == 3){
                            ?>
                            &nbsp;
                            <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                                <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                                <input type="hidden" name="duree" value="<?=$crud->duree?>">
                                <input type="hidden" name="id_employe" value="<?=$crud->id_employe?>">
                                <input type="hidden" name="conges_dispo" value="1">
                                <input type='hidden' name='id_etat' value='5'>
                                <button type="submit" class="btn btn-sm btn-warning exclude-cell">Annulée</button>
                                <input type="hidden" name="action" value="etat">
                            </form>
                            <?php
                            }else if($crud->id_etat == 4){
                            ?>
                            &nbsp;
                            <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                                <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                                <input type='hidden' name='id_etat' value='5'>
                                <button type="submit" class="btn btn-sm btn-warning exclude-cell">Annulée</button>
                                <input type="hidden" name="action" value="etat">
                            </form>
                            <?php
                            }else if($crud->id_etat == 5){
                            ?>
                            <?php
                            }
                            ?>
                            &nbsp;
                            <?php
                            if($crud->id_etat !== 2){
                            ?>
                            <form action='index.php?action=pdf&id=<?=$id?>&id_conges=<?=$id_conges?>' method='post'>
                                  <button type='submit' class='btn btn-sm btn-primary exclude-cell'>Pdf</button>
                            </form>
                            <?php
                            }
                            ?>
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
        var cellData8 = row.querySelector("td:nth-child(10)").textContent;
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

  /* Filter the table rows to exclude the last two columns */
  var rows = Array.from(table.rows).map(row => {
    var cells = Array.from(row.cells).slice(0, -4); // Remove the last two cells
    return cells.map(cell => cell.innerText);
  });

  /* Create a new workbook */
  var workbook = XLSX.utils.book_new();

  /* Add the filtered rows to a new worksheet */
  var worksheet = XLSX.utils.sheet_add_aoa(XLSX.utils.json_to_sheet(rows), []);

  /* Add the worksheet to the workbook */
  XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

  /* Save the workbook as an Excel file */
  XLSX.writeFile(workbook, "conges-"+today+".xlsx");
}

</script>
    <?php }
    $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>