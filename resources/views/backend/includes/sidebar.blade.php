@hasPermission('menu_builder_sidebar')
<div class="sidebar-base pr-hide
            {{ getCustomizationSetting('sidebar_show') == 'sidebar-none' ? 'sidebar-none' : 'sidebar' }}
            {{ !empty(getCustomizationSetting('sidebar_menu_style')) ? getCustomizationSetting('sidebar_menu_style') : 'left-bordered' }}
            {{ getCustomizationSetting('sidebar_color') }}
            {{ !empty(getCustomizationSetting('sidebar_type')) ? implode(' ',getCustomizationSetting('sidebar_type')) : '' }}
            "
            data-toggle="main-sidebar" id="sidebar" data-sidebar="responsive">
    <div class="d-flex align-items-center justify-content-start">
        <div class="logo-main">
            <a href="{{route('backend.dashboard')}}" class="navbar-brand" >
            <img class="logo-normal img-fluid" src="{{ asset('images/JOSPA.webp') }}" height="30" alt="{{ app_name() }}">
                <img class="logo-normal dark-normal img-fluid" src="{{ asset('images/JOSPA.webp') }}" height="30" alt="{{ app_name() }}">
                <img class="logo-mini img-fluid" src="{{ asset('images/JOSPA.webp') }}" height="30" alt="{{ app_name() }}">
                <img class="logo-mini dark-mini img-fluid" src="{{ asset('images/JOSPA.webp') }}" height="30" alt="{{ app_name() }}">
            </a>
        </div>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list" id="sidebar">
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
@php
    $menu = new \App\Http\Middleware\GenerateMenus();
    $menu = $menu->handle('menu', 'vertical', 'ARRAY_MENU');

    $filteredItems = $menu->roots()->filter(function($item) {
        $hiddenItems = [
            'staff_earnings', 'أرباح', 'earnings',
            'staffs_payouts', 'مدفوعات', 'payouts',
            'reviews', 'التقييمات', 'review'
        ];

        foreach ($hiddenItems as $hidden) {
            if (str_contains(strtolower($item->title), strtolower($hidden))) {
                return false;
            }
        }
        return true;
    });
@endphp

@include(config('laravel-menu.views.bootstrap-items'), ['items' => $filteredItems])

                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.invoice') ? 'active' : '' }}">
                    <a href="{{ route('app.invoice') }}" class="nav-link {{ request()->routeIs('app.invoice') ? 'active' : '' }}">
                        <i class="fa fa-file-invoice"></i>
                        <span class="item-name">{{ __('messagess.invoice') }}</span>
                    </a>
                </li>
                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.gift') ? 'active' : '' }}">
                    <a href="{{ route('app.gift') }}" class="nav-link {{ request()->routeIs('app.gift') ? 'active' : '' }}">
                        <i class="fa fa-chart-bar"></i>
                        <span class="item-name">{{ __('messagess.gifts') }}</span>
                    </a>
                </li>
                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.Wheel') ? 'active' : '' }}">
                    <a href="{{ route('app.Wheel') }}" class="nav-link {{ request()->routeIs('app.Wheel') ? 'active' : '' }}">
                    <svg id="wheel-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="15" height="20">
                      <title>Lucky Wheel (Black & White)</title>
                      <rect width="100%" height="100%" fill="transparent"/>
                      <g id="wheel-group" transform="translate(0,0)">
                        <path d="M250,250 L250,0 A250,250 0 0,1 375,33.494 Z" fill="#6c757d"/>
                        <path d="M250,250 L375,33.494 A250,250 0 0,1 466.506,125 Z" fill="#ffffff"/>
                        <path d="M250,250 L466.506,125 A250,250 0 0,1 500,250 Z" fill="#6c757d"/>
                        <path d="M250,250 L500,250 A250,250 0 0,1 466.506,375 Z" fill="#ffffff"/>
                        <path d="M250,250 L466.506,375 A250,250 0 0,1 375,466.506 Z" fill="#6c757d"/>
                        <path d="M250,250 L375,466.506 A250,250 0 0,1 250,500 Z" fill="#ffffff"/>
                        <path d="M250,250 L250,500 A250,250 0 0,1 125,466.506 Z" fill="#6c757d"/>
                        <path d="M250,250 L125,466.506 A250,250 0 0,1 33.494,375 Z" fill="#ffffff"/>
                        <path d="M250,250 L33.494,375 A250,250 0 0,1 0,250 Z" fill="#6c757d"/>
                        <path d="M250,250 L0,250 A250,250 0 0,1 33.494,125 Z" fill="#ffffff"/>
                        <path d="M250,250 L33.494,125 A250,250 0 0,1 125,33.494 Z" fill="#6c757d"/>
                        <path d="M250,250 L125,33.494 A250,250 0 0,1 250,0 Z" fill="#ffffff"/>
                        <circle cx="250" cy="250" r="52" fill="#fff" stroke="#000" stroke-width="4"/>
                        <text x="250" y="250" text-anchor="middle" dominant-baseline="central" font-size="16" font-weight="700" fill="#000">SPIN</text>
                      </g>
                      <circle cx="250" cy="250" r="248" fill="none" stroke="#000" stroke-width="4"/>
                    </svg>

                        <span class="item-name">{{ __('wheel.WheelOfFortune') }}</span>
                    </a>
                </li>
                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.loyalty') ? 'active' : '' }}">
                    <a href="{{ route('app.loyalty') }}" class="nav-link {{ request()->routeIs('app.loyalty') ? 'active' : '' }}">
                        <i class="fas fa-coins"></i>
                        <span class="item-name">{{ __('messages.loyalty_management') }}</span>
                    </a>
                </li>
                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.offers') ? 'active' : '' }}">
                    <a href="{{ route('app.offers') }}" class="nav-link {{ request()->routeIs('app.offers') ? 'active' : '' }}">
                        <i class="fa fa-tags"></i>
                        <span class="item-name">{{ __('messagess.our_offers') }}</span>
                    </a>
                </li>
                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.ads') ? 'active' : '' }}">
                    <a href="{{ route('app.ads') }}" class="nav-link {{ request()->routeIs('app.ads') ? 'active' : '' }}">
                        <i class="fa-solid fa-ad"></i>
                        <span class="item-name">{{ __('messagess.Ads') }}</span>
                    </a>
                </li>
                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.reject') ? 'active' : '' }}">
                    <a href="{{ route('app.reject') }}" class="nav-link {{ request()->routeIs('app.reject') ? 'active' : '' }}">
                        <i class="fa-solid fa-ban"></i>
                        <span class="item-name">{{ __('messagess.cancellation_of_reservation') }}</span>
                    </a>
                </li>
                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.TermsAndConditions') ? 'active' : '' }}">
                    <a href="{{ route('app.TermsAndConditions') }}" class="nav-link {{ request()->routeIs('app.TermsAndConditions') ? 'active' : '' }}">
                        <i class="fas fa-file-contract"></i>
                        <span class="item-name">{{ __('messages.TermsAndConditions') }}</span>
                    </a>
                </li>

                <!-- عنصر ثابت مخصص -->
                <li class="nav-item {{ request()->routeIs('app.sms') ? 'active' : '' }}">
                    <a href="{{ route('app.sms') }}" class="nav-link {{ request()->routeIs('app.sms') ? 'active' : '' }}">
                        <i class="fas fa-sms"></i>
                        <span class="item-name">{{ __('messages.sms') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="sidebar-footer"></div>
</div>
@endhasPermission
