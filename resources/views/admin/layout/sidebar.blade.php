  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="{{route('User-Dashboard')}}" class="app-brand-link">

            <span class="app-brand-text demo menu-text fw-bold">Album</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="align-middle ti menu-toggle-icon d-none d-xl-block ti-sm"></i>
            <i class="align-middle ti ti-x d-block d-xl-none ti-sm"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="py-1 menu-inner">

        <li class="menu-item @if($class == 'album') active @endif">
              <a href="{{route('Album.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-album"></i>
                <div data-i18n="Album">Album</div>
              </a>
            </li>



           

            <li class="menu-item @if($class == 'change_pssword' || $class == 'profile') open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ti ti-settings"></i>
                  <div data-i18n="{{translate('Setting')}}">{{translate('Setting')}}</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item @if($class == 'profile') active @endif">
                    <a href="{{url('Profile')}}" class="menu-link">
                      <div data-i18n="{{translate('Account')}}">{{translate('Account')}}</div>
                    </a>
                  </li>
                  <li class="menu-item @if($class == 'change_pssword') active @endif">
                    <a href="{{url('Profile/Security/')}}" class="menu-link">
                      <div data-i18n="{{translate('Security')}}">{{translate('Security')}}</div>
                    </a>
                  </li>


                </ul>
              </li>




        </ul>
      </aside>
      <!-- / Menu -->
