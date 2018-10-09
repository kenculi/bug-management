<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
    </div>
</form>
<!-- /.search form -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU</li>
    <!-- Optionally, you can add icons to the links -->
    {{-- <li class="active treeview">
        <a href="#"><i class="fa fa-link"></i> <span>User Management</span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="/user/info">Information</a></li>
            <li><a href="/user">Management</a></li>
        </ul>
    </li> --}}
    <li><a href="#"><i class="fa fa-list"></i> <span>Backlog</span></a></li>
    <li><a href="#"><i class="fa fa-list-alt"></i> <span>Board</span></a></li>
    {{-- <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
        </ul>
    </li> --}}
</ul>
