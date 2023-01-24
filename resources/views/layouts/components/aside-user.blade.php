<div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
    <!--begin::Symbol-->
    <div class="symbol symbol-50px">
        <img alt="Avatar" src="{{ asset('images/icon.png')  }}" />
    </div>
    <!--end::Symbol-->
    <!--begin::Wrapper-->
    <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
        <!--begin::Section-->
        <div class="d-flex">
            <!--begin::Info-->
            <div class="flex-grow-1 me-2">
                <a href="#" class="text-white text-hover-{{ config('app.theme') }} fs-6 fw-bold">{{ Auth::user()->name }}</a>
                <span class="text-gray-600 fw-bold d-block fs-8 mb-1">{{ Auth::user()->username }}</span>
                <div class="d-flex align-items-center text-success fs-9">
                <span class="bullet bullet-dot bg-success me-1"></span>online</div>
            </div>
            <!--end::Info-->
            <!--begin::User menu-->
            <div class="me-n2">
                <!--begin::Action-->
                <a href="#" class="btn btn-icon btn-sm btn-active-color-{{ config('app.theme') }} mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                    <i class="bi bi-gear fs-1"></i>
                </a>
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-{{ config('app.theme') }} fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Avatar" src="{{ asset('images/icon.png')  }}" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}</div>
                                <a href="#" class="fw-bold text-muted text-hover-{{ config('app.theme') }} fs-7">{{ Auth::user()->email }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="menu-item px-5">
                        <a href="#logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5">Sign Out</a>
                    </div>
                    <!--end::Menu item-->
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <!--end::User account menu-->
                <!--end::Action-->
            </div>
            <!--end::User menu-->
        </div>
        <!--end::Section-->
    </div>
    <!--end::Wrapper-->
</div>