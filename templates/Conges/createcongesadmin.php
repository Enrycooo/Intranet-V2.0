<?php ob_start();?>

<div class="container-fluid px-4 py-2">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-6 text-center"><div class="card">
                <h5 class="mb-4">Intranet Landry-Sintec AVI</h5>
                <form name="form3" action='index.php?action=createCongesAdmin&id=<?=$id?>' method='post'>
                    <div class="row">
                        <div class="col-sm-8 flex-column d-flex"> 
                            <label class="form-control-label px-3">Utilisateur<span class="text-danger"></span></label>
                            <select class="select form-control-lg" name="id_employe">
                                <option value="0" disabled>Choisissez un utilisateur</option>
                                <?php
                                foreach($users as $user){
                                ?>
                                <option value="<?= htmlspecialchars($user->id_employe) ?>">
                                <?= htmlspecialchars($user->nom.' '.$user->prenom) ?></option>
                                <?php
                                } 
                                ?>
                             </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Date de début<span class="text-danger"></span></label> 
                            <input type="date" id="date_debut" name="date_debut"> 
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
                            <input type="date" id="date_fin" name="date_fin"> 
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
                            <select class="select form-control-lg" name="id_raison">
                                <option value="0" disabled>Choisissez une raison</option>
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
                            <label class="form-control-label px-3">Duree<span class="text-danger"></span></label> 
                            <input type="text" id="duration" name="duree" value=""> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12  flex-column d-flex"> 
                            <label class="form-control-label">Commentaire<span class="text-danger"></span></label>
                            <input type="text" id="commentaire" name="commentaire" onclick="difference()"> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12"> 
                            <button type="submit" class="btn btn-primary" onclick="difference()">Faire la demande</button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
window.onclick = difference;
function treatAsUTC(date) {
    var result = new Date(date);
    result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
    return result;
}

function difference(){
        var time = document.getElementById("time").selectedIndex;
        var time2 = document.getElementById("time2").selectedIndex;
        var date1 = new Date(document.getElementById('date_debut').value);
        var date2 = new Date(document.getElementById('date_fin').value);
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
        
        document.getElementById('duration').value = days + 1;
}
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>