<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">QG</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>10&ordf; Bda Inf Mtz</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?php echo $_SESSION['nome']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  <?php echo $_SESSION['nome']; ?>
                  <small><?php echo $_SESSION['funcao']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#altera-senha" onclick="alteraSenha()">Senha</a>
                </div>
                <div class="pull-right">
                    <a href="../includes/logoff.php" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="operador.php">
            <i class='fa fa-user'></i><span>Visitantes</span>
          </a>
        </li>
        <li>
            <a href="usuarios.php">
            <i class="fa fa-users" aria-hidden="true"></i><span>Usu&aacute;rios</span>
          </a>
        </li>
        <li>
            <a href="visitas.php">
            <i class='fa fa-sign-in' aria-hidden="true"></i><span>Controle de Visitas</span>
          </a>
        </li>
        <li>
            <a href="locais.php">
            <i class="fa fa-stop-circle-o"></i><span>Locais</span>
          </a>
        </li>
        <li>
            <a href="militares.php">
            <i class="fa fa-user-secret" aria-hidden="true"></i><span>Militares</span>
          </a>
        </li>
        <li>
            <a href="graficos.php">
            <i class="fa fa-area-chart" aria-hidden="true"></i><span>Gr&aacute;ficos</span>
          </a>
        </li>
        <li>
            <a href="graficos.php">
            <i class="fa fa-file" aria-hidden="true"></i><span>Roteiro dos Postos</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
    </section>

