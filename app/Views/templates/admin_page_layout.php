<!DOCTYPE html>
<html lang="en">

<?= $this->include('templates/head') ?>

<body>
   <div>
      <?= $this->include('templates/sidebar') ?>
      <div class="main-panel">

         <?= $this->include('templates/navbar') ?>

         <?= $this->renderSection('content') ?>

         <?= $this->include('templates/footer') ?>

         <!-- komentar jika tidak dipakai -->
         <?php
         // echo $this->include('templates/fixed_plugin') 
         ?>

      </div>
   </div>

   <!-- Dark Mode Toggle Button -->
   <button class="dark-mode-toggle" id="darkModeToggle" onclick="toggleDarkMode()" title="Toggle Dark Mode">
      <i class="material-icons" id="darkModeIcon">dark_mode</i>
   </button>

   <script>
      // Dark Mode Toggle Script
      function toggleDarkMode() {
         const html = document.documentElement;
         const icon = document.getElementById('darkModeIcon');
         const currentTheme = html.getAttribute('data-theme');
         
         if (currentTheme === 'dark') {
            html.removeAttribute('data-theme');
            icon.textContent = 'dark_mode';
            localStorage.setItem('theme', 'light');
         } else {
            html.setAttribute('data-theme', 'dark');
            icon.textContent = 'light_mode';
            localStorage.setItem('theme', 'dark');
         }
      }

      // Load saved theme on page load
      (function() {
         const savedTheme = localStorage.getItem('theme');
         const icon = document.getElementById('darkModeIcon');
         
         if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            icon.textContent = 'light_mode';
         } else {
            icon.textContent = 'dark_mode';
         }
      })();
   </script>
</body>

</html>