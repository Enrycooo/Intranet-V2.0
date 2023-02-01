<?php ob_start(); ?>
<script src='templates/Calendar/dist/index.global.js'></script>
<script src='templates/Calendar/packages/jquery/jquery.js'></script>
<script src="templates/Calendar/packages/core/locales/fr.global.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src='assets/js/moment.js'></script>
<script type="module">
//DOMContentLoaded permet de lancer la fonction au lancement de la page
document.addEventListener('DOMContentLoaded', function() {
    //Permet de lier le JS avec la div ayant l'id calendar
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        eventTimeFormat: { // Içi on choisis le format des dates par exemple le code suivant produit 28/03/2023
            month: '2-digit',
            year: 'numeric',
            day: '2-digit'
        },
        locale:'fr', //on dit au calendrier que la langue est le français, pour que ça marche, il faut link le fichier fr.global.js comme au dessus
        headerToolbar: { //on défini qu'est ce qu'il y auras au dessus du calendrier
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        <?php 
        if($_SESSION['id_poste'] !==2){
        echo 'navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,'; //permet de cliquer sur les évènements du calendar
        }
        ?>
        eventSources: [ //On défini la sources des évènements
        {
          url: 'templates/Calendar/api/load.php'
        }
        ],
        <?php
        if($_SESSION['id_poste'] !== 2){
        echo "
        eventClick: function(info) { //eventClick execute la fonction qui suit si l'on clique sur un évènements
            openEditModal(info.event);
            function openEditModal(event) {
            
                var options = {
                    'backdrop' : 'static',
                    'show':true,
                    'display': 'block'
                };
                //le code ci-dessous permet d'insérer les données présentes sur l'events dans le modal
                let start = event.start.toString();
                let end = event.end.toString();
                let dataDate = new Date(start);
                let dataDate2 = new Date(end);
                
                //on enlève 3h aux dates car il s'agissait des dates UTC0 alors qu'on est UTC-3
                dataDate.setHours(dataDate.getHours() - 3);
                dataDate2.setHours(dataDate2.getHours() - 3);
                
                //insert id, title and date to modal
                document.querySelector('#event-id').value = event.id;
                var dateInput = document.querySelector('#event-start');
                dateInput.value = dataDate.toISOString().slice(0 ,16);
                var dateInput2 = document.querySelector('#event-end');
                dateInput2.value = dataDate2.toISOString().slice(0 ,16);
                document.cookie = 'js_var_value = ' + localStorage.value;
                
                //Ajax pour l'affichage du reste des données car il manquais les 3/4
                $.ajax({
                    type: 'POST',
                    url: 'templates/Calendar/api/getevent.php',
                    data: {
                        'id': event.id
                    },
                    success: function(response) {
                        
                        // parse the JSON response
                        var eventData = JSON.parse(response);

                        // update the modal with event data
                        var optionValue = eventData.id_raison;
                        var selectInput = document.querySelector('#id_raison');
                        selectInput.value = optionValue;
                        var option = document.createElement('option');
                        option.textContent = optionValue;
                        option.value = optionValue;
                        
                        var optionValue2 = eventData.id_etat;
                        var selectInput2 = document.querySelector('#id_etat');
                        selectInput2.value = optionValue2;
                        var option2 = document.createElement('option');
                        option2.textContent = optionValue2;
                        option2.value = optionValue2;
                        
                        var optionValue3 = eventData.debut_type;
                        var selectInput3 = document.querySelector('#time');
                        selectInput3.value = optionValue3;
                        var option3 = document.createElement('option');
                        option3.textContent = optionValue3;
                        option3.value = optionValue3;
                        
                        var optionValue4 = eventData.fin_type;
                        var selectInput4 = document.querySelector('#time2');
                        selectInput4.value = optionValue4;
                        var option4 = document.createElement('option');
                        option4.textContent = optionValue4;
                        option4.value = optionValue4;
                        
                        document.querySelector('#duree').value = eventData.duree;
                        document.querySelector('#commentaire').value = eventData.commentaire;
                        document.querySelector('#nom').value = eventData.nom;
                        document.querySelector('#prenom').value = eventData.prenom;
                    }
                });
                
                // afficher le modal
                var modal = document.getElementById('editeventmodal');
                modal.style.display = 'block';
                // Pour la modification, je fais appel à du php plus besoin de AJAX ni JS
            }
        }";
        }
        else{
        echo "
        eventClick: function(info) {
            openEditModal(info.event);
            function openEditModal(event) {
            
                var options = {
                    'backdrop' : 'static',
                    'show':true,
                    'display': 'block'
                };
                let start = event.start.toString();
                let end = event.end.toString();
                let dataDate = new Date(start);
                let dataDate2 = new Date(end);
                
                dataDate.setHours(dataDate.getHours() - 3);
                dataDate2.setHours(dataDate2.getHours() - 3);
                
                //insert id, title and date to modal
                document.querySelector('#event-id').value = event.id;
                var dateInput = document.querySelector('#event-start');
                dateInput.value = dataDate.toISOString().slice(0 ,16);
                var dateInput2 = document.querySelector('#event-end');
                dateInput2.value = dataDate2.toISOString().slice(0 ,16);
                document.cookie = 'js_var_value = ' + localStorage.value;
                
                //Ajax pour l'affichage du reste des données
                $.ajax({
                    type: 'POST',
                    url: 'templates/Calendar/api/getevent.php',
                    data: {
                        'id': event.id
                    },
                    success: function(response) {
                        
                        // parse the JSON response
                        var eventData = JSON.parse(response);
                        
                        // update the modal with event data
                        var optionValue3 = eventData.debut_type;
                        var selectInput3 = document.querySelector('#time');
                        selectInput3.value = optionValue3;
                        var option3 = document.createElement('option');
                        option3.textContent = optionValue3;
                        option3.value = optionValue3;
                        
                        var optionValue4 = eventData.fin_type;
                        var selectInput4 = document.querySelector('#time2');
                        selectInput4.value = optionValue4;
                        var option4 = document.createElement('option');
                        option4.textContent = optionValue4;
                        option4.value = optionValue4;
                        
                        document.querySelector('#nom').value = eventData.nom;
                        document.querySelector('#prenom').value = eventData.prenom;
                    }
                });
                
                // afficher le modal
                var modal = document.getElementById('editeventmodal');
                modal.style.display = 'block';
            }
        }";
        }
        ?>
    });
    calendar.render();
  });
  function fermer(){
    var modal = document.getElementById('editeventmodal');
                modal.style.display = 'none';
  }
  document.getElementById("fermer").addEventListener("click", fermer);
