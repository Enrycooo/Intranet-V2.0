<?php ob_start(); ?>
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-6 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Toutes les Logs de connexion !</h4>
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
                <th>date de connexion</th>
                <th>adresse ip</th>
                <th>username</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_log = $crud->id_log;
                ?>
                <tr>
                    <td data-id="<?= $id_log ?>"><?= $id_log ?></td>
                    <td data-id="<?= $id_log ?>"><?= $crud->date_connexion ?></td>
                    <td data-id="<?= $id_log ?>"><?= $crud->ip_adress ?></td>
                    <td data-id="<?= $id_log ?>"><?= $crud->username ?></td>
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
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>