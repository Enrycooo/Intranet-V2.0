<?php ob_start();?>
<section>
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3">
          <div class="row">
            <div class="col-md-11">
              <div class="card-body">
                <h6>Information perso</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-12 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?= $cruds->email ?></p>
                  </div>
                </div>
                <hr>
                <div class="row pt-1">
                  <div class="col-3 mb-3">
                    <h6>Nom</h6>
                    <p class="text-muted"><?= $cruds->nom ?></p>
                  </div>
                  <div class="col-3 mb-3">
                    <h6>Prenom</h6>
                    <p class="text-muted"><?= $cruds->prenom ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Nom d'utilisateur</h6>
                    <p class="text-muted"><?= $cruds->username ?></p>
                  </div>
                </div>
                <hr>
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Service</h6>
                    <p class="text-muted"><?= $cruds->service ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Poste</h6>
                    <p class="text-muted"><?= $cruds->poste ?></p>
                  </div>
                </div>
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Jours de congés disponible</h6>
                    <p class="text-muted"><?= $cruds->conges_dispo ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $content = ob_get_clean();?>

<?php require('templates/layout.php') ?>
