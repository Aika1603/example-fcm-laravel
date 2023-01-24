<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Aside Toolbarl-->
    <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
        @include('layouts.components.aside-user')
        {{-- @include('layouts.components.aside-search') --}}
    </div>
    <!--end::Aside Toolbarl-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title fw-bold fs-6-gray-800 menu-state-title-{{ config('app.theme') }} menu-state-icon-{{ config('app.theme') }} menu-state-bullet-{{ config('app.theme') }} menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link {{ @$menu == 'Dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}" >
                        <span class="menu-icon">
                            <i class="bi bi-speedometer fs-3"></i> 
                        </span>
                        <span class="menu-title fw-bold fs-6">Dashboard</span>
                    </a>
                </div> 
            </div> 
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>