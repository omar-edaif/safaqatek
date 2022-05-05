        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">

                        @foreach ($menu as $menu)
                            @if ($menu['is_namespace'])
                                <li class="menu-title" key="{{ 't-' . $menu['name_en'] }}">
                                    {{ $menu['name_' . app()->getLocale()] }}</li>
                            @elseif (!isset($menu['children']))
                                <li>
                                    <a href="{{ route($menu['route']) }}" class="waves-effect">
                                        <i class="{{ $menu['icon'] }}"></i>
                                        <span
                                            key="{{ 't-' . $menu['name_en'] }}">{{ Str::ucfirst($menu['name_' . app()->getLocale()]) }}</span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="{{ $menu['icon'] }}"></i>
                                        <span
                                            key="{{ 't-' . $menu['name_en'] }}">{{ Str::ucfirst($menu['name_' . app()->getLocale()]) }}</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        @foreach ($menu['children'] as $child)
                                        @endforeach
                                        <li><a href="{{ route($child['route']) }}"
                                                key="{{ 't-' . $child['name_en'] }}">{{ $child['name_' . app()->getLocale()] }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endforeach




                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
