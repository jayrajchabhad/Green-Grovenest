<nav class="sidebar border-0 sidebar-offcanvas bg-light" id="sidebar">
  <ul class="nav">
      <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('admin/dashboard') }}">
              <i class="mdi mdi-speedometer menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>

      <li class="nav-item {{ Request::is('admin/orders') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('admin/orders') }}">
            <i class="mdi mdi-cart-outline menu-icon"></i> <!-- Orders -->
            <span class="menu-title">Orders</span>
          </a>
      </li>

      <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
          <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="{{ Request::is('admin/category*') ? 'true' : 'false' }}">
              <i class="mdi mdi-view-list menu-icon"></i>
              <span class="menu-title">Category</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('admin/category*') ? 'show' : '' }}" id="category">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/category/C-create') ? 'active' : '' }}" href="{{ url('admin/category/C-create') }}">Add Category</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/category') || Request::is('admin/category/*/edit') ? 'active' : '' }}" href="{{ url('admin/category') }}">View Category</a></li>
              </ul>
          </div>
      </li>

      <li class="nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
          <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="{{ Request::is('admin/products*') ? 'true' : 'false' }}">
            <i class="mdi mdi-shopping-outline menu-icon"></i> <!-- Products -->
            <span class="menu-title">Products</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('admin/products*') ? 'show' : '' }}" id="products">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/products/P-create') ? 'active' : '' }}" href="{{ url('admin/products/P-create') }}">Add Product</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/products') || Request::is('admin/products/*/edit') ? 'active' : '' }}" href="{{ url('admin/products') }}">View Product</a></li>
              </ul>
          </div>
      </li>


      <li class="nav-item {{ Request::is('admin/recommendations*') ? 'active' : '' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#recommendations" aria-expanded="{{ Request::is('admin/recommendations*') ? 'true' : 'false' }}">
            <i class="mdi mdi-plus-circle menu-icon"></i>
            <span class="menu-title">Recommendat Product</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/recommendations*') ? 'show' : '' }}" id="recommendations">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/recommendations/create') ? 'active' : '' }}" href="{{ url('admin/recommendationCreate') }}">Add Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/recommendations') || Request::is('admin/recommendationEdit*') || Request::is('admin/recommendations/edit*') ? 'active' : '' }}" href="{{ url('admin/recommendations') }}">View Product</a>
                </li>
            </ul>
        </div>
    </li>

      <li class="nav-item {{ Request::is('admin/coupons*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('admin/coupons') }}">
              <i class="mdi mdi-ticket-percent menu-icon"></i>
              <span class="menu-title">Coupons</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/brands') }}">
            <i class="mdi mdi-tag-multiple menu-icon"></i> <!-- brand -->
            <span class="menu-title">Brands</span>
          </a>
      </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/review') }}">
                <i class="mdi mdi-star-outline menu-icon"></i> <!-- User Review -->
                <span class="menu-title">User Review</span>
            </a>
        </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/colors') }}">
              <i class="mdi mdi-palette menu-icon"></i>
              <span class="menu-title">Colors</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/slider') }}">
            <i class="mdi mdi-image-album menu-icon"></i>
            <span class="menu-title">Home Sliders</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/settings') }}">
            <i class="mdi mdi-cog-outline menu-icon"></i> <!-- Site Settings -->
            <span class="menu-title">Site Setting</span>
          </a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/contactUs') }}">
            <i class="mdi mdi-email-multiple-outline menu-icon"></i> <!-- Contact Info -->
            <span class="menu-title">Contact Info</span>
          </a>
      </li>

      <li class="nav-item {{ Request::is('admin/user*') ? 'active' : '' }}">
          <a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="{{ Request::is('admin/user*') ? 'true' : 'false' }}">
            <i class="mdi mdi-account-multiple-check menu-icon"></i> <!-- Users -->
            <span class="menu-title">Users</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('admin/user*') ? 'show' : '' }}" id="user">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/users/add_user') ? 'active' : '' }}" href="{{ url('admin/users/add_user') }}">Add Users</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*/edit') ? 'active' : '' }}" href="{{ url('admin/users') }}">View Users</a></li>
              </ul>
          </div>
      </li>
  </ul>
</nav>

<link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">