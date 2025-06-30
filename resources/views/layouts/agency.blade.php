<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'إدارة الوكالة' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 min-h-screen" x-data="{ openSidebar: false }">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg border-b border-emerald-100">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="flex flex-row justify-between items-center h-16 gap-2 w-full">
                <!-- اسم الوكالة -->
                <div class="flex items-center min-w-0">
                    <svg class="h-7 w-7 text-emerald-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <div class="truncate">
                        <h1 class="text-base sm:text-xl font-bold text-emerald-600 truncate">{{ Auth::user()->agency->name ?? 'إدارة الوكالة' }}</h1>
                        <p class="text-xs sm:text-sm text-gray-600 truncate">
                            @if(Auth::user()->isAgencyAdmin())
                                لوحة تحكم مدير الوكالة
                            @elseif(Auth::user()->isAgencyUser())
                                لوحة تحكم مستخدم الوكالة
                            @else
                                لوحة تحكم الوكالة
                            @endif
                        </p>
                    </div>
                </div>
                <!-- اسم المستخدم -->
                <div class="flex items-center gap-2 min-w-0">
                    <div class="h-7 w-7 sm:h-8 sm:w-8 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-xs sm:text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="text-center sm:text-right truncate">
                        <span class="text-gray-700 font-medium text-xs sm:text-sm truncate">{{ Auth::user()->name }}</span>
                        <p class="text-[10px] sm:text-xs text-gray-500 truncate">
                            @if(Auth::user()->isAgencyAdmin())
                                مدير الوكالة
                            @elseif(Auth::user()->isAgencyUser())
                                مستخدم الوكالة
                            @else
                                مستخدم
                            @endif
                        </p>
                    </div>
                </div>
                <!-- زر تسجيل الخروج -->
                <form method="POST" action="{{ route('logout') }}" class="ml-2 flex-shrink-0">
                    @csrf
                    <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-2 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                        <svg class="h-5 w-5 sm:h-4 sm:w-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="hidden sm:inline ml-1">تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar and Main Content -->
    <div class="flex">
        <!-- Sidebar (desktop) -->
        <div class="w-72 bg-white/90 backdrop-blur-md shadow-2xl border-l border-emerald-100 min-h-screen hidden sm:block">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-emerald-100">
                <div class="flex items-center">
                    <div class="h-12 w-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="mr-3">
                        <h2 class="text-lg font-bold text-gray-800">إدارة الوكالة</h2>
                        <p class="text-sm text-gray-500">{{ Auth::user()->agency->name ?? 'الوكالة' }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-6">
                <div class="space-y-3">
                    <!-- Dashboard -->
                    <a href="{{ route('agency.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.dashboard') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.dashboard') ? 'bg-white/20' : 'bg-teal-100 group-hover:bg-teal-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('agency.dashboard') ? 'text-white' : 'text-teal-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">لوحة التحكم</span>
                        @if(request()->routeIs('agency.dashboard'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <!-- Users Management -->
                    @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('users.view'))
                    <a href="{{ route('agency.users') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.users*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.users*') ? 'bg-white/20' : 'bg-cyan-100 group-hover:bg-cyan-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('agency.users*') ? 'text-white' : 'text-cyan-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">إدارة المستخدمين</span>
                        @if(request()->routeIs('agency.users*'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                    @endif

                    <!-- Roles Management -->
                    @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('roles.view'))
                    <a href="{{ route('agency.roles') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.roles*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.roles*') ? 'bg-white/20' : 'bg-emerald-100 group-hover:bg-emerald-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('agency.roles*') ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">إدارة الأدوار</span>
                        @if(request()->routeIs('agency.roles*'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                    @endif

                    <!-- Permissions Management -->
                    @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('permissions.view'))
                    <a href="{{ route('agency.permissions') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.permissions*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.permissions*') ? 'bg-white/20' : 'bg-teal-100 group-hover:bg-teal-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('agency.permissions*') ? 'text-white' : 'text-teal-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">إدارة الصلاحيات</span>
                        @if(request()->routeIs('agency.permissions*'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                    @endif

                    <!-- Services Management -->
                    @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('services.view'))
                    <a href="{{ route('agency.services') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.services*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.services*') ? 'bg-white/20' : 'bg-emerald-100 group-hover:bg-emerald-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('agency.services*') ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V7a2 2 0 012-2h2a2 2 0 012 2v10"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">إدارة الخدمات</span>
                        @if(request()->routeIs('agency.services*'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                    @endif

                    <!-- Agency Profile -->
                    @if(auth()->user()->isAgencyAdmin())
                    <a href="{{ route('agency.profile') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.profile*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.profile*') ? 'bg-white/20' : 'bg-cyan-100 group-hover:bg-cyan-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('agency.profile*') ? 'text-white' : 'text-cyan-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">ملف الوكالة</span>
                        @if(request()->routeIs('agency.profile*'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                    @endif
                </div>

                <!-- Divider -->
                <div class="my-6 border-t border-emerald-100"></div>

                <!-- Agency Stats -->
                <div class="space-y-3">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">إحصائيات الوكالة</h3>
                    
                    <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-xl p-4 border border-teal-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">إجمالي المستخدمين</p>
                                <p class="text-2xl font-bold text-teal-600">{{ \App\Models\User::where('agency_id', Auth::user()->agency_id)->count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-teal-100 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-cyan-50 to-emerald-50 rounded-xl p-4 border border-cyan-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">الأدوار النشطة</p>
                                <p class="text-2xl font-bold text-cyan-600">{{ \App\Models\Role::where('agency_id', Auth::user()->agency_id)->count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-cyan-100 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Sidebar (mobile overlay) -->
        <div x-show="openSidebar" class="fixed inset-0 z-40 flex sm:hidden">
            <div class="fixed inset-0 bg-black/30" @click="openSidebar = false"></div>
            <div class="relative w-72 bg-white/90 backdrop-blur-md shadow-2xl border-l border-emerald-100 min-h-screen z-50">
                <!-- Close button for mobile -->
                <button class="absolute top-4 left-4 text-gray-400 hover:text-red-500 text-2xl z-50" @click="openSidebar = false">&times;</button>
                <!-- Sidebar Header and Menu (copy from desktop sidebar) -->
                <div class="p-6 border-b border-emerald-100">
                    <div class="flex items-center">
                        <div class="h-12 w-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="mr-3">
                            <h2 class="text-lg font-bold text-gray-800">إدارة الوكالة</h2>
                            <p class="text-sm text-gray-500">{{ Auth::user()->agency->name ?? 'الوكالة' }}</p>
                        </div>
                    </div>
                </div>
                <!-- Navigation Menu (copy from desktop sidebar) -->
                <nav class="p-6 overflow-y-auto h-[calc(100vh-80px)]">
                    <div class="space-y-3">
                        <!-- Dashboard -->
                        <a href="{{ route('agency.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.dashboard') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                            <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.dashboard') ? 'bg-white/20' : 'bg-teal-100 group-hover:bg-teal-200' }} transition duration-200">
                                <svg class="h-5 w-5 {{ request()->routeIs('agency.dashboard') ? 'text-white' : 'text-teal-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                            </div>
                            <span class="mr-3 font-medium">لوحة التحكم</span>
                            @if(request()->routeIs('agency.dashboard'))
                                <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                        <!-- Users Management -->
                        @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('users.view'))
                        <a href="{{ route('agency.users') }}" 
                           class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.users*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                            <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.users*') ? 'bg-white/20' : 'bg-cyan-100 group-hover:bg-cyan-200' }} transition duration-200">
                                <svg class="h-5 w-5 {{ request()->routeIs('agency.users*') ? 'text-white' : 'text-cyan-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <span class="mr-3 font-medium">إدارة المستخدمين</span>
                            @if(request()->routeIs('agency.users*'))
                                <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                        @endif
                        <!-- Roles Management -->
                        @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('roles.view'))
                        <a href="{{ route('agency.roles') }}" 
                           class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.roles*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                            <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.roles*') ? 'bg-white/20' : 'bg-emerald-100 group-hover:bg-emerald-200' }} transition duration-200">
                                <svg class="h-5 w-5 {{ request()->routeIs('agency.roles*') ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <span class="mr-3 font-medium">إدارة الأدوار</span>
                            @if(request()->routeIs('agency.roles*'))
                                <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                        @endif
                        <!-- Permissions Management -->
                        @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('permissions.view'))
                        <a href="{{ route('agency.permissions') }}" 
                           class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.permissions*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                            <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.permissions*') ? 'bg-white/20' : 'bg-teal-100 group-hover:bg-teal-200' }} transition duration-200">
                                <svg class="h-5 w-5 {{ request()->routeIs('agency.permissions*') ? 'text-white' : 'text-teal-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <span class="mr-3 font-medium">إدارة الصلاحيات</span>
                            @if(request()->routeIs('agency.permissions*'))
                                <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                        @endif
                        <!-- Services Management -->
                        @if(auth()->user()->isAgencyAdmin() || auth()->user()->hasPermission('services.view'))
                        <a href="{{ route('agency.services') }}" 
                           class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.services*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                            <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.services*') ? 'bg-white/20' : 'bg-emerald-100 group-hover:bg-emerald-200' }} transition duration-200">
                                <svg class="h-5 w-5 {{ request()->routeIs('agency.services*') ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0a2 2 0 002 2h2a2 2 0 002-2m-6 0V7a2 2 0 012-2h2a2 2 0 012 2v10"></path>
                                </svg>
                            </div>
                            <span class="mr-3 font-medium">إدارة الخدمات</span>
                            @if(request()->routeIs('agency.services*'))
                                <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                        @endif
                        <!-- Agency Profile -->
                        @if(auth()->user()->isAgencyAdmin())
                        <a href="{{ route('agency.profile') }}" 
                           class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-600 rounded-xl transition duration-200 {{ request()->routeIs('agency.profile*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg' : '' }}" @click="openSidebar = false">
                            <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('agency.profile*') ? 'bg-white/20' : 'bg-cyan-100 group-hover:bg-cyan-200' }} transition duration-200">
                                <svg class="h-5 w-5 {{ request()->routeIs('agency.profile*') ? 'text-white' : 'text-cyan-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="mr-3 font-medium">ملف الوكالة</span>
                            @if(request()->routeIs('agency.profile*'))
                                <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                        @endif
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-2 sm:p-8">
            <!-- زر القائمة الجانبية للجوال -->
            <button class="sm:hidden mb-4 flex items-center gap-2 px-4 py-2 bg-teal-600 text-white rounded-lg shadow" type="button" @click="openSidebar = true">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                القائمة
            </button>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-emerald-100 p-8">
                {{ $slot }}
            </div>
        </div>
    </div>

    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html> 