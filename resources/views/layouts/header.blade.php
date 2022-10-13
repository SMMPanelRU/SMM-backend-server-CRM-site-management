<div class="horizontal-menu">
    <nav class="navbar top-navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="/" class="navbar-brand">
                    Server<span>SMO</span>
                </a>
                <a class="navbar-toggler-right d-lg-none align-self-center" type="button" id="navbar-toggle"
                   data-toggle="horizontal-menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <form class="search-form">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i data-feather="search"></i>
                        </div>
                        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:;" id="languageDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ms-1 me-1 d-none d-md-inline-block">{{ app()->getLocale() }}</span>
                        </a>

                        @livewire('components.lang', [], key('header-lang'))

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-menorah"></i>
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
                            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p class="mb-0 fw-bold">Web Apps</p>
                                <a href="javascript:;" class="text-muted">Edit</a>
                            </div>
                            <div class="row g-0 p-1">
                                <div class="col-3 text-center">
                                    <a href="{{ url('/apps/chat') }}"
                                       class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                            data-feather="message-square" class="icon-lg mb-1"></i>
                                        <p class="tx-12">Chat</p></a>
                                </div>
                                <div class="col-3 text-center">
                                    <a href="{{ url('/apps/calendar') }}"
                                       class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                            data-feather="calendar" class="icon-lg mb-1"></i>
                                        <p class="tx-12">Calendar</p></a>
                                </div>
                                <div class="col-3 text-center">
                                    <a href="{{ url('/email/inbox') }}"
                                       class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                            data-feather="mail" class="icon-lg mb-1"></i>
                                        <p class="tx-12">Email</p></a>
                                </div>
                                <div class="col-3 text-center">
                                    <a href="{{ url('/general/profile') }}"
                                       class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i
                                            data-feather="instagram" class="icon-lg mb-1"></i>
                                        <p class="tx-12">Profile</p></a>
                                </div>
                            </div>
                            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="mail"></i>
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
                            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p>9 New Messages</p>
                                <a href="javascript:;" class="text-muted">Clear all</a>
                            </div>
                            <div class="p-1">
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="wd-30 ht-30 rounded-circle" src="" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Leonardo Payne</p>
                                            <p class="tx-12 text-muted">Project status</p>
                                        </div>
                                        <p class="tx-12 text-muted">2 min ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="wd-30 ht-30 rounded-circle" src="" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Carl Henson</p>
                                            <p class="tx-12 text-muted">Client meeting</p>
                                        </div>
                                        <p class="tx-12 text-muted">30 min ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="wd-30 ht-30 rounded-circle" src="" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Jensen Combs</p>
                                            <p class="tx-12 text-muted">Project updates</p>
                                        </div>
                                        <p class="tx-12 text-muted">1 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="wd-30 ht-30 rounded-circle" src="" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>{{ Auth::user()->name }}</p>
                                            <p class="tx-12 text-muted">{{ Auth::user()->teams_count }}</p>
                                        </div>
                                        <p class="tx-12 text-muted">2 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div class="me-3">
                                        <img class="wd-30 ht-30 rounded-circle" src="" alt="userr">
                                    </div>
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div class="me-4">
                                            <p>Yaretzi Mayo</p>
                                            <p class="tx-12 text-muted">New record</p>
                                        </div>
                                        <p class="tx-12 text-muted">5 hrs ago</p>
                                    </div>
                                </a>
                            </div>
                            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell"></i>
                            <div class="indicator">
                                <div class="circle"></div>
                            </div>
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                            <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p>6 New Notifications</p>
                                <a href="javascript:;" class="text-muted">Clear all</a>
                            </div>
                            <div class="p-1">
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="gift"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>New Order Recieved</p>
                                        <p class="tx-12 text-muted">30 min ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="alert-circle"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>Server Limit Reached!</p>
                                        <p class="tx-12 text-muted">1 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <img class="wd-30 ht-30 rounded-circle" src="" alt="userr">
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>New customer registered</p>
                                        <p class="tx-12 text-muted">2 sec ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="layers"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>Apps are ready for update</p>
                                        <p class="tx-12 text-muted">5 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                    <div
                                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="download"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>Download completed</p>
                                        <p class="tx-12 text-muted">6 hrs ago</p>
                                    </div>
                                </a>
                            </div>
                            <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            profile
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                <div class="mb-3">
                                    <img class="wd-80 ht-80 rounded-circle" src="" alt="">
                                </div>
                                <div class="text-center">
                                    <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                                    <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <ul class="list-unstyled p-1">
                                <li class="dropdown-item py-2">
                                    <a href="{{ url('/general/profile') }}" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="dropdown-item py-2">
                                    <a href="javascript:;" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="edit"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                </li>
                                <li class="dropdown-item py-2">
                                    <a href="javascript:;" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="repeat"></i>
                                        <span>Switch User</span>
                                    </a>
                                </li>
                                <li class="dropdown-item py-2">
                                    <a href="{{route('logout')}}" class="text-body ms-0">
                                        <i class="me-2 icon-md" data-feather="log-out"></i>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <nav class="bottom-navbar" id="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item {{ active_class(['/']) }}">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item {{ active_class([route('orders', [], false)]) }}">
                    <a class="nav-link" href="{{ route('orders', [], false) }}">
                        <i class="fas fa-basket-shopping"></i>
                        <span class="menu-title ms-2">{{ucfirst(__('text.orders'))}}</span>
                    </a>
                </li>

                <li class="nav-item {{ active_class([route('users', [], false)]) }}">
                    <a class="nav-link" href="{{ route('users', [], false) }}">
                        <i class="fas fa-users"></i>
                        <span class="menu-title ms-2">{{ucfirst(__('text.users'))}}</span>
                    </a>
                </li>

                <li class="nav-item {{ active_class([route('tickets', [], false)]) }}">
                    <a class="nav-link" href="{{ route('tickets', [], false) }}">
                        <i class="fas fa-comments-question-check"></i>
                        <span class="menu-title ms-2">{{ucfirst(__('text.tickets'))}}</span>
                    </a>
                </li>

                <li class="nav-item {{ active_class([route('categories', [], false), route('products', [], false)]) }}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-hippo"></i>
                        <span class="menu-title me-1 ms-2">{{ucfirst(__('text.products'))}}</span>
                        <i class="fas fa-chevron-down "></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a href="{{route('products')}}"
                                   class="nav-link {{ active_class([route('products', [], false)]) }} ">
                                    <i class="fas fa-hippo"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.products'))}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories')}}"
                                   class="nav-link {{ active_class([route('categories', [], false)]) }} ">
                                    <i class="fas fa-folder-tree"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.categories'))}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ active_class([route('sites', [], false), route('attributes', [], false), route('export_systems', [], false), route('translations', [], false)])}}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-gears "></i>
                        <span class="menu-title me-1 ms-2">{{ucfirst(__('text.settings'))}}</span>
                        <i class="fas fa-chevron-down "></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="category-heading">{{ucfirst(__('text.products'))}}</li>
                            <li class="nav-item">
                                <a href="{{route('attributes')}}"
                                   class="nav-link {{ active_class([route('attributes', [], false)]) }} ">
                                    <i class="fas fa-sliders"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.attributes'))}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('export_systems')}}"
                                   class="nav-link {{ active_class([route('export_systems', [], false)]) }} ">
                                    <i class="fas fa-external-link"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.export_systems'))}}</span>
                                </a>
                            </li>
                            <li class="category-heading">{{ucfirst(__('text.sites'))}}
                            <li>
                            <li class="nav-item">
                                <a href="{{route('sites')}}"
                                   class="nav-link {{ active_class([route('sites', [], false)]) }} ">
                                    <i class="fas fa-earth"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.sites'))}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('translations')}}"
                                   class="nav-link {{ active_class([route('translations', [], false)]) }} ">
                                    <i class="fa-light fa-language"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.translations'))}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ active_class([route('pages', [], false), route('faqs', [], false)])}}">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-page "></i>
                        <span class="menu-title me-1 ms-2">{{ucfirst(__('text.pages'))}}</span>
                        <i class="fas fa-chevron-down "></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a href="{{route('pages')}}"
                                   class="nav-link {{ active_class([route('pages', [], false)]) }} ">
                                    <i class="fas fa-page"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.pages'))}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('faqs')}}"
                                   class="nav-link {{ active_class([route('faqs', [], false)]) }} ">
                                    <i class="fas fa-square-question"></i>
                                    <span class="menu-title ms-2">{{ucfirst(__('text.faq'))}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a href="{{route('telescope')}}" class="nav-link" target="_blank">
                        <i class="fas fa-telescope"></i>
                        <span class="menu-title ms-2">{{ucfirst(__('text.telescope'))}}</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</div>
