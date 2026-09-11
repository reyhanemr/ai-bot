<div :class="{'dark text-white-dark' : $store.app.semidark}">
    <nav
        x-data="sidebar"
        class="sidebar fixed top-0 bottom-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300"
    >
        <div class="h-full bg-white dark:bg-[#0e1726]">
            <div class="flex items-center justify-between px-4 py-3">
                <a href="{{route('admin.dashboard')}}" class="flex items-center main-logo shrink-0">
                    <img class="ml-[5px] w-8 flex-none" src="{{url('panel/images/logo.svg')}}" alt="image" />
                    <span class="align-middle text-sm font-Titr text-blue-primary-500 font-semibold ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light lg:inline">انجمن دانش آموختگان <br>دانشگاه صنعتی شیراز</span>
                </a>
                <a
                    href="javascript:;"
                    class="flex items-center w-8 h-8 transition duration-300 rounded-full collapse-icon hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10"
                    @click="$store.app.toggleSidebar()"
                >
                    <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            opacity="0.5"
                            d="M16.9998 19L10.9998 12L16.9998 5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </a>
            </div>
            <ul
                class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
                x-data="{ activeDropdown: 'dashboard' }"
            >
{{--                @if(\Illuminate\Support\Facades\Auth::user()->role==\App\Enums\UserRole::ADMIN->value || \Illuminate\Support\Facades\Auth::user()->role==\App\Enums\UserRole::SUPER_ADMIN->value)--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'users'}"--}}
{{--                            @click="activeDropdown === 'users' ? activeDropdown = null : activeDropdown = 'users'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg class="group-hover:!text-primary" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M12 12C14.8 12 17 9.8 17 7C17 4.2 14.8 2 12 2C9.2 2 7 4.2 7 7C7 9.8 9.2 12 12 12ZM12 14C8.7 14 2 15.7 2 19V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20V19C22 15.7 15.3 14 12 14Z" fill="currentColor"/>--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">کاربران</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'users'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'users'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.users.index') }}">لیست کاربران</a></li>--}}
{{--                            <li><a href="{{ route('admin.users.create') }}">ایجاد کاربر جدید</a></li>--}}
{{--                            <li><a href="{{ route('admin.users.registration') }}">درخواست های عضویت</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'events'}"--}}
{{--                            @click="activeDropdown === 'events' ? activeDropdown = null : activeDropdown = 'events'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />--}}
{{--                                </svg>--}}


{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"> رویداد ها</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'events'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'events'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.events.index') }}">لیست رویداد ها</a></li>--}}
{{--                            <li><a href="{{ route('admin.events.create') }}">ایجاد رویداد جدید</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'news_and_announcements'}"--}}
{{--                            @click="activeDropdown === 'news_and_announcements' ? activeDropdown = null : activeDropdown = 'news_and_announcements'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2 2 2h4a2 2 0 012 2v11a2 2 0 01-2 2z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8M8 14h6" />--}}
{{--                                </svg>--}}



{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"> اخبار و اطلاعیه ها</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'news_and_announcements'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'news_and_announcements'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.news_and_announcements.index') }}">لیست اخبار و اطلاعیه ها ها</a></li>--}}
{{--                            <li><a href="{{ route('admin.news_and_announcements.create') }}">ایجاد اخبار و اطلاعیه ها جدید</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'documents'}"--}}
{{--                            @click="activeDropdown === 'documents' ? activeDropdown = null : activeDropdown = 'documents'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />--}}
{{--                                </svg>--}}



{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"> مستندات</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'documents'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'documents'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.documents.index') }}">لیست فایل های مستندات </a></li>--}}
{{--                            <li><a href="{{ route('admin.documents.create') }}">ایجاد مستند جدید</a></li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'subscription_plan'}"--}}
{{--                            @click="activeDropdown === 'subscription_plan' ? activeDropdown = null : activeDropdown = 'subscription_plan'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-8-8h8a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8a2 2 0 012-2z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 0v4m0-4h4m-4 0H8" />--}}
{{--                                </svg>--}}



{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"> پلن های اشتراک</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'subscription_plan'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'subscription_plan'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.subscription_plans.index') }}">لیست پلن های اشتراک </a></li>--}}
{{--                            <li><a href="{{ route('admin.subscription_plans.create') }}">ایجاد پلن های اشتراک جدید</a></li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'alumni'}"--}}
{{--                            @click="activeDropdown === 'alumni' ? activeDropdown = null : activeDropdown = 'alumni'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}



{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"> دانش آموختگان</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'alumni'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'alumni'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.alumnis.index') }}">لیست دانش آموختگان </a></li>--}}
{{--                            <li><a href="{{ route('admin.alumnis.create') }}">ایجاد دانش آموخته جدید</a></li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'sponsor'}"--}}
{{--                            @click="activeDropdown === 'sponsor' ? activeDropdown = null : activeDropdown = 'sponsor'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">حامیان</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'sponsor'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'sponsor'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.sponsors.index') }}">لیست حامیان </a></li>--}}
{{--                            <li><a href="{{ route('admin.sponsors.create') }}">ایجاد حامی جدید</a></li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'gallery'}"--}}
{{--                            @click="activeDropdown === 'gallery' ? activeDropdown = null : activeDropdown = 'gallery'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">گالری تصاویر</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'gallery'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'gallery'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.gallery.index') }}">گالری تصاویر </a></li>--}}
{{--                            <li><a href="{{ route('admin.gallery.create') }}">افزودن تصویر جدید</a></li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'executive_members'}"--}}
{{--                            @click="activeDropdown === 'executive_members' ? activeDropdown = null : activeDropdown = 'executive_members'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">هیات اجرایی </span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'executive_members'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'executive_members'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.executive_members.index') }}">هیات اجرایی </a></li>--}}
{{--                            <li><a href="{{ route('admin.executive_members.create') }}">افزودن هیات اجرایی  جدید</a></li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'about_us'}"--}}
{{--                            @click="activeDropdown === 'about_us' ? activeDropdown = null : activeDropdown = 'about_us'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">درباره ما</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'about_us'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'about_us'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.about_us.index') }}">درباره ما</a></li>--}}
{{--                            <li><a href="{{ route('admin.about_us.create') }}">افزودن درباره ما جدید</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'contact_us'}"--}}
{{--                            @click="activeDropdown === 'contact_us' ? activeDropdown = null : activeDropdown = 'contact_us'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">ارتباط با ما</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'contact_us'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'contact_us'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.contact_us.index') }}">ارتباط با ما</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'services'}"--}}
{{--                            @click="activeDropdown === 'services' ? activeDropdown = null : activeDropdown = 'services'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">سرویس ها</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'services'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'services'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.services.index') }}">لیست سرویس ها</a></li>--}}
{{--                            <li><a href="{{ route('admin.services.create') }}">ایجاد سرویس جدید</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'elections'}"--}}
{{--                            @click="activeDropdown === 'elections' ? activeDropdown = null : activeDropdown = 'elections'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7.5" />--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">انتخابات</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'elections'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'elections'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{ route('admin.elections.index') }}">مدیریت انتخابات</a></li>--}}
{{--                            <li><a href="{{ route('admin.candidates.index') }}">مدیریت کاندیداها</a></li>--}}
{{--                            <li><a href="{{ route('admin.election-results.index') }}">نتایج انتخابات</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}


{{--                @elseif(\Illuminate\Support\Facades\Auth::user()->role==\App\Enums\UserRole::MEMBER->value)--}}
{{--                    <li class="menu nav-item">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            class="nav-link group"--}}
{{--                            :class="{'active' : activeDropdown === 'profile'}"--}}
{{--                            @click="activeDropdown === 'profile' ? activeDropdown = null : activeDropdown = 'profile'"--}}
{{--                        >--}}
{{--                            <div class="flex items-center">--}}
{{--                                <svg class="group-hover:!text-primary" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M12 12C14.8 12 17 9.8 17 7C17 4.2 14.8 2 12 2C9.2 2 7 4.2 7 7C7 9.8 9.2 12 12 12ZM12 14C8.7 14 2 15.7 2 19V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20V19C22 15.7 15.3 14 12 14Z" fill="currentColor"/>--}}
{{--                                </svg>--}}

{{--                                <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">پروفایل</span>--}}
{{--                            </div>--}}
{{--                            <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'profile'}">--}}
{{--                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                        <ul x-cloak x-show="activeDropdown === 'profile'" x-collapse class="text-gray-500 sub-menu">--}}
{{--                            <li><a href="{{route('admin.member_profile.index')}}"> اطلاعات کاربری</a></li>--}}
{{--                            <li><a href="{{route('admin.educational_background.index')}}">سوابق تحصیلی</a></li>--}}
{{--                            <li><a href="{{route('admin.work_experience.index')}}">سوابق کاری</a></li>--}}
{{--                            <li><a href="{{route('admin.skill.index')}}">مهارت ها</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}






            </ul>
        </div>
    </nav>
</div>
