<header class="main-header">

    <!-- Logo -->
    <a href="/admin/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
     <!-- <img src="/adminlte/img/logo/fastenservices.png" alt="Logo" class="logo-mini" ><br>-->
      <span class="logo-mini">SCA</span>

      <!-- logo for regular state and mobile devices -->
      <!--<img src="/adminlte/img/logo/fastenservices.png" alt="Logo" width="135">-->
      <span class="logo-lg">Control de Archivos</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Navegación</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less
          <li class="dropdown messages-menu">
            <!-- Menu toggle button
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tiene 4 mensajes</li>
              <li>
                <!-- inner menu: contains the messages
                <ul class="menu">
                  <li><!-- start message
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image
                        <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp
                      <h4>
                        Equipo de apoyo
                        <small><i class="fa fa-clock-o"></i> 5 minutos</small>
                      </h4>
                      <!-- The message
                      <p></p>
                    </a>
                  </li>
                  <!-- end message
                </ul>
                <!-- /.menu
              </li>
              <li class="footer"><a href="#">Ver todas las tareas</a></li>
            </ul>
          </li>-->
          <!-- /.messages-menu -->

          <!-- Notifications Menu
          <li class="dropdown notifications-menu">
             Menu toggle button
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tiene 10 notificaciones</li>
              <li>
                 Inner Menu: contains the notifications
                <ul class="menu">
                  <li> start notification
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 nuevos miembros se unieron hoy
                    </a>
                  </li>
                   end notification
                </ul>
              </li>
              <li class="footer"><a href="#">Ver Todo</a></li>
            </ul>
          </li>-->
          <!-- Tasks Menu
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 9 tareas</li>
              <li>
                <!-- Inner menu: contains the tasks
                <ul class="menu">
                  <li><!-- Task item
                    <a href="#">
                      <!-- Task title and progress text
                      <h3>
                        Diseño de los botones
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Completo</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item
                </ul>
              </li>
              <li class="footer">
                <a href="#">Ver todas las tareas</a>
              </li>
            </ul>
          </li> -->
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/adminlte/img/default-50x50.gif" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/adminlte/img/default-50x50.gif" class="img-circle" alt="User Image">


                <p>
                  {{ Auth::user()->name }}

                </p>
              </li>
              <!-- Menu Body
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Seguidores</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Ventas</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Amigos</a>
                  </div>
                </div>
                <!-- /.row
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Cerrar sesion</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
