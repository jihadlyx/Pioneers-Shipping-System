@extends('site.layouts.master')

@section('title')
    الشحنات
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            {{ $text }}
        </h2>
    </div>
    <!-- Breadcrumb End -->

    @if(Session::has('message'))
        <div class="alert-{{ Session::get('message')["type"] }} flex  rounded-lg p-4 mb-4 text-md " role="alert">
            <svg class="w-5 h-5 inline ltr:mr-3 rtl:ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                <span class="font-medium">{{ Session::get('message')["title"] }} !</span> {{ Session::get('message')["text"] }}
            </div>
        </div>
    @endif
    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="data-table-common data-table-one max-w-full overflow-x-auto">
            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                    @include('site.Shipments.modal.save')
                </div>
                <div class="datatable-top">
                    <div class="datatable-dropdown">
                        <label>
                            عدد الصفوف
                            <select class="datatable-selector">
                                <option value="5" selected="">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="-1">All</option>
                            </select>
                        </label>
                    </div>
                    <div class="datatable-search">
                        <input class="datatable-input" placeholder="بحث..." type="search" title="Search within table"
                               aria-controls="dataTableOne" />
                    </div>
                </div>
                <div class="datatable-container">
                    <table class="datatable-table table w-full table-auto" id="dataTableOne">
                        <thead>
                        <tr>
                            @if($isEmployee)
                                <th data-sortable="true" style="width: 10.549511854951188%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>#</p>
                                    </div>
                                </a>
                            </th>
                            @endif
                            <th data-sortable="true" style="width: 8.549511854951188%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>رقم الشحنة</p>
                                    </div>
                                </a>
                            </th>
                            <th data-sortable="true" style="width: 12.549511854951188%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>اسم الشحنة</p>
                                        <div class="inline-flex flex-col space-y-[2px]">
                                                <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                    </svg>
                                                </span>
                                            <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                        </path>
                                                    </svg>
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </th>
                            @if(Auth()->user()->id_type_users != 3)
                                <th data-sortable="true" style="width: 10.086471408647142%">
                                    <a href="#" class="datatable-sorter">
                                        <div class="flex items-center gap-1.5">
                                            <p>الزبون</p>
                                            <div class="inline-flex flex-col space-y-[2px]">
                                                    <span class="inline-block">
                                                        <svg class="fill-current" width="10" height="5"
                                                             viewBox="0 0 10 5" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                        </svg>
                                                    </span>
                                                <span class="inline-block">
                                                        <svg class="fill-current" width="10" height="5"
                                                             viewBox="0 0 10 5" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                            </path>
                                                        </svg>
                                                    </span>
                                            </div>
                                        </div>
                                    </a>
                                </th>
                            @endif
                            <th data-sortable="true" style="width: 10.620641562064156%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>اسم المستلم</p>
                                        <div class="inline-flex flex-col space-y-[2px]">
                                                <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                    </svg>
                                                </span>
                                            <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                        </path>
                                                    </svg>
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </th>
                            <th data-sortable="true" style="width: 12.715481171548117%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>رقم هاتف المستلم</p>
                                        <div class="inline-flex flex-col space-y-[2px]">
                                                <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                    </svg>
                                                </span>
                                            <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                        </path>
                                                    </svg>
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </th>
                            <th data-sortable="true" class="red" style="width: 12.225941422594143%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>الحالة</p>
                                        <div class="inline-flex flex-col space-y-[2px]">
                                                <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                    </svg>
                                                </span>
                                            <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                        </path>
                                                    </svg>
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </th>
                            <th data-sortable="true" style="width: 10.80195258019526%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>مكان التوصيل</p>
                                        <div class="inline-flex flex-col space-y-[2px]">
                                                <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                    </svg>
                                                </span>
                                            <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                        </path>
                                                    </svg>
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </th>
                            <th data-sortable="true" style="width: 10.80195258019526%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>السعر</p>
                                        <div class="inline-flex flex-col space-y-[2px]">
                                                <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                    </svg>
                                                </span>
                                            <span class="inline-block">
                                                    <svg class="fill-current" width="10" height="5"
                                                         viewBox="0 0 10 5" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                        </path>
                                                    </svg>
                                                </span>
                                        </div>
                                    </div>
                                </a>
                            </th>
                            @if(Auth()->user()->id_type_users != 2 && $id != 1)
                                <th data-sortable="true" class="red" style="width: 12.225941422594143%">
                                    <a href="#" class="datatable-sorter">
                                        <div class="flex items-center gap-1.5">
                                            <p>المندوب</p>
                                            <div class="inline-flex flex-col space-y-[2px]">
                                            <span class="inline-block">
                                                <svg class="fill-current" width="10" height="5"
                                                     viewBox="0 0 10 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 0L0 5H10L5 0Z" fill=""></path>
                                                </svg>
                                            </span>
                                                <span class="inline-block">
                                                <svg class="fill-current" width="10" height="5"
                                                     viewBox="0 0 10 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 5L10 0L-4.37114e-07 8.74228e-07L5 5Z" fill="">
                                                    </path>
                                                </svg>
                                            </span>
                                            </div>
                                        </div>
                                    </a>
                                </th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shipments as $index => $shipment)
                            <tr data-index="{{ $index }}">
                                @if($isEmployee)
                                    <td class="px-4 py-5">
                                        <div class="relative text-gray-100 flex items-center gap-1">
                                            <div class="absolute right-4 top-2">
                                                <div x-data="{openDropDown: false}" class="relative">
                                                    <button @click="openDropDown = !openDropDown">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M2.25 11.25C3.49264 11.25 4.5 10.2426 4.5 9C4.5 7.75736 3.49264 6.75 2.25 6.75C1.00736 6.75 0 7.75736 0 9C0 10.2426 1.00736 11.25 2.25 11.25Z" fill="#98A6AD"></path>
                                                            <path d="M9 11.25C10.2426 11.25 11.25 10.2426 11.25 9C11.25 7.75736 10.2426 6.75 9 6.75C7.75736 6.75 6.75 7.75736 6.75 9C6.75 10.2426 7.75736 11.25 9 11.25Z" fill="#98A6AD"></path>
                                                            <path d="M15.75 11.25C16.9926 11.25 18 10.2426 18 9C18 7.75736 16.9926 6.75 15.75 6.75C14.5074 6.75 13.5 7.75736 13.5 9C13.5 10.2426 14.5074 11.25 15.75 11.25Z" fill="#98A6AD"></path>
                                                        </svg>
                                                    </button>
                                                    <div x-show="openDropDown" @click.outside="openDropDown = false" class="absolute right-5 top-3 z-40 w-40 space-y-1 rounded-sm border border-stroke bg-white p-1.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                                                        @if($isUpdate)
                                                            <button data-target="EditShipment{{ $shipment->id_ship }}" class="flex hover:text-primary w-full items-center gap-2 rounded-sm px-4 py-1.5 text-left text-sm hover:bg-gray dark:hover:bg-meta-4">
                                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_62_9787)">
                                                                        <path d="M15.55 2.97499C15.55 2.77499 15.475 2.57499 15.325 2.42499C15.025 2.12499 14.725 1.82499 14.45 1.52499C14.175 1.24999 13.925 0.974987 13.65 0.724987C13.525 0.574987 13.375 0.474986 13.175 0.449986C12.95 0.424986 12.75 0.474986 12.575 0.624987L10.875 2.32499H2.02495C1.17495 2.32499 0.449951 3.02499 0.449951 3.89999V14C0.449951 14.85 1.14995 15.575 2.02495 15.575H12.15C13 15.575 13.725 14.875 13.725 14V5.12499L15.35 3.49999C15.475 3.34999 15.55 3.17499 15.55 2.97499ZM8.19995 8.99999C8.17495 9.02499 8.17495 9.02499 8.14995 9.02499L6.34995 9.62499L6.94995 7.82499C6.94995 7.79999 6.97495 7.79999 6.97495 7.77499L11.475 3.27499L12.725 4.49999L8.19995 8.99999ZM12.575 14C12.575 14.25 12.375 14.45 12.125 14.45H2.02495C1.77495 14.45 1.57495 14.25 1.57495 14V3.87499C1.57495 3.62499 1.77495 3.42499 2.02495 3.42499H9.72495L6.17495 6.99999C6.04995 7.12499 5.92495 7.29999 5.87495 7.49999L4.94995 10.3C4.87495 10.5 4.92495 10.675 5.02495 10.85C5.09995 10.95 5.24995 11.1 5.52495 11.1H5.62495L8.49995 10.15C8.67495 10.1 8.84995 9.97499 8.97495 9.84999L12.575 6.24999V14ZM13.5 3.72499L12.25 2.49999L13.025 1.72499C13.225 1.92499 14.05 2.74999 14.25 2.97499L13.5 3.72499Z" fill=""></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_62_9787">
                                                                            <rect width="20" height="20" fill="white"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                                تعديل
                                                            </button>

                                                        @endif
                                                        @if($isDelete)
                                                            <button data-target="DeleteShipment{{ $shipment->id_ship }}" class="flex hover:text-meta-1 w-full items-center gap-2 rounded-sm px-4 py-1.5 text-left text-sm hover:bg-gray dark:hover:bg-meta-4">
                                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 18 18"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z"
                                                                        fill=""></path>
                                                                    <path
                                                                        d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z"
                                                                        fill=""></path>
                                                                    <path
                                                                        d="M11.2502 9.67504C10.8846 9.64692 10.6033 9.90004 10.5752 10.2657L10.4064 12.7407C10.3783 13.0782 10.6314 13.3875 10.9971 13.4157C11.0252 13.4157 11.0252 13.4157 11.0533 13.4157C11.3908 13.4157 11.6721 13.1625 11.6721 12.825L11.8408 10.35C11.8408 9.98442 11.5877 9.70317 11.2502 9.67504Z"
                                                                        fill=""></path>
                                                                    <path
                                                                        d="M6.72245 9.67504C6.38495 9.70317 6.1037 10.0125 6.13182 10.35L6.3287 12.825C6.35683 13.1625 6.63808 13.4157 6.94745 13.4157C6.97558 13.4157 6.97558 13.4157 7.0037 13.4157C7.3412 13.3875 7.62245 13.0782 7.59433 12.7407L7.39745 10.2657C7.39745 9.90004 7.08808 9.64692 6.72245 9.67504Z"
                                                                        fill=""></path>
                                                                </svg>
                                                                حذف
                                                            </button>

                                                        @endif
                                                        <a
                                                            href="{{ route('shipments.downloadShipmentData', ['page_id' => $id_page, 'id_ship' => $shipment->id_ship]) }}"
                                                            onclick="() => printInvoice()"
                                                            class="flex hover:text-meta-6 w-full items-center gap-2 rounded-sm px-4 py-1.5 text-left text-sm hover:bg-gray dark:hover:bg-meta-4">
                                                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M18.75 10.6875C18.375 10.6875 18.0625 11 18.0625 11.375V17C18.0625 17.3125 17.8125 17.5625 17.5 17.5625H2.5C2.1875 17.5625 1.9375 17.3125 1.9375 17V11.375C1.9375 11 1.625 10.6875 1.25 10.6875C0.875 10.6875 0.5625 11 0.5625 11.375V17C0.5625 18.0625 1.4375 18.9375 2.5 18.9375H17.5C18.5625 18.9375 19.4375 18.0625 19.4375 17V11.375C19.4375 11.0313 19.125 10.6875 18.75 10.6875Z" fill=""></path>
                                                                <path d="M9.28125 12.9688C9.46875 13.1563 9.75 13.2813 10 13.2813C10.25 13.2813 10.5312 13.1875 10.7187 13L13.6875 10.0625C13.9687 9.78125 13.9687 9.34375 13.6875 9.0625C13.4062 8.78125 12.9687 8.78125 12.6875 9.0625L10.7187 11.0312V1.71875C10.7187 1.34375 10.4062 1.03125 10.0312 1.03125C9.65625 1.03125 9.34375 1.34375 9.34375 1.71875V11.0312L7.375 9.0625C7.09375 8.78125 6.65625 8.78125 6.375 9.0625C6.09375 9.34375 6.09375 9.78125 6.375 10.0625L9.28125 12.9688Z" fill=""></path>
                                                            </svg>
                                                            تحميل
                                                        </a>
                                                        @if($shipment->id_status == 1)
                                                            <button data-target="translate{{ $shipment->id_ship }}" class="flex hover:text-meta-3 w-full items-center gap-2 rounded-sm px-4 py-1.5 text-left text-sm hover:bg-gray dark:hover:bg-meta-4">
                                                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M18.625 9.28125C18.5 9.0625 18.3125 8.90625 18.0937 8.78125L3.68747 0.718748C3.43747 0.593748 3.15622 0.531248 2.87497 0.562498C2.59372 0.593748 2.34372 0.687498 2.12497 0.874998C1.90622 1.0625 1.74997 1.3125 1.68747 1.5625C1.59372 1.84375 1.62497 2.125 1.71872 2.40625L4.40622 10L1.71872 17.5937C1.62497 17.875 1.62497 18.1562 1.68747 18.4062C1.74997 18.6875 1.90622 18.9062 2.12497 19.0937C2.34372 19.2812 2.59372 19.375 2.87497 19.4062C2.90622 19.4062 2.96872 19.4062 2.99997 19.4062C3.21872 19.4062 3.46872 19.3437 3.68747 19.2187L18.0937 11.1562C18.3125 11.0312 18.5 10.875 18.625 10.6562C18.75 10.4375 18.8125 10.1875 18.8125 9.96875C18.8125 9.75 18.75 9.5 18.625 9.28125ZM3.06247 1.96875L16.125 9.28125H5.65622L3.06247 1.96875ZM3.06247 18.0312L5.68747 10.7187H16.1562L3.06247 18.0312Z" fill=""></path>
                                                                </svg>
                                                                نقل
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                @endif

                                <td>

                                    {{ $shipment->id_ship }}
                                </td>
                                <td>
                                    @if(Auth()->user()->id_type_users == 2)
                                        {{ $shipment->shipment->name_ship }}
                                    @else
                                        {{ $shipment->name_ship }}
                                    @endif
                                </td>
                                @if(Auth()->user()->id_type_users != 3)
                                    <td>
                                        @if(Auth()->user()->id_type_users == 2)
                                            {{ $shipment->shipment->customer->name_customer }}
                                        @else
                                            {{ $shipment->customer->name_customer }}
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    @if(Auth()->user()->id_type_users == 2)
                                        {{ $shipment->shipment->recipient_name }}
                                    @else
                                        {{ $shipment->recipient_name }}
                                    @endif
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                                    @if(Auth()->user()->id_type_users == 2)
                                        <h5 class="font-medium text-black dark:text-white">0{{ $shipment->shipment->phone_number }}</h5>
                                        <h5 class="font-medium {{ $shipment->shipment->phone_number2 == null ? 'hidden' : '' }} text-black dark:text-white">0{{ $shipment->shipment->phone_number2 }}</h5>
                                    @else
                                        <h5 class="font-medium text-black dark:text-white">0{{ $shipment->phone_number }}</h5>
                                        <h5 class="font-medium {{ $shipment->phone_number2 == null ? 'hidden' : '' }} text-black dark:text-white">0{{ $shipment->phone_number2 }}</h5>
                                    @endif

                                </td>
                                <td>
                                    <p class="inline-flex rounded-full @if($shipment->id_status == 3 || $shipment->id_status == 1) bg-success text-success @elseif($shipment->id_status == 4) bg-danger text-danger @else bg-warning text-warning @endif  bg-opacity-10 px-3 py-1 text-md font-medium">
                                        {{ $shipment->state->title }}
                                    </p>

                                </td>
                                <td>
                                    @if(Auth()->user()->id_type_users == 2)
                                        {{ $shipment->shipment->city->title }}
                                    @else
                                        {{ $shipment->city->title }}
                                    @endif
                                </td>
                                <td>
                                    @if(Auth()->user()->id_type_users == 2)
                                        {{ $shipment->shipment->getPrice() + $shipment->shipment->ship_value }}
                                    @else
                                        {{ $shipment->getPrice() + $shipment->ship_value }}
                                    @endif

                                </td>
                                @if(Auth()->user()->id_type_users != 2 && $shipment->id_status != 1)
                                    <td class="text-center">
                                        {{ $shipment->statusShipment($shipment->id_status)->delegate->name_delegate }}
                                        <h5 class="font-medium text-black dark:text-white">0{{ $shipment->statusShipment($shipment->id_status)->delegate->phone_number }}</h5>
                                    </td>
                                @endif
                                @include('site.Shipments.modal.edit')
                                @include('site..Shipments.modal.delete')
                                @include('site.Shipments.modal.transfer')
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="datatable-bottom">
                    <div class="datatable-info">عرض 1 الى 10 من 16 عناصر</div>
                    <nav class="datatable-pagination">
                        <ul class="datatable-pagination-list">
                            <li class="datatable-pagination-list-item datatable-hidden datatable-disabled">
                                <a data-page="1" class="datatable-pagination-list-item-link">‹</a>
                            </li>
                            <li class="datatable-pagination-list-item datatable-active">
                                <a data-page="1" class="datatable-pagination-list-item-link">1</a>
                            </li>
                            <li class="datatable-pagination-list-item">
                                <a data-page="2" class="datatable-pagination-list-item-link">2</a>
                            </li>
                            <li class="datatable-pagination-list-item">
                                <a data-page="2" class="datatable-pagination-list-item-link">›</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/table.js') }}"></script>
@endsection