</script>
<style>
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
<?php
if($_SESSION['id_poste'] !== 2){
?>
<!-- Edit modal -->
<div class="modal" id="editeventmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=calendarconges&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de début<span class="text-danger"></span></label> 
                    <input type="datetime-local" id="event-start" name="date_debut"> 
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
                    <input type="datetime-local" id="event-end" name="date_fin"> 
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
                    <select class="select form-control-lg" name="raison" id="id_raison">
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
                    <select class="select form-control-lg" name="etat" id="id_etat">
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
                    <input type="text" id="duree" name="duree" value=""> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label">Nom de l'employe<span class="text-danger"></span></label>
                    <input type="text" id="nom" disabled> 
                </div>
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Prenom de l'employe<span class="text-danger"></span></label> 
                    <input type="text" id="prenom" disabled> 
                </div>
            </div>
            <input type="hidden" id="event-id" name="id_conges">
            <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id='fermer'>Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary" >Modifier le congés</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<?php
}else{
?>
<!-- Edit modal -->
<div class="modal" id="editeventmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=calendarconges&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de début<span class="text-danger"></span></label> 
                    <input type="datetime-local" id="event-start" name="date_debut" disabled> 
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time" name='debut_type' disabled>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de fin<span class="text-danger"></span></label> 
                    <input type="datetime-local" id="event-end" name="date_fin" disabled> 
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time2" name='fin_type' disabled>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Duree<span class="text-danger"></span></label> 
                    <input type="text" id="duree" name="duree" value="" disabled> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label">Nom de l'employe<span class="text-danger"></span></label>
                    <input type="text" id="nom" disabled> 
                </div>
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Prenom de l'employe<span class="text-danger"></span></label> 
                    <input type="text" id="prenom" disabled> 
                </div>
            </div>
            <input type="hidden" id="event-id" name="id_conges">
            <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id='fermer'>Fermer</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<?php
}
?>
<center>
    <div class="form-check form-check-inline">
            <span class='badge bg-warning'>En attente</span>
        </div>
        <div class="form-check form-check-inline">
            <span class='badge bg-success'>Acceptée</span>
        </div>
        <div class="form-check form-check-inline">
            <span class='badge bg-danger'>Annulée</span>
        </div>
        <div class="form-check form-check-inline">
            <span class='badge bg-danger'>Rejetée</span>
        </div>
</center>
  <div id='calendar'></div>
  
<script type="text/javascript">
    function treatAsUTC(date) {
        var result = new Date(date);
        result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
        return result;
    }
    
    setTimeout(difference,1000);
    function difference(){
        setTimeout(difference,1000);
        var time = document.querySelector('#time').selectedIndex;
        var time2 = document.querySelector('#time2').selectedIndex;
        var date1 = new Date(document.querySelector('#event-start').value);
        var date2 = new Date(document.querySelector('#event-end').value);
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
            if (date1.getDay() !== 6 && date1.getDay() !== 0) {
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
        
        document.querySelector('#duree').value = days + 1;
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php') ?>