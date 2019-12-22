<!--  --><aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
         <div class="pull-left image">
            <img src="{{url('/admin/images/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
         </div>
         <div class="pull-left info">
            <p>Admin</p>
         </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         <li class="header"></li>
         <li class="{{ (request()->is('admin/dashboard'))? 'active': '' }}">>
            <a href="{{url('/admin/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
         </li>
         <li class="{{ (request()->is('admin/users*'))? 'active': '' }}">
            <a href="{{url('/admin/users')}}">
            <i class="fa fa-users"></i>
            <span>Users</span>
            </a>
         </li>
         <!-- <li class="treeview {{ (request()->is('admin/categories*')|request()->is('admin/tags*')|request()->is('admin/cities*')|request()->is('admin/faqs*'))? 'active': '' }}">
            <a href="{{url('/')}}">
            <i class="fa fa-files-o"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="{{ (request()->is('admin/categories*'))? 'active': '' }}"><a href="{{url('/admin/categories')}}"><i class="fa fa-list-alt"></i>Categories</a></li> -->
               
            </ul>
         </li>
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>