@php
    use Illuminate\Support\Facades\Route;
    $configData = Helper::appClasses();
    $dataWeb = Helper::berandaUser();
    use Illuminate\Support\Facades\Auth;

@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    @if (!isset($navbarFull))
        <div class="app-brand demo">
            <a href="{{ url('/') }}" class="app-brand-link">
                <img src="{{ $dataWeb['logo_website'] }}" style="width: 40px;border-radius:100%">
                <span class="app-brand-text demo menu-text fw-bold">{{ $dataWeb['nama_website'] }}</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
            </a>
        </div>
    @endif

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @php
            $user = Auth::user();
            $menus = [];

            // Validasi menuData sebelum digunakan
            if (isset($menuData) && is_array($menuData)) {
                if ($user->level == 0 && isset($menuData[0])) {
                    $menus = $menuData[0]; // Menu Admin
                } elseif ($user->level == 1 && isset($menuData[1])) {
                    $menus = $menuData[1]; // Menu Guru
                } elseif (isset($menuData[2])) {
                    $menus = $menuData[2]; // Menu Wali
                }
            }
        @endphp
        @if (!empty($menus))
            {{-- Iterasi menu berdasarkan level user --}}
            @foreach ($menus['menu'] as $menu)
                {{-- Menambahkan active dan open class jika child aktif --}}

                {{-- Menu headers --}}
                @if (isset($menu['menuHeader']))
                    <li class="menu-header small">
                        <span class="menu-header-text">{{ __($menu['menuHeader']) }}</span>
                    </li>
                @else
                    {{-- Active menu method --}}
                    @php
                        $activeClass = null;
                        $currentRouteName = Route::currentRouteName();

                        if ($currentRouteName === $menu['slug']) {
                            $activeClass = 'active';
                        } elseif (isset($menu['submenu'])) {
                            if (is_array($menu['slug'])) {
                                foreach ($menu['slug'] as $slug) {
                                    if (
                                        str_contains($currentRouteName, $slug) and
                                        strpos($currentRouteName, $slug) === 0
                                    ) {
                                        $activeClass = 'active open';
                                    }
                                }
                            } else {
                                if (
                                    str_contains($currentRouteName, $menu['slug']) and
                                    strpos($currentRouteName, $menu['slug']) === 0
                                ) {
                                    $activeClass = 'active open';
                                }
                            }
                        }
                    @endphp

                    {{-- Main menu --}}
                    <li class="menu-item {{ $activeClass }}">
                        <a href="{{ isset($menu['url']) ? url($menu['url']) : 'javascript:void(0);' }}"
                            class="{{ isset($menu['submenu']) ? 'menu-link menu-toggle' : 'menu-link' }}"
                            @if (isset($menu['target']) and !empty($menu['target'])) target="_blank" @endif>
                            @isset($menu['icon'])
                                <i class="{{ $menu['icon'] }}"></i>
                            @endisset
                            <div>{{ isset($menu['name']) ? __($menu['name']) : '' }}</div>
                            @isset($menu['badge'])
                                <div class="badge bg-{{ $menu['badge'][0] }} rounded-pill ms-auto">
                                    {{ $menu['badge'][1] }}
                                </div>
                            @endisset
                        </a>

                        {{-- Submenu --}}
                        @isset($menu['submenu'])
                            @include('layouts.sections.menu.submenu', ['menu' => $menu['submenu']])
                        @endisset
                    </li>
                @endif
            @endforeach
        @else
            <p>Tidak ada menu yang tersedia.</p>
        @endif
    </ul>


</aside>
