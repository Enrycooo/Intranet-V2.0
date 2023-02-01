<?php ob_start(); ?>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name='form4' action='index.php?action=crudusers&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
            <div class="row">
                <h1 class='text-center'>Etes-vous sûre ?</h1>
            </div>
            <input type="hidden" id="id_employe" name='id_employe' value='<?=$id_employe?>'>
            <input type="hidden" name="action" value="delete">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn btn-danger">Supprimer</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<div class="modal fade" id="ajoutconges" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=crudusers&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="form3">Ajouter des jours de congés</label>
          <input type="text" id="form3" class="form-control validate" name='conges'>
          
          <label data-error="wrong" data-success="right" for="form3">Motif de l'ajout</label>
          <input type="text" id="form3" class="form-control validate" name='motif'>
          
          <input type="hidden" id="id" name='id_employe' value='<?=$id_employe?>'>
          <input type="hidden" name="action" value="conges">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Ajouter les jours</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
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
      <form name="form4" action='index.php?action=crudusers&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3" for="Nom">Nom</label>
                    <input type="text" id="Nom" name='nom' required/>
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3" for="Prenom">Prenom</label>  
                    <input type="text" id="Prenom" name='prenom' required/>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex"> 
                        <label class="form-control-label px-3" for="email">Email</label>
                        <input type="email" id="email" name='email' required/>
                    </div>
                    <div class="col-sm-6 flex-column d-flex"> 
                        <label class="form-control-label px-3" for="email">Téléphone</label>
                        <input type="text" id="telephone" name='telephone' required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class=form-control-label px-3" for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name='username' required/>
                  </div>
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3" for="password">Mot de passe</label>
                        <input type="password" id="password" name='password' required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-label select-label">Choisissez le poste</label>
                        <select class="select form-control-lg" name="poste" required/>
                        <option></option>
                        <?php
                        foreach($postes as $poste){ 
                            ?>
                        <option value="<?= htmlspecialchars($poste->id_poste) ?>">
                        <?= htmlspecialchars($poste->libelle) ?></option>
                        <?php
                        } 
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-label select-label">Choisissez le service</label>
                        <select class="select form-control-lg" name="service" required/>
                        <option></option>
                        <?php
                        foreach($services as $service){
                            ?>
                        <option value="<?= htmlspecialchars($service->id_service) ?>">
                        <?= htmlspecialchars($service->libelle) ?></option>
                        <?php
                        }
                        ?>
                         </select>
                    </div>
                </div>
            <input type="hidden" name="action" value="create">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Créer un utilisateur</button>
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
      <form name="form4" action='index.php?action=crudusers&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3" for="Nom">Nom</label>
                    <input type="text" id="nomedit" name='nom' required/>
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3" for="Prenom">Prenom</label>  
                    <input type="text" id="prenomedit" name='prenom' required/>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex"> 
                        <label class="form-control-label px-3" for="email">Email</label>
                        <input type="email" id="emailedit" name='email' required/>
                    </div>
                    <div class="col-sm-6 flex-column d-flex"> 
                        <label class="form-control-label px-3" for="email">Téléphone</label>
                        <input type="text" id="telephoneedit" name='telephone' required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class=form-control-label px-3" for="username">Nom d'utilisateur</label>
                        <input type="text" id="usernameedit" name='username' required/>
                  </div>
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-control-label px-3" for="password">Mot de passe</label>
                        <input type="password" id="passwordedit" name='password' required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-label select-label">Choisissez le poste</label>
                        <select class="select form-control-lg" id="posteedit" name="poste" required/>
                        <?php
                        foreach($postes as $poste){ 
                            ?>
                        <option value="<?= htmlspecialchars($poste->id_poste) ?>">
                        <?= htmlspecialchars($poste->libelle) ?></option>
                        <?php
                        } 
                        ?>
                        </select>
                    </div>
                    <div class="col-sm-6 flex-column d-flex">
                        <label class="form-label select-label">Choisissez le service</label>
                        <select class="select form-control-lg" id="serviceedit" name="service" required/>
                        <?php
                        foreach($services as $service){
                            ?>
                        <option value="<?= htmlspecialchars($service->id_service) ?>">
                        <?= htmlspecialchars($service->libelle) ?></option>
                        <?php
                        }
                        ?>
                         </select>
                    </div>
                </div>
          <hr>
                <div class="row">
                    <div class="col-sm-6 flex-column d-flex">
                        <label class=form-control-label px-3" for="username">Nombre de congés dispo</label>
                        <input type="text" id="conges_dispo" name='conges_dispo' required/>
                    </div>
                </div>
          <input type="hidden" id="dataId" name="id_employe">
          <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
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
          <h4 class="text-primary">Tout les utilisateurs !</h4>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            Ajouter un nouvelle utilisateur
            </button>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered text-center" id="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>nom</th>
                <th>prenom</th>
                <th>username</th>
                <th>email</th>
                <th>telephone</th>
                <th>poste</th>
                <th>Service</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_employe = $crud->id_employe;
                ?>
                <tr>
                    <td data-id="<?= $id_employe ?>"><?= $id_employe ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->nom?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->prenom?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->username ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->email ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->telephone ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->poste ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->service ?></td>
                    <td style="display:none;" data-id="<?= $id_employe ?>"><?= $crud->id_poste ?></td>
                    <td style="display:none;" data-id="<?= $id_employe ?>"><?= $crud->id_service ?></td>
                    <td style="display:none;" data-id="<?= $id_employe ?>"><?= $crud->conges_dispo ?></td>
                    <td>
                        <div class='d-flex text-center'>
                            <button data-id="<?= $id_employe ?>" type="button" class="btn btn-sm btn-primary update" data-bs-toggle="modal" data-bs-target="#update">Modifier</button>
                            &nbsp;
                            <button data-id="<?= $id_employe ?>" type="button" class="btn btn-sm btn-primary ajoutconges" data-bs-toggle="modal" data-bs-target="#ajoutconges">Congés en +</button>
                            &nbsp;
                            <button data-id='<?= $id_employe ?>' type="button" class="btn btn-sm btn-danger delete" data-bs-toggle="modal" data-bs-target="#delete">Supprimer</button>
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
    var editButtons = document.querySelectorAll(".delete");

    editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var dataId = button.getAttribute("data-id");
        var row = document.querySelector(`td[data-id="${dataId}"]`).parentNode;
        var cellData1 = row.querySelector("td:nth-child(1)").textContent;

        // Mise des données récupérées dans l'input du modal
        document.querySelector("#id_employe").value = cellData1;
      });
    });
    
    var editButtons = document.querySelectorAll(".ajoutconges");

    editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var dataId = button.getAttribute("data-id");
        var row = document.querySelector(`td[data-id="${dataId}"]`).parentNode;
        var cellData1 = row.querySelector("td:nth-child(1)").textContent;

        // Mise des données récupérées dans l'input du modal
        document.querySelector("#id").value = cellData1;
        console.log(cellData1);
      });
    });
    
    // Récupération des données de la cellule lorsque le bouton "Modifier" est cliqué
    var editButtons = document.querySelectorAll(".update");

    editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var dataId = button.getAttribute("data-id");
        var row = document.querySelector(`td[data-id="${dataId}"]`).parentNode;
        var cellData1 = row.querySelector("td:nth-child(2)").textContent;
        var cellData2 = row.querySelector("td:nth-child(3)").textContent;
        var cellData3 = row.querySelector("td:nth-child(4)").textContent;
        var cellData4 = row.querySelector("td:nth-child(5)").textContent;
        var cellData5 = row.querySelector("td:nth-child(9)").textContent;
        var cellData6 = row.querySelector("td:nth-child(10)").textContent;
        var cellData7 = row.querySelector("td:nth-child(6)").textContent;
        var cellData8 = row.querySelector("td:nth-child(11)").textContent;

        // Mise des données récupérées dans l'input du modal
        document.querySelector("#nomedit").value = cellData1;
        document.querySelector("#prenomedit").value = cellData2;
        document.querySelector("#usernameedit").value = cellData3;
        document.querySelector("#emailedit").value = cellData4;
        document.querySelector("#telephoneedit").value = cellData7;
        document.querySelector("#conges_dispo").value = cellData8;
        document.querySelector("#dataId").value = dataId;
        
        //Envoie des options de POSTE et SERVICE
        var optionValue2 = cellData5;
        var selectInput2 = document.querySelector("#posteedit");
        selectInput2.value = optionValue2;
        var option2 = document.createElement("option");
        option2.textContent = optionValue2;
        option2.value = optionValue2;
        
        var optionValue5 = cellData6;
        var selectInput5 = document.querySelector("#serviceedit");
        selectInput5.value = optionValue5;
        var option5 = document.createElement("option");
        option5.textContent = optionValue5;
        option5.value = optionValue5;
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
 
    /* add a new records in the array */
        rows.push(
            [
                column1,
                column2,
                column3,
                column4,
                column5,
                column6,
                column7
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
        link.setAttribute("download", "Liste-Users-"+today+".csv");
        document.body.appendChild(link);
         /* download the data file named "Stock_Price_Report.csv" */
        link.click();
}
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>