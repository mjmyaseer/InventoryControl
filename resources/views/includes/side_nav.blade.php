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
        <li class="@php if($url == '/secure/dashboard.html'){echo $selected;}@endphp">  <a href="{{url("/secure/dashboard.html")}}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
        <li class="@php if($url == '/secure/categories.html'){echo $selected;}@endphp"> <a href="{{url("/secure/categories.html")}}"><i class="glyphicon glyphicon-calendar"></i> Categories</a></li>
        <li class="@php if($url == '/secure/items.html'){echo $selected;}@endphp"> <a href="{{url("/secure/items.html")}}"><i class="glyphicon glyphicon-calendar"></i> Items</a></li>
        <li class="@php if($url == '/secure/suppliers.html'){echo $selected;}@endphp"> <a href="{{url("/secure/suppliers.html")}}"><i class="glyphicon glyphicon-calendar"></i> Suppliers</a></li>
        <li class="@php if($url == '/secure/customers.html'){echo $selected;}@endphp"> <a href="{{url("/secure/customers.html")}}"><i class="glyphicon glyphicon-calendar"></i> Customers</a></li>
        <li class="@php if($url == '/secure/sales.html'){echo $selected;}@endphp"> <a href="{{url("/secure/sales.html")}}"><i class="glyphicon glyphicon-calendar"></i> Sales</a></li>
        <li class="@php if($url == '/secure/purchase.html'){echo $selected;}@endphp"> <a href="{{url("/secure/purchase.html")}}"><i class="glyphicon glyphicon-calendar"></i> Purchase</a></li>
        <li class="@php if($url == '/sign-up.html'){echo $selected;}@endphp"> <a href="{{url("/sign-up.html")}}"><i class="glyphicon glyphicon-calendar"></i> Users</a></li>
        <li class="@php if($url == '/secure/stocks.html'){echo $selected;}@endphp"> <a href="{{url("/secure/stocks.html")}}"><i class="glyphicon glyphicon-calendar"></i> Stocks</a></li>
        <li class="@php if($url == '/secure/purchaseReturns.html'){echo $selected;}@endphp"> <a href="{{url("/secure/purchaseReturns.html")}}"><i class="glyphicon glyphicon-calendar"></i> Purchase Returns</a></li>
        <li class="@php if($url == '/secure/salesReturns.html'){echo $selected;}@endphp"> <a href="{{url("/secure/salesReturns.html")}}"><i class="glyphicon glyphicon-calendar"></i> Sales Returns</a></li>
        <li class="@php if($url == '/secure/reports.html'){echo $selected;}@endphp"> <a href="{{url("/secure/reports.html")}}"><i class="glyphicon glyphicon-calendar"></i> Reports</a></li>


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