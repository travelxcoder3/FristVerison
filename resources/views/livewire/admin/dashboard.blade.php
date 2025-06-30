<div class="space-y-6 w-full px-2 sm:px-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <h1 class="text-2xl sm:text-3xl font-bold text-emerald-700 mb-2">مرحباً بك في نظام إدارة الوكالات</h1>
        <p class="text-sm sm:text-base text-gray-600">لوحة تحكم مدير النظام لإدارة وكالات السفر</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Total Agencies -->
        <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            <div class="p-3 rounded-full bg-emerald-100 text-emerald-600 mb-2">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <p class="text-xs text-gray-500">إجمالي الوكالات</p>
            <p class="text-xl font-bold text-gray-900">{{ $totalAgencies }}</p>
        </div>
        <!-- Active Agencies -->
        <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 mb-2">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-xs text-gray-500">الوكالات النشطة</p>
            <p class="text-xl font-bold text-gray-900">{{ $activeAgencies }}</p>
        </div>
        <!-- Pending Agencies -->
        <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mb-2">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-xs text-gray-500">الوكالات المعلقة</p>
            <p class="text-xl font-bold text-gray-900">{{ $pendingAgencies }}</p>
        </div>
        <!-- Agency Admins -->
        <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mb-2">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <p class="text-xs text-gray-500">مديري الوكالات</p>
            <p class="text-xl font-bold text-gray-900">{{ $totalAgencyAdmins }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg sm:text-xl font-bold text-emerald-700 mb-4">إجراءات سريعة</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('admin.add-agency') }}" 
               class="flex flex-col sm:flex-row items-start sm:items-center p-4 border border-gray-200 rounded-lg hover:bg-emerald-50 hover:border-emerald-300 transition duration-200">
                <div class="p-2 rounded-full bg-emerald-100 text-emerald-600 mb-2 sm:mb-0 sm:mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">إضافة وكالة جديدة</h3>
                    <p class="text-xs sm:text-sm text-gray-600">إضافة وكالة سفر جديدة مع تعيين مدير لها</p>
                </div>
            </a>
            <a href="{{ route('admin.agencies') }}" 
               class="flex flex-col sm:flex-row items-start sm:items-center p-4 border border-gray-200 rounded-lg hover:bg-emerald-50 hover:border-emerald-300 transition duration-200">
                <div class="p-2 rounded-full bg-blue-100 text-blue-600 mb-2 sm:mb-0 sm:mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">عرض جميع الوكالات</h3>
                    <p class="text-xs sm:text-sm text-gray-600">إدارة وتعديل الوكالات الموجودة</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Agencies -->
    <div class="hidden sm:block bg-white rounded-lg shadow-md overflow-x-auto">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg sm:text-xl font-bold text-emerald-700">آخر الوكالات المضافة</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-2 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            اسم الوكالة
                        </th>
                        <th class="px-2 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            البريد الإلكتروني
                        </th>
                        <th class="px-2 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            مدير الوكالة
                        </th>
                        <th class="px-2 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الحالة
                        </th>
                        <th class="px-2 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            تاريخ الإضافة
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentAgencies as $agency)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 sm:px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $agency->name }}</div>
                                <div class="text-xs sm:text-sm text-gray-500">{{ $agency->phone }}</div>
                            </td>
                            <td class="px-2 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $agency->email }}
                            </td>
                            <td class="px-2 sm:px-6 py-4 whitespace-nowrap">
                                @if($agency->admin)
                                    <div class="text-sm font-medium text-gray-900">{{ $agency->admin->name }}</div>
                                    <div class="text-xs sm:text-sm text-gray-500">{{ $agency->admin->email }}</div>
                                @else
                                    <span class="text-sm text-red-500">لم يتم تعيين مدير</span>
                                @endif
                            </td>
                            <td class="px-2 sm:px-6 py-4 whitespace-nowrap">
                                @if($agency->status === 'active')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        نشطة
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        معلقة
                                    </span>
                                @endif
                            </td>
                            <td class="px-2 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $agency->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-2 sm:px-6 py-4 text-center text-gray-500">
                                لا توجد وكلات مسجلة حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Cards for recent agencies on mobile -->
    <div class="block sm:hidden space-y-4">
        @forelse($recentAgencies as $agency)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col gap-2">
                <div class="font-bold text-emerald-700 mb-1">{{ $agency->name }}</div>
                <div class="text-xs text-gray-500 mb-1">{{ $agency->email }}</div>
                <div class="flex flex-wrap gap-2 text-xs mb-1">
                    @if($agency->admin)
                        <span class="inline-flex px-2 py-1 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $agency->admin->name }}</span>
                        <span class="inline-flex px-2 py-1 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $agency->admin->email }}</span>
                    @else
                        <span class="text-red-500">لم يتم تعيين مدير</span>
                    @endif
                    <span class="inline-flex px-2 py-1 font-semibold rounded-full {{ $agency->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $agency->status === 'active' ? 'نشطة' : 'معلقة' }}
                    </span>
                    <span class="text-gray-500">تاريخ الإضافة: {{ $agency->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-4 text-center text-gray-500">لا توجد وكلات مسجلة حالياً</div>
        @endforelse
    </div>
</div>
