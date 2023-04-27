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
  <script>
    function exportData() {
  /* Get the date of today for the file */
  let today = new Date();
  const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric'};
  today = today.toLocaleDateString('fr-FR', options);

  /* Get the HTML data using Element by Id */
  var table = document.getElementById("table");

  /* Filter the table rows to exclude the last two columns */
  var rows = Array.from(table.rows).map(row => {
    var cells = Array.from(row.cells); // Remove the last two cells
    return cells.map(cell => cell.innerText);
  });

  /* Create a new workbook */
  var workbook = XLSX.utils.book_new();

  /* Add the filtered rows to a new worksheet */
  var worksheet = XLSX.utils.sheet_add_aoa(XLSX.utils.json_to_sheet(rows), []);

  /* Add the worksheet to the workbook */
  XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

  /* Save the workbook as an Excel file */
  XLSX.writeFile(workbook, "log-de-connexion-"+today+".xlsx");
}
  </script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>