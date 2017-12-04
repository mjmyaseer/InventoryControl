<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        @php
        $path = $_SERVER['REQUEST_URI'];
        $path = (explode("/",$path));
        $secure = $path[3];
        $final = $path[4];
        $url = '/'.$secure.'/'.$final;
        $selected = 'current';
        @endphp
        <!-- Main menu -->
            <li class="<?php  if($url == '/secure/dashboard.html'){echo $selected;} ?>">  <a href="<?php echo e(url("/secure/dashboard.html")); ?>"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
            <li class="<?php  if($url == '/secure/categories' || $url == '/secure/add-categories' ){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/categories")); ?>"><i class="glyphicon glyphicon-calendar"></i> Categories</a></li>
            <li class="<?php  if($url == '/secure/items' || $url == '/secure/add-items'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/items")); ?>"><i class="glyphicon glyphicon-list"></i> Items</a></li>
            <li class="<?php  if($url == '/secure/suppliers' || $url == '/secure/add-suppliers'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/suppliers")); ?>"><i class="glyphicon glyphicon-knight"></i> Suppliers</a></li>
            <li class="<?php  if($url == '/secure/customers' || $url == '/secure/add-customers'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/customers")); ?>"><i class="glyphicon glyphicon-king"></i> Customers</a></li>
            <li class="<?php  if($url == '/secure/sales' || $url == '/secure/add-sales'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/sales")); ?>"><i class="glyphicon glyphicon-hand-left"></i> Sales</a></li>
            <li class="<?php  if($url == '/secure/purchase' || $url == '/secure/add-purchase'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/purchase")); ?>"><i class="glyphicon glyphicon-hand-right"></i> Purchase</a></li>
            <li class="<?php  if($url == '/secure/users'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/users")); ?>"><i class="glyphicon glyphicon-user"></i> Users</a></li>
            <li class="<?php  if($url == '/secure/stocks'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/stocks")); ?>"><i class="glyphicon glyphicon-edit"></i> Stocks</a></li>
            <li class="<?php  if($url == '/secure/purchaseReturns'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/purchaseReturns")); ?>"><i class="glyphicon glyphicon-arrow-left"></i> Purchase Returns</a></li>
            <li class="<?php  if($url == '/secure/salesReturns'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/salesReturns")); ?>"><i class="glyphicon glyphicon-arrow-right"></i> Sales Returns</a></li>
            <li class="<?php  if($url == '/secure/reports'){echo $selected;} ?>"> <a href="<?php echo e(url("/secure/reports")); ?>"><i class="glyphicon glyphicon-print"></i> Reports</a></li>


        <!--li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>
        <li><a href="tables.html"><i class="glyphicon glyphicon-list"></i> Tables</a></li>
        <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
        <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
        <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
        <li class="submenu">
            <a href="#">
                <i class="glyphicon glyphicon-list"></i> Pages
                <span class="caret pull-right"></span>
            </a-->
            <!-- Sub menu -->
            <!--ul>
                <li><a href="login.html">Login</a></li>
                <li><a href="signup.html">Signup</a></li>
            </ul>
        </li-->
    </ul>
</div>