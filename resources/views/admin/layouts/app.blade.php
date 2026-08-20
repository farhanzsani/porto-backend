<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vellysia Dashboard') }} - @yield('title', 'Admin')</title>

    <style>[x-cloak]{display:none!important}</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    x-data="{ page: '', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)));
         window.addEventListener('scroll', () => {
             stickyMenu = window.scrollY > 20;
             scrollTop = window.scrollY > 300;
         });
         setTimeout(() => loaded = false, 500);"
    :class="{'dark bg-gray-900': darkMode === true}"
>
    <!-- ===== Preloader Start ===== -->
    <div
        :class="loaded ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen flex-col items-center justify-center bg-white transition-opacity duration-500 dark:bg-black"
    >
        <div class="relative flex items-center justify-center">
            <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-200 border-t-brand-500"></div>
            <svg class="absolute h-7 w-7 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <p class="mt-4 text-sm font-medium text-gray-400 dark:text-gray-500 animate-pulse">Loading...</p>
    </div>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <aside
            :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
            class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
        >
            <!-- SIDEBAR HEADER -->
            <div
                :class="sidebarToggle ? 'justify-center' : 'justify-between'"
                class="sidebar-header flex items-center gap-2 pt-8 pb-7"
            >
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                        <span class="flex items-center gap-2 text-xl font-bold text-gray-800 dark:text-white">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ config('app.name', 'Portfolio CMS') }}
                        </span>
                    </span>
                    <span class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </span>
                </a>
            </div>
            <!-- SIDEBAR HEADER -->

            <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
                <!-- Sidebar Menu -->
                <nav x-data="{selected: $persist('Dashboard')}">
                    <!-- Menu Group -->
                    <div>
                        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                            <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">MENU</span>
                            <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z" fill=""/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-4">
                            <!-- Menu Item Dashboard -->
                            <li>
                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    class="menu-item group {{ request()->routeIs('admin.dashboard') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Dashboard</span>
                                </a>
                            </li>
                            <!-- Menu Item Dashboard -->

                            <!-- Menu Item Projects -->
                            <li>
                                <a
                                    href="{{ route('admin.projects.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.projects.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.projects.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V9a2 2 0 00-2-2h-2a2 2 0 00-2 2" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Projects</span>
                                </a>
                            </li>
                            <!-- Menu Item Projects -->

                            <!-- Menu Item Technologies -->
                            <li>
                                <a
                                    href="{{ route('admin.technologies.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.technologies.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.technologies.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" fill=""/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Technologies</span>
                                </a>
                            </li>
                            <!-- Menu Item Technologies -->

                            <!-- Menu Item Work Experience -->
                            <li>
                                <a
                                    href="{{ route('admin.work-experiences.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.work-experiences.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.work-experiences.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Work Experience</span>
                                </a>
                            </li>
                            <!-- Menu Item Work Experience -->

                            <!-- Menu Item Education -->
                            <li>
                                <a
                                    href="{{ route('admin.educations.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.educations.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.educations.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Education</span>
                                </a>
                            </li>
                            <!-- Menu Item Education -->

                            <!-- Menu Item CV -->
                            <li>
                                <a
                                    href="{{ route('admin.cvs.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.cvs.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.cvs.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 4a2 2 0 012-2h8a1 1 0 01.707.293l4 4A1 1 0 0119 7v13a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm9 1.414V7h1.586L13 5.414zM6 4v16h11V9h-3a1 1 0 01-1-1V4H6zm2 9a1 1 0 011-1h6a1 1 0 110 2H9a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H9a1 1 0 01-1-1z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">CV Files</span>
                                </a>
                            </li>
                            <!-- Menu Item CV -->

                            <!-- Menu Item Certificates -->
                            <li>
                                <a
                                    href="{{ route('admin.certificates.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.certificates.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.certificates.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2a5 5 0 100 10A5 5 0 0012 2zM9 7a3 3 0 116 0 3 3 0 01-6 0zm-4.472 5.553A1 1 0 015.5 12h13a1 1 0 01.972.757l1.5 6A1 1 0 0120 20H4a1 1 0 01-.972-1.243l1.5-6zM5.677 18h12.646l-1-4H6.677l-1 4z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Certificates</span>
                                </a>
                            </li>
                            <!-- Menu Item Certificates -->

                            <!-- Menu Item Inquiries -->
                            <li>
                                <a
                                    href="{{ route('admin.inquiries.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.inquiries.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.inquiries.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }} shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Inquiries</span>
                                    @php($newInquiryCount = \App\Models\Inquiry::where('status', 'new')->count())
                                    @if ($newInquiryCount > 0)
                                        <span class="absolute top-1/2 -translate-y-1/2 right-2 shrink-0 rounded-full bg-error-500 px-1.5 py-0.5 text-xs font-medium leading-none text-white">{{ $newInquiryCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <!-- Menu Item Inquiries -->

                            <!-- Menu Item Users -->
                            <li>
                                <a
                                    href="{{ route('admin.users.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.users.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.users.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Users</span>
                                </a>
                            </li>
                            <!-- Menu Item Users -->

                            <!-- Menu Item Settings -->
                            <li>
                                <a
                                    href="{{ route('admin.settings.index') }}"
                                    class="menu-item group {{ request()->routeIs('admin.settings.*') ? 'menu-item-active' : 'menu-item-inactive' }}"
                                >
                                    <svg class="{{ request()->routeIs('admin.settings.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">Settings</span>
                                </a>
                            </li>
                            <!-- Menu Item Settings -->
                        </ul>
                    </div>

                    <!-- Others Group -->
                    <div>
                        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                            <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">others</span>
                            <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'" class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z" fill=""/>
                            </svg>
                        </h3>

                        <ul class="mb-6 flex flex-col gap-4">
                            <!-- Menu Item View Website -->
                            <li>
                                <a
                                    href="{{ url('/') }}"
                                    target="_blank"
                                    class="menu-item group"
                                >
                                    <svg class="menu-item-icon-inactive" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.75C8.94078 6.75 6.31887 8.69187 4.90875 12C6.31887 15.3081 8.94078 17.25 12 17.25C15.0592 17.25 17.6811 15.3081 19.0912 12C17.6811 8.69187 15.0592 6.75 12 6.75ZM3.36667 11.3752C5.03382 7.32503 8.21677 4.75 12 4.75C15.7832 4.75 18.9662 7.32503 20.6333 11.3752C20.789 11.7766 20.789 12.2234 20.6333 12.6248C18.9662 16.675 15.7832 19.25 12 19.25C8.21677 19.25 5.03382 16.675 3.36667 12.6248C3.21097 12.2234 3.21097 11.7766 3.36667 11.3752ZM12 10.25C10.7934 10.25 9.75 11.2934 9.75 12C9.75 12.7066 10.7934 13.75 12 13.75C13.2066 13.75 14.25 12.7066 14.25 12C14.25 11.2934 13.2066 10.25 12 10.25ZM8.25 12C8.25 10.2051 9.70507 8.75 11.5 8.75C13.2949 8.75 14.75 10.2051 14.75 12C14.75 13.7949 13.2949 15.25 11.5 15.25C9.70507 15.25 8.25 13.7949 8.25 12Z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">View Website</span>
                                </a>
                            </li>
                            <!-- Menu Item View Website -->

                            <!-- Menu Item API Docs -->
                            <li>
                                <a
                                    href="{{ url('/api/documentation') }}"
                                    target="_blank"
                                    class="menu-item group"
                                >
                                    <svg class="menu-item-icon-inactive" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 4h12v2H6V8zm0 4h7v2H6v-2zm0 4h7v2H6v-2zm11-4h1v2h-1v-2zm1 4h-1v2h1v-2z" fill=""/>
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">API Docs</span>
                                </a>
                            </li>
                            <!-- Menu Item API Docs -->
                        </ul>
                    </div>
                </nav>
                <!-- Sidebar Menu -->
            </div>
        </aside>
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
            <!-- Small Device Overlay Start -->
            <div
                @click="sidebarToggle = false"
                :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed z-9 h-screen w-full bg-gray-900/50"
            ></div>
            <!-- Small Device Overlay End -->

            <!-- ===== Header Start ===== -->
            <header
                x-data="{menuToggle: false}"
                :class="stickyMenu ? 'shadow-md bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm' : 'bg-white dark:bg-gray-900'"
                class="sticky top-0 z-99999 flex w-full border-gray-200 transition-all duration-300 lg:border-b dark:border-gray-800"
            >
                <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
                    <div class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4 dark:border-gray-800">
                        <!-- Hamburger Toggle BTN -->
                        <button
                            :class="sidebarToggle ? 'lg:bg-transparent dark:lg:bg-transparent bg-gray-100 dark:bg-gray-800' : ''"
                            class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 lg:h-11 lg:w-11 lg:border dark:border-gray-800 dark:text-gray-400"
                            @click.stop="sidebarToggle = !sidebarToggle"
                        >
                            <svg class="hidden fill-current lg:block" width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z" fill=""/>
                            </svg>
                            <svg :class="sidebarToggle ? 'hidden' : 'block lg:hidden'" class="fill-current lg:hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41422 3.25 6ZM3.25 18C3.25 17.5858 3.58579 17.25 4 17.25L20 17.25C20.4142 17.25 20.75 17.5858 20.75 18C20.75 18.4142 20.4142 18.75 20 18.75L4 18.75C3.58579 18.75 3.25 18.4142 3.25 18ZM4 11.25C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75L12 12.75C12.4142 12.75 12.75 12.4142 12.75 12C12.75 11.5858 12.4142 11.25 12 11.25L4 11.25Z" fill=""/>
                            </svg>
                            <svg :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z" fill=""/>
                            </svg>
                        </button>
                        <!-- Hamburger Toggle BTN -->

                        <a href="{{ route('admin.dashboard') }}" class="lg:hidden">
                            <span class="flex items-center gap-2 text-lg font-bold text-gray-800 dark:text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ config('app.name', 'Portfolio CMS') }}
                            </span>
                        </a>

                        <!-- Application nav menu button -->
                        <button
                            class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 lg:hidden dark:text-gray-400 dark:hover:bg-gray-800"
                            :class="menuToggle ? 'bg-gray-100 dark:bg-gray-800' : ''"
                            @click.stop="menuToggle = !menuToggle"
                        >
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99902 10.4951C6.82745 10.4951 7.49902 11.1667 7.49902 11.9951V12.0051C7.49902 12.8335 6.82745 13.5051 5.99902 13.5051C5.1706 13.5051 4.49902 12.8335 4.49902 12.0051V11.9951C4.49902 11.1667 5.1706 10.4951 5.99902 10.4951ZM17.999 10.4951C18.8275 10.4951 19.499 11.1667 19.499 11.9951V12.0051C19.499 12.8335 18.8275 13.5051 17.999 13.5051C17.1706 13.5051 16.499 12.8335 16.499 12.0051V11.9951C16.499 11.1667 17.1706 10.4951 17.999 10.4951ZM13.499 11.9951C13.499 11.1667 12.8275 10.4951 11.999 10.4951C11.1706 10.4951 10.499 11.1667 10.499 11.9951V12.0051C10.499 12.8335 11.1706 13.5051 11.999 13.5051C12.8275 13.5051 13.499 12.8335 13.499 12.0051V11.9951Z" fill=""/>
                            </svg>
                        </button>
                        <!-- Application nav menu button -->

                        <div class="hidden lg:block">
                            <h1 class="text-xl font-semibold text-gray-800 dark:text-white/90">@yield('title', 'Admin Panel')</h1>
                        </div>
                    </div>

                    <div
                        :class="menuToggle ? 'flex' : 'hidden'"
                        class="shadow-theme-md w-full items-center justify-between gap-4 px-5 py-4 lg:flex lg:justify-end lg:px-0 lg:shadow-none"
                    >
                        <div class="2xsm:gap-3 flex items-center gap-2">
                            <!-- Dark Mode Toggler -->
                            <button
                                class="relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                                @click.prevent="darkMode = !darkMode"
                            >
                                <svg class="hidden dark:block" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99998 1.5415C10.4142 1.5415 10.75 1.87729 10.75 2.2915V3.5415C10.75 3.95572 10.4142 4.2915 9.99998 4.2915C9.58577 4.2915 9.24998 3.95572 9.24998 3.5415V2.2915C9.24998 1.87729 9.58577 1.5415 9.99998 1.5415ZM10.0009 6.79327C8.22978 6.79327 6.79402 8.22904 6.79402 10.0001C6.79402 11.7712 8.22978 13.207 10.0009 13.207C11.772 13.207 13.2078 11.7712 13.2078 10.0001C13.2078 8.22904 11.772 6.79327 10.0009 6.79327ZM5.29402 10.0001C5.29402 7.40061 7.40135 5.29327 10.0009 5.29327C12.6004 5.29327 14.7078 7.40061 14.7078 10.0001C14.7078 12.5997 12.6004 14.707 10.0009 14.707C7.40135 14.707 5.29402 12.5997 5.29402 10.0001ZM15.9813 5.08035C16.2742 4.78746 16.2742 4.31258 15.9813 4.01969C15.6884 3.7268 15.2135 3.7268 14.9207 4.01969L14.0368 4.90357C13.7439 5.19647 13.7439 5.67134 14.0368 5.96423C14.3297 6.25713 14.8045 6.25713 15.0974 5.96423L15.9813 5.08035ZM18.4577 10.0001C18.4577 10.4143 18.1219 10.7501 17.7077 10.7501H16.4577C16.0435 10.7501 15.7077 10.4143 15.7077 10.0001C15.7077 9.58592 16.0435 9.25013 16.4577 9.25013H17.7077C18.1219 9.25013 18.4577 9.58592 18.4577 10.0001ZM14.9207 15.9806C15.2135 16.2735 15.6884 16.2735 15.9813 15.9806C16.2742 15.6877 16.2742 15.2128 15.9813 14.9199L15.0974 14.036C14.8045 13.7431 14.3297 13.7431 14.0368 14.036C13.7439 14.3289 13.7439 14.8038 14.0368 15.0967L14.9207 15.9806ZM9.99998 15.7088C10.4142 15.7088 10.75 16.0445 10.75 16.4588V17.7088C10.75 18.123 10.4142 18.4588 9.99998 18.4588C9.58577 18.4588 9.24998 18.123 9.24998 17.7088V16.4588C9.24998 16.0445 9.58577 15.7088 9.99998 15.7088ZM5.96356 15.0972C6.25646 14.8043 6.25646 14.3295 5.96356 14.0366C5.67067 13.7437 5.1958 13.7437 4.9029 14.0366L4.01902 14.9204C3.72613 15.2133 3.72613 15.6882 4.01902 15.9811C4.31191 16.274 4.78679 16.274 5.07968 15.9811L5.96356 15.0972ZM4.29224 10.0001C4.29224 10.4143 3.95645 10.7501 3.54224 10.7501H2.29224C1.87802 10.7501 1.54224 10.4143 1.54224 10.0001C1.54224 9.58592 1.87802 9.25013 2.29224 9.25013H3.54224C3.95645 9.25013 4.29224 9.58592 4.29224 10.0001ZM9.99998 18.4588C9.58577 18.4588 9.24998 18.123 9.24998 17.7088V16.4588C9.24998 16.0445 9.58577 15.7088 9.99998 15.7088C10.4142 15.7088 10.75 16.0445 10.75 16.4588V17.7088C10.75 18.123 10.4142 18.4588 9.99998 18.4588Z" fill="currentColor"/>
                                </svg>
                                <svg class="dark:hidden" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4547 11.97L18.1799 12.1611C18.265 11.8383 18.1265 11.4982 17.8401 11.3266C17.5538 11.1551 17.1885 11.1934 16.944 11.4207L17.4547 11.97ZM8.0306 2.5459L8.57989 3.05657C8.80718 2.81209 8.84554 2.44682 8.67398 2.16046C8.50243 1.8741 8.16227 1.73559 7.83948 1.82066L8.0306 2.5459ZM12.9154 13.0035C9.64678 13.0035 6.99707 10.3538 6.99707 7.08524H5.49707C5.49707 11.1823 8.81835 14.5035 12.9154 14.5035V13.0035ZM16.944 11.4207C15.8869 12.4035 14.4721 13.0035 12.9154 13.0035V14.5035C14.8657 14.5035 16.6418 13.7499 17.9654 12.5193L16.944 11.4207ZM16.7295 11.7789C15.9437 14.7607 13.2277 16.9586 10.0003 16.9586V18.4586C13.9257 18.4586 17.2249 15.7853 18.1799 12.1611L16.7295 11.7789ZM10.0003 16.9586C6.15734 16.9586 3.04199 13.8433 3.04199 10.0003H1.54199C1.54199 14.6717 5.32892 18.4586 10.0003 18.4586V16.9586ZM3.04199 10.0003C3.04199 6.77289 5.23988 4.05695 8.22173 3.27114L7.83948 1.82066C4.21532 2.77574 1.54199 6.07486 1.54199 10.0003H3.04199ZM6.99707 7.08524C6.99707 5.52854 7.5971 4.11366 8.57989 3.05657L7.48132 2.03522C6.25073 3.35885 5.49707 5.13487 5.49707 7.08524H6.99707Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <!-- Dark Mode Toggler -->

                            <!-- Notification Menu Area -->
                            <div
                                class="relative"
                                x-data="{ dropdownOpen: false, notifying: @json($newInquiryCount > 0) }"
                                @click.outside="dropdownOpen = false"
                            >
                                <button
                                    class="relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                                    @click.prevent="dropdownOpen = ! dropdownOpen; notifying = false"
                                >
                                    <span
                                        :class="!notifying ? 'hidden' : 'flex'"
                                        class="absolute top-0.5 right-0 z-1 flex h-2 w-2 rounded-full bg-orange-400"
                                    >
                                        <span class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-orange-400 opacity-75"></span>
                                    </span>
                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.75 2.29248C10.75 1.87827 10.4143 1.54248 10 1.54248C9.58583 1.54248 9.25004 1.87827 9.25004 2.29248V2.83613C6.08266 3.20733 3.62504 5.9004 3.62504 9.16748V14.4591H3.33337C2.91916 14.4591 2.58337 14.7949 2.58337 15.2091C2.58337 15.6234 2.91916 15.9591 3.33337 15.9591H4.37504H15.625H16.6667C17.0809 15.9591 17.4167 15.6234 17.4167 15.2091C17.4167 14.7949 17.0809 14.4591 16.6667 14.4591H16.375V9.16748C16.375 5.9004 13.9174 3.20733 10.75 2.83613V2.29248ZM14.875 14.4591V9.16748C14.875 6.47509 12.6924 4.29248 10 4.29248C7.30765 4.29248 5.12504 6.47509 5.12504 9.16748V14.4591H14.875ZM8.00004 17.7085C8.00004 18.1228 8.33583 18.4585 8.75004 18.4585H11.25C11.6643 18.4585 12 18.1228 12 17.7085C12 17.2943 11.6643 16.9585 11.25 16.9585H8.75004C8.33583 16.9585 8.00004 17.2943 8.00004 17.7085Z" fill=""/>
                                    </svg>
                                </button>

                                <!-- Dropdown Start -->
                                <div
                                    x-show="dropdownOpen"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                    class="shadow-theme-lg absolute -right-[240px] mt-[17px] flex max-h-[480px] w-[350px] flex-col rounded-2xl border border-gray-200 bg-white p-3 sm:w-[361px] lg:right-0 dark:border-gray-800 dark:bg-gray-dark"
                                >
                                    <div class="mb-3 flex items-center justify-between border-b border-gray-100 pb-3 dark:border-gray-800">
                                        <h5 class="text-lg font-semibold text-gray-800 dark:text-white/90">Notification</h5>
                                        <button @click="dropdownOpen = false" class="text-gray-500 dark:text-gray-400">
                                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z" fill=""/>
                                            </svg>
                                        </button>
                                    </div>

                                    <ul class="custom-scrollbar flex h-auto flex-col overflow-y-auto">
                                        @php($newInquiries = \App\Models\Inquiry::where('status', 'new')->latest()->take(6)->get())
                                        @forelse ($newInquiries as $inquiry)
                                            <li>
                                                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5" href="{{ route('admin.inquiries.show', $inquiry) }}">
                                                    <span class="relative z-1 flex h-10 w-10 items-center justify-center rounded-full bg-brand-50 text-brand-500 dark:bg-brand-500/15 dark:text-brand-400">
                                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" fill=""/>
                                                        </svg>
                                                    </span>
                                                    <span class="block">
                                                        <span class="text-theme-sm mb-1.5 block text-gray-500 dark:text-gray-400">
                                                            <span class="font-medium text-gray-800 dark:text-white/90">{{ $inquiry->name }}</span>
                                                            sent a new inquiry
                                                        </span>
                                                        <span class="text-theme-xs flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                                            <span>{{ $inquiry->subject ?: 'General' }}</span>
                                                            <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                                                            <span>{{ $inquiry->created_at->diffForHumans() }}</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                        @empty
                                            <li class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">No new notifications.</li>
                                        @endforelse
                                    </ul>

                                    <a href="{{ route('admin.inquiries.index') }}" class="text-theme-sm shadow-theme-xs mt-3 flex justify-center rounded-lg border border-gray-300 bg-white p-3 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        View All Notifications
                                    </a>
                                </div>
                                <!-- Dropdown End -->
                            </div>
                            <!-- Notification Menu Area -->
                        </div>

                        <!-- User Area -->
                        <div
                            class="relative"
                            x-data="{ dropdownOpen: false }"
                            @click.outside="dropdownOpen = false"
                        >
                            <a
                                class="flex items-center text-gray-700 dark:text-gray-400"
                                href="#"
                                @click.prevent="dropdownOpen = ! dropdownOpen"
                            >
                                <span class="mr-3 flex h-11 w-11 items-center justify-center rounded-full bg-brand-500 text-sm font-bold text-white">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                                <span class="text-theme-sm mr-1 block font-medium">{{ auth()->user()->name }}</span>
                                <svg :class="dropdownOpen && 'rotate-180'" class="stroke-gray-500 dark:stroke-gray-400" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.3125 8.65625L9 13.3437L13.6875 8.65625" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>

                            <!-- Dropdown Start -->
                            <div
                                x-show="dropdownOpen"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                class="shadow-theme-lg absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3 dark:border-gray-800 dark:bg-gray-dark"
                            >
                                <div>
                                    <span class="text-theme-sm block font-medium text-gray-700 dark:text-gray-400">{{ auth()->user()->name }}</span>
                                    <span class="text-theme-xs mt-0.5 block text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</span>
                                </div>

                                <ul class="flex flex-col gap-1 border-b border-gray-200 pt-4 pb-3 dark:border-gray-800">
                                    <li>
                                        <a href="{{ route('admin.users.edit', auth()->user()) }}" class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                            <svg class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z" fill=""/>
                                            </svg>
                                            Edit profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/') }}" target="_blank" class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                            <svg class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM7.28867 9.25H4.51877C4.63988 8.3532 4.90665 7.50407 5.29408 6.72713C6.10231 7.83018 6.95047 8.66368 7.28867 9.25ZM4.51877 14.75H7.28867C6.95047 15.3363 6.10231 16.1698 5.29408 17.2729C4.90665 16.4959 4.63988 15.6468 4.51877 14.75ZM9.04623 14.75H14.9538C14.4405 16.5922 13.3296 18.0033 12 18.847C10.6704 18.0033 9.55953 16.5922 9.04623 14.75ZM9.04623 9.25C9.55953 7.40779 10.6704 5.99671 12 5.15298C13.3296 5.99671 14.4405 7.40779 14.9538 9.25H9.04623ZM16.7113 9.25C17.0495 8.66368 17.8977 7.83018 18.7059 6.72713C19.0933 7.50407 19.3601 8.3532 19.4812 9.25H16.7113ZM16.7113 14.75H19.4812C19.3601 15.6468 19.0933 16.4959 18.7059 17.2729C17.8977 16.1698 17.0495 15.3363 16.7113 14.75ZM14.9538 9.25H9.04623C9.55953 7.40779 10.6704 5.99671 12 5.15298C13.3296 5.99671 14.4405 7.40779 14.9538 9.25Z" fill=""/>
                                            </svg>
                                            View Website
                                        </a>
                                    </li>
                                </ul>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="group text-theme-sm mt-3 flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                        <svg class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1007 19.247C14.6865 19.247 14.3507 18.9112 14.3507 18.497L14.3507 14.245H12.8507V18.497C12.8507 19.7396 13.8581 20.747 15.1007 20.747H18.5007C19.7434 20.747 20.7507 19.7396 20.7507 18.497L20.7507 5.49609C20.7507 4.25345 19.7433 3.24609 18.5007 3.24609H15.1007C13.8581 3.24609 12.8507 4.25345 12.8507 5.49609V9.74501L14.3507 9.74501V5.49609C14.3507 5.08188 14.6865 4.74609 15.1007 4.74609L18.5007 4.74609C18.9149 4.74609 19.2507 5.08188 19.2507 5.49609L19.2507 18.497C19.2507 18.9112 18.9149 19.247 18.5007 19.247H15.1007ZM3.25073 11.9984C3.25073 12.2144 3.34204 12.4091 3.48817 12.546L8.09483 17.1556C8.38763 17.4485 8.86251 17.4487 9.15549 17.1559C9.44848 16.8631 9.44863 16.3882 9.15583 16.0952L5.81116 12.7484L16.0007 12.7484C16.4149 12.7484 16.7507 12.4127 16.7507 11.9984C16.7507 11.5842 16.4149 11.2484 16.0007 11.2484L5.81528 11.2484L9.15585 7.90554C9.44864 7.61255 9.44847 7.13767 9.15547 6.84488C8.86248 6.55209 8.3876 6.55226 8.09481 6.84525L3.52309 11.4202C3.35673 11.5577 3.25073 11.7657 3.25073 11.9984Z" fill=""/>
                                        </svg>
                                        Sign out
                                    </button>
                                </form>
                            </div>
                            <!-- Dropdown End -->
                        </div>
                        <!-- User Area -->
                    </div>
                </div>
            </header>
            <!-- ===== Header End ===== -->

            @if (session('success'))
                <div class="px-4 pt-4 md:px-6">
                    <div class="flex items-center gap-3 rounded-2xl border border-success-100 bg-success-50 px-4 py-3 text-sm font-medium text-success-700 dark:border-success-500/20 dark:bg-success-500/10 dark:text-success-500">
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.54199C5.32244 1.54199 1.54199 5.32244 1.54199 10C1.54199 14.6776 5.32244 18.458 10 18.458C14.6776 18.458 18.458 14.6776 18.458 10C18.458 5.32244 14.6776 1.54199 10 1.54199ZM13.4508 7.42482C13.7387 7.11835 13.7234 6.64366 13.4169 6.35579C13.1104 6.06792 12.6357 6.08321 12.3479 6.38969L8.64917 10.2947L7.54921 9.17168C7.26092 8.866 6.78618 8.85039 6.4805 9.13868C6.17482 9.42697 6.15921 9.90171 6.4475 10.2074L8.04879 11.8539C8.19769 12.0079 8.40706 12.0869 8.62124 12.0704C8.83542 12.0539 9.02913 11.9435 9.15022 11.7693L13.4508 7.42482Z" fill=""/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="px-4 pt-4 md:px-6">
                    <div class="flex items-center gap-3 rounded-2xl border border-error-100 bg-error-50 px-4 py-3 text-sm font-medium text-error-700 dark:border-error-500/20 dark:bg-error-500/10 dark:text-error-500">
                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.54199C5.32244 1.54199 1.54199 5.32244 1.54199 10C1.54199 14.6776 5.32244 18.458 10 18.458C14.6776 18.458 18.458 14.6776 18.458 10C18.458 5.32244 14.6776 1.54199 10 1.54199ZM10 5.70866C10.4142 5.70866 10.75 6.04444 10.75 6.45866V11.292C10.75 11.7062 10.4142 12.042 10 12.042C9.58579 12.042 9.25 11.7062 9.25 11.292V6.45866C9.25 6.04444 9.58579 5.70866 10 5.70866ZM10 13.9587C10.4142 13.9587 10.75 14.2944 10.75 14.7087C10.75 15.1229 10.4142 15.4587 10 15.4587C9.58579 15.4587 9.25 15.1229 9.25 14.7087C9.25 14.2944 9.58579 13.9587 10 13.9587Z" fill=""/>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="px-4 pt-4 md:px-6">
                    <div class="flex flex-col gap-1 rounded-2xl border border-error-100 bg-error-50 px-4 py-3 text-sm font-medium text-error-700 dark:border-error-500/20 dark:bg-error-500/10 dark:text-error-500">
                        <p class="flex items-center gap-3">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.54199C5.32244 1.54199 1.54199 5.32244 1.54199 10C1.54199 14.6776 5.32244 18.458 10 18.458C14.6776 18.458 18.458 14.6776 18.458 10C18.458 5.32244 14.6776 1.54199 10 1.54199ZM10 5.70866C10.4142 5.70866 10.75 6.04444 10.75 6.45866V11.292C10.75 11.7062 10.4142 12.042 10 12.042C9.58579 12.042 9.25 11.7062 9.25 11.292V6.45866C9.25 6.04444 9.58579 5.70866 10 5.70866ZM10 13.9587C10.4142 13.9587 10.75 14.2944 10.75 14.7087C10.75 15.1229 10.4142 15.4587 10 15.4587C9.58579 15.4587 9.25 15.1229 9.25 14.7087C9.25 14.2944 9.58579 13.9587 10 13.9587Z" fill=""/>
                            </svg>
                            There were some problems with your input.
                        </p>
                        <ul class="ml-8 list-disc space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- ===== Main Content Start ===== -->
            <main class="page-enter">
                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
                    @yield('content')
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <!-- ===== Scroll To Top Start ===== -->
    <button
        x-show="scrollTop"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-8 z-50 flex h-11 w-11 items-center justify-center rounded-full bg-brand-500 text-white shadow-lg transition-colors hover:bg-brand-600 focus:outline-none"
        aria-label="Scroll to top"
    >
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 15l-6-6-6 6"/>
        </svg>
    </button>
    <!-- ===== Scroll To Top End ===== -->
</body>
</html>