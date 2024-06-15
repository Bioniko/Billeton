<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header" style="text-align: center;">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url();?>Tema/Static_Full_Version/img/profile_small.png" style="width: 40%;"/>
                             </span>
                            
                        </div>
                        <div class="logo-element">
                        <img alt="image" class="img-circle" src="<?php echo base_url();?>Tema/Static_Full_Version/img/profile_small.png" style="width: 40%;"/>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php/Grafico/Show"><i class="fa-solid fa-chart-pie"></i> <span class="nav-label">Grafico</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php/Comercios/Show"><i class="fa-solid fa-cash-register"></i> <span class="nav-label">Comercios</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php/Movimiento/Show"><i class="fa-solid fa-sack-dollar"></i> <span class="nav-label">Movimiento</span></a>
                    </li>
                    <?php 
                    if($_COOKIE['log_id'] == '3'){
                    ?>
                    <li>
                        <a href="<?php echo base_url();?>index.php/Login/Show"><i class="fa-solid fa-right-to-bracket"></i> <span class="nav-label">Login</span></a>
                    </li>
                    <?php 
                    }
                    ?>
                </ul>

            </div>
        </nav>