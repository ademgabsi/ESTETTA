<?php

?>
<nav>
  <a href="Acceuil.php"><img style="border-radius: 100%;width: 100px;" class="logo-estetta"
      src="http://localhost:8083/projetWeb2A-2A11-G6/Assets/FrontOffice/images/Logo.png" alt="logo.png" /></a>
  <div class="nav-links" id="navLinks">
    <i class="fa fa-times" onclick="hideMenu()"></i>
    <ul>
      <li>
        <a href="http://localhost:8083/projetWeb2A-2A11-G6/View/FrontOffice/Acceuil.php">HOME</a>
      </li>
      <li>
        <a href="http://localhost:8083/projetWeb2A-2A11-G6/View/FrontOffice/Acceuil.php#type_of_courses">COURSES</a>
      </li>
      <li>
        <a href="http://localhost:8083/projetWeb2A-2A11-G6/View/FrontOffice/ModuleEvent/events.php">EVENTS</a>
      </li>
      <li>
        <a href="http://localhost:8083/projetWeb2A-2A11-G6/View/FrontOffice/ModuleForum/forumList.php">FORUM</a>
      </li>
      <li>
        <a
          href="http://localhost:8083/projetWeb2A-2A11-G6/View/FrontOffice/ModuleReclamation/reclamationList.php">RECLAMATION</a>
      </li>
      <li>
        <!--lahna lazem nzidou verification kn aml login thezou ll profil.php makanech thezou ll login.php -->
        <a href="http://localhost:8083/projetWeb2A-2A11-G6/View/FrontOffice/profilFront.php">PROFIL</a>
      </li>

      <?php if ($connectedUser["role"] == 1 || $connectedUser["role"] == 0 ) {
        ?>
        <li>
          <a href="http://localhost:8083/projetWeb2A-2A11-G6/View/BackOffice/dashboard.php">DASHBOARD</a>
        </li>
      <?php } ?>

    </ul>
  </div>
  <i class="fa fa-bars" onclick="showMenu()"></i>
</nav>