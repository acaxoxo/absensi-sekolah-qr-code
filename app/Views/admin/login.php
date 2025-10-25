 <?= $this->extend('templates/starting_page_layout'); ?>

 <?= $this->section('navaction') ?>
 <a href="<?= base_url('/'); ?>" class="btn btn-primary pull-right pl-3">
    <i class="material-icons mr-2">qr_code</i>
    Scan QR
 </a>
 <?= $this->endSection() ?>

 <?= $this->section('content'); ?>
 <div class="main-panel auth-page">
    <div class="content w-100">
       <div class="container-fluid d-flex justify-content-center">
          <div class="auth-card card">
             <div class="card-header">
                <div class="auth-brand text-center w-100">
                   <img src="<?= base_url('assets/img/new_logo.png'); ?>" alt="Logo">
                   <div class="text-center">
                      <h4 class="card-title m-0 text-white">Login Petugas</h4>
                      <p class="card-category auth-subtitle">Silakan masukkan kredensial Anda</p>
                   </div>
                </div>
             </div>

             <div class="card-body px-4 pb-4 pt-2">
                <?= view('\\App\\Views\\admin\\_message_block') ?>
                <form action="<?= url_to('login') ?>" method="post">
                         <?= csrf_field() ?>
                         <div class="row">
                            <div class="col-md-12">
                               <?php if ($config->validFields === ['email']) : ?>
                                  <div class="form-group">
                                     <label class="bmd-label-floating"><?= lang('Auth.email') ?></label>
                                     <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" autofocus>
                                     <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                     </div>
                                  </div>
                               <?php else : ?>
                                  <div class="form-group">
                                     <label class="bmd-label-floating"><?= lang('Auth.emailOrUsername') ?></label>
                                     <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" autofocus>
                                     <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                     </div>
                                  </div>
                               <?php endif; ?>
                            </div>
                         </div>
                         <div class="row mt-2">
                            <div class="col-md-12">
                               <div class="form-group password-wrapper">
                                  <label class="bmd-label-floating">Password</label>
                                  <input id="passwordField" type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>">
                                  <span class="material-icons password-toggle" onclick="togglePassword()">visibility</span>
                                  <div class="invalid-feedback">
                                     <?= session('errors.password') ?>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <!-- <button type="submit" class="btn btn-primary col-md-12">Login</button> -->
                         <?php if ($config->allowRemembering) : ?>
                            <div class="form-check">
                               <label class="form-check-label">
                                  <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                  <?= lang('Auth.rememberMe') ?>
                               </label>
                            </div>
                         <?php endif; ?>
                         <div class="mt-3">
                           <button type="submit" class="btn btn-primary btn-block w-100"><?= lang('Auth.loginAction') ?></button>
                         </div>
                                     <?php if ($config->activeResetter) : ?>
                                        <p class="mt-3 mb-0 text-center"><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                                     <?php endif; ?>

                                     <div class="auth-actions text-center mt-2">
                                        <a href="<?= base_url('/') ?>" class="btn btn-link p-0 auth-qr-link">
                                           <i class="material-icons" style="vertical-align: middle; font-size: 18px; margin-right: 4px;">qr_code</i>
                                           <span class="align-middle">Scan QR tanpa login</span>
                                        </a>
                                     </div>
                         <div class="clearfix"></div>
                      </form>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <script>
   function togglePassword() {
     const field = document.getElementById('passwordField');
     const toggle = document.querySelector('.password-toggle');
     const isPassword = field.getAttribute('type') === 'password';
     field.setAttribute('type', isPassword ? 'text' : 'password');
     toggle.textContent = isPassword ? 'visibility_off' : 'visibility';
   }
 </script>
 <?= $this->endSection(); ?>