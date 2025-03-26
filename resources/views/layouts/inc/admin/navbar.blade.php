<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
      <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
        <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}">{{ $appSetting->website_name ?? 'website name'  }}</a>       
        <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}">
                        <img src="{{ asset($appSetting->about_img ) }}" alt="About Us" class="img-fluid" style="height: 45px; width: 350px;">
        </a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-sort-variant"></span>
        </button>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown me-1">
          <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center"
             id="messageDropdown" href="#" data-bs-toggle="dropdown">
            <i class="mdi mdi-message-text mx-0"></i>
            <span class="count"></span>
          </a>
        
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p><hr>
        
            @if ($contactData->where('reply', null)->count() > 0)
                @foreach ($contactData->where('reply', null) as $item)
                    <a class="dropdown-item preview-item d-flex align-items-center" href="{{ url('admin/contactUs') }}">
                        <!-- Profile Image -->
                        <div class="profile-img-container bg-danger">
                            <div class="profile-placeholder">{{ strtoupper(substr($item->name, 0, 1)) }}</div>
                        </div>

                        <!-- Message Content -->
                        <div class="preview-item-content flex-grow ms-2">
                            <h6 class="preview-subject ellipsis font-weight-normal mb-1">
                                {{ $item->name }}
                            </h6>
                            <p class="font-weight-light small-text text-muted mb-0">
                                {{ $item->message }}
                            </p>
                        </div>
                    </a>
                @endforeach
            @else
                <h6 class="text-center text-muted p-3">No messages available</h6>
            @endif

          </div>
        </li>
        
       

       

        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown" id="profileDropdown">
            <!-- User Profile Image or First Letter -->
            <div class="profile-img-container">
                @if(Auth::user()->profile_image) 
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="profile-img" alt="User Image">
                @else
                    <div class="profile-placeholder">{{ substr(Auth::user()->name, 0, 1) }}</div>
                @endif
            </div>
            <!-- User Name -->
            <span class="nav-profile-name ms-2">{{ Auth::user()->name }}</span>
        </a>
        
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="/admin/settings">
              <i class="mdi mdi-cog text-primary"></i>
              Settings
            </a>
           
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             <i class="mdi mdi-logout text-primary"></i> {{ __('Logout') }}
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
          </div>
        </li>
        
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>

<style>
.navbar-brand {
    font-weight: bold;
    color: #fff;

}
.profile-img-container {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #007bff; /* Blue border */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: bold;
    color: white;
    background-color: #007bff; /* Blue background */
    overflow: hidden;
}

/* Profile Image Styling */
.profile-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

/* If no image, show the first letter */
.profile-img-container span {
    display: block;
}

</style>