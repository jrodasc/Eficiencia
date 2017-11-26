<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/adminlte/img/default-50x50.gif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENÚ </li>
            <!-- Optionally, you can add icons to the links -->
          
            {{-- <li>
                <a href="#">
                    <i class="fa fa-link"></i>
                    <span>Menú</span>
                </a>
            </li> --}}
           
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle"></i>
                    <span>Usuarios y Perfiles</span>
                    </a><ul class="treeview-menu"><a href="#">
                    </a><li><a href="#">
                            </a><a href="/admin/users">
                            <i class="fa fa-user"></i>
                            <span>Usuarios</span>
                            </a>
                        </li>    
                        <li>
                            <a href="/admin/roles">
                            <i class="fa fa-id-badge"></i>
                            <span>Perfiles</span>
                            </a>
                        </li>  </ul>  
            </li>
           
           <!-- <li class="treeview">
                <a href="#">
                    <i class="fa  fa-file-archive-o"></i>
                    <span>Articulos</span>
                    </a><ul class="treeview-menu"><a href="#">
                    </a><li><a href="/admin/articulos">
                            </a><a href="/admin/archivos">
                            <i class="fa  fa-arrow-up"></i>
                            <span>Subir archivos</span>
                            </a>
                        </li>    
                        <li>
                            <a href="/admin/articulos">
                            <i class="fa fa-id-badge"></i>
                            <span>Articulos</span>
                            </a>
                        </li>    
                            </ul>
            </li>->
                
                
                
           
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>