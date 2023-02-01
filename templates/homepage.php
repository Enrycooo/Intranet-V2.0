<?php ob_start(); ?>

<div class="vh-100 d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card bg-white shadow-lg">
         <div class="border border-1 border-primary"></div>
          <div class="card-body p-5">
            <form name="form1" action='index.php?action=connection' method='post' class="mb-3 mt-md-4">
              <h2 class="fw-bold mb-2 text-uppercase ">Intranet</h2>
              <p class=" mb-5">Veuillez entrer votre nom d'utilisateur et mot de passe !</p>
              <div class="mb-3">
                <label for="username" class="form-label ">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" placeholder="exemple" name='username'>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label ">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="*******" name='password'>
              </div>
              <div class="d-grid">
                <input  class="btn btn-primary btn-lg btn-block" name="submit" type="submit" id="submit" value="Login">
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
