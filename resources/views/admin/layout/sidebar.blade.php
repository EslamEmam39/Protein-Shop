<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Username</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active"><a href="{{route('admin.dashboard')}}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li><a href="{{route('all.categories')}}"><em class="fa fa-calendar">&nbsp;</em> Category</a></li>
        <li><a href="{{route('add.category')}}"><em class="fa fa-calendar">&nbsp;</em> Add Category</a></li>
        <li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
        <li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
        <li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
           
        
        </li>
{{--  
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"><em class="fa fa-power-off">&nbsp;</em>تسجيل الخروج</button>
            </form>
             --}}

             <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">تسجيل الخروج</button>
            </form>
        
    </ul>
</div><!--/.sidebar-->