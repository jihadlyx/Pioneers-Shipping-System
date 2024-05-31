@extends('site.layouts.master')

@section('title')
تفاصيل الشحنات
@endsection
@section('content')
<!-- Breadcrumb Start -->
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 text-3d font-bold text-black dark:text-white">
        الشحنات
    </h2>
    <nav>
        <ol class="flex text-lg font-medium flex-wrap items-center gap-3">
            <li>
                <a class="flex items-center gap-2 font-medium text-black hover:text-primary dark:text-white dark:hover:text-primary"
                   href="/">
                    <svg class="fill-current" width="15" height="15" viewBox="0 0 15 15" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.3503 14.6504H10.2162C9.51976 14.6504 8.93937 14.0698 8.93937 13.373V10.8183C8.93937 10.5629 8.73043 10.3538 8.47505 10.3538H6.54816C6.29279 10.3538 6.08385 10.5629 6.08385 10.8183V13.3498C6.08385 14.0465 5.50346 14.6272 4.80699 14.6272H1.62646C0.929989 14.6272 0.349599 14.0465 0.349599 13.3498V5.24444C0.349599 4.89607 0.535324 4.57092 0.837127 4.38513L6.96604 0.506623C7.29106 0.297602 7.73216 0.297602 8.05717 0.506623L14.1861 4.38513C14.4879 4.57092 14.6504 4.89607 14.6504 5.24444V13.3266C14.6504 14.0698 14.07 14.6504 13.3503 14.6504ZM6.52495 9.54098H8.45184C9.14831 9.54098 9.7287 10.1216 9.7287 10.8183V13.3498C9.7287 13.6053 9.93764 13.8143 10.193 13.8143H13.3503C13.6057 13.8143 13.8146 13.6053 13.8146 13.3498V5.26766C13.8146 5.19799 13.7682 5.12831 13.7218 5.08186L7.61608 1.20336C7.54643 1.15691 7.45357 1.15691 7.40714 1.20336L1.27822 5.08186C1.20858 5.12831 1.18536 5.19799 1.18536 5.26766V13.373C1.18536 13.6285 1.3943 13.8375 1.64967 13.8375H4.80699C5.06236 13.8375 5.2713 13.6285 5.2713 13.373V10.8183C5.24809 10.1216 5.82848 9.54098 6.52495 9.54098Z"
                            fill=""></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M7.51145 1.55118L13.465 5.33306V13.3498C13.465 13.4121 13.4126 13.4646 13.3503 13.4646H10.193C10.1307 13.4646 10.0783 13.4121 10.0783 13.3498V10.8183C10.0783 9.92844 9.34138 9.19125 8.45184 9.19125H6.52495C5.63986 9.19125 4.89529 9.92534 4.9217 10.8238V13.373C4.9217 13.4354 4.86929 13.4878 4.80699 13.4878H1.64967C1.58738 13.4878 1.53496 13.4354 1.53496 13.373V5.33323L7.51145 1.55118ZM1.27822 5.08186L7.40714 1.20336C7.45357 1.15691 7.54643 1.15691 7.61608 1.20336L13.7218 5.08186C13.7682 5.12831 13.8146 5.19799 13.8146 5.26766V13.3498C13.8146 13.6053 13.6057 13.8143 13.3503 13.8143H10.193C9.93764 13.8143 9.7287 13.6053 9.7287 13.3498V10.8183C9.7287 10.1216 9.14831 9.54098 8.45184 9.54098H6.52495C5.82848 9.54098 5.24809 10.1216 5.2713 10.8183V13.373C5.2713 13.6285 5.06236 13.8375 4.80699 13.8375H1.64967C1.3943 13.8375 1.18536 13.6285 1.18536 13.373V5.26766C1.18536 5.19799 1.20858 5.12831 1.27822 5.08186ZM13.3503 15.0001H10.2162C9.32668 15.0001 8.58977 14.2629 8.58977 13.373V10.8183C8.58977 10.756 8.53735 10.7036 8.47505 10.7036H6.54816C6.48587 10.7036 6.43345 10.756 6.43345 10.8183V13.3498C6.43345 14.2397 5.69654 14.9769 4.80699 14.9769H1.62646C0.736911 14.9769 0 14.2397 0 13.3498V5.24444C0 4.77143 0.251303 4.33603 0.651944 4.08848L6.77814 0.211698C7.21781 -0.0704034 7.80541 -0.0704031 8.24508 0.211698C8.24546 0.211943 8.24584 0.212188 8.24622 0.212433L14.3713 4.08851C14.7853 4.34436 15 4.78771 15 5.24444V13.3266C15 14.2589 14.2671 15.0001 13.3503 15.0001ZM14.1861 4.38513L8.05717 0.506623C7.73216 0.297602 7.29106 0.297602 6.96604 0.506623L0.837127 4.38513C0.535324 4.57092 0.349599 4.89607 0.349599 5.24444V13.3498C0.349599 14.0465 0.929989 14.6272 1.62646 14.6272H4.80699C5.50346 14.6272 6.08385 14.0465 6.08385 13.3498V10.8183C6.08385 10.5629 6.29279 10.3538 6.54816 10.3538H8.47505C8.73043 10.3538 8.93937 10.5629 8.93937 10.8183V13.373C8.93937 14.0698 9.51976 14.6504 10.2162 14.6504H13.3503C14.07 14.6504 14.6504 14.0698 14.6504 13.3266V5.24444C14.6504 4.89607 14.4879 4.57092 14.1861 4.38513Z"
                              fill=""></path>
                    </svg>
                    الرئيسية
                </a>
            </li>
            <li>
                <a class="flex items-center gap-3 font-medium" href="/shipments">
                    <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.4296 2.58734L3.1773 0.510459C3.3292 0.333165 3.6078 0.307837 3.8104 0.459804C3.9877 0.61177 4.0131 0.890376 3.8611 1.093L2.2148 3.04324H16.2464C16.4997 3.04324 16.7023 3.24586 16.7023 3.49914C16.7023 3.75241 16.4997 3.95504 16.2464 3.95504H2.2148L3.8611 5.90528C4.0131 6.08257 3.9877 6.36118 3.8104 6.53847C3.7345 6.61445 3.6332 6.63978 3.5318 6.63978C3.4052 6.63978 3.2786 6.58913 3.2026 6.48782L1.455 4.41094C1.0009 3.85373 1.0009 3.09389 1.4296 2.58734Z"
                            fill=""></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M3.8104 0.459804C3.6078 0.307837 3.3292 0.333165 3.1773 0.510459L1.4296 2.58734C1.0009 3.09389 1.0009 3.85373 1.455 4.41094L3.2026 6.48782C3.2786 6.58913 3.4052 6.63978 3.5318 6.63978C3.6332 6.63978 3.7345 6.61445 3.8104 6.53847C3.9877 6.36118 4.0131 6.08257 3.8611 5.90528L2.2148 3.95504H16.2464C16.4997 3.95504 16.7023 3.75241 16.7023 3.49914C16.7023 3.24586 16.4997 3.04324 16.2464 3.04324H2.2148L3.8611 1.093C4.0131 0.890376 3.9877 0.61177 3.8104 0.459804ZM2.9903 2.68302H16.2464C16.6986 2.68302 17.0625 3.04692 17.0625 3.49914C17.0625 3.95136 16.6986 4.31525 16.2464 4.31525H2.9903L4.1346 5.67085C4.1349 5.67123 4.1352 5.67161 4.1356 5.67199C4.4275 6.01385 4.354 6.50432 4.0652 6.79318C3.8978 6.96055 3.6887 7 3.5318 7C3.3205 7 3.0797 6.91713 2.9216 6.71335L1.1793 4.64286L1.1762 4.63904C0.618 3.95682 0.6042 3.00293 1.1545 2.35478C1.1547 2.35453 1.155 2.35429 1.1552 2.35404L2.9016 0.278534L2.9038 0.276033C3.1903 -0.0583053 3.6861 -0.0837548 4.0266 0.17163L4.036 0.17867L4.0449 0.186306C4.3792 0.472882 4.4047 0.968616 4.1493 1.30913L4.143 1.31743L2.9903 2.68302Z"
                              fill=""></path>
                    </svg>

                    <span class="hover:text-primary">الشحنات قيد التوصيل</span>
                </a>
            </li>
        </ol>
    </nav>
</div>
    <!-- Breadcrumb End -->

{{--@if(Session::has('message'))--}}
    {{--<div class="alert-{{ Session::get('message')["type"] }} flex  rounded-lg p-4 mb-4 text-md " role="alert">--}}
    {{--<svg class="w-5 h-5 inline ltr:mr-3 rtl:ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>--}}
    {{--<div>--}}
    {{--    <span class="font-medium">{{ Session::get('message')["title"] }} !</span> {{ Session::get('message')["text"] }}--}}
    {{--</div>--}}
    {{--</div>--}}
{{--@endif--}}
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
                            @if($isUpdate)
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
                            <th data-sortable="true" class="{{ Auth()->user()->id_type_users == 3 ? 'hidden' : '' }}" style="width: 12.086471408647142%">
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
                            <th data-sortable="true" class="red" style="width: 12.225941422594143%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>العنوان</p>
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
                            <th data-sortable="true" style="width: 10.225941422594143%">
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
                        </tr>
                    </thead>
                    <tbody>
                    <span class="hidden"> {{ $id_row = 0 }} </span>
                    @foreach($shipments as $index => $shipment)
                        @if($id_row != $shipment->ship_id)
                            <span class="hidden"> {{ $id_row =  $shipment->ship_id }} </span>
                            <tr data-index="{{ $index }}">
                                @if($isUpdate)
                                    <td class="px-4 py-5">
                                        <div class="text-gray-100 flex items-center gap-1">
                                            @if($isUpdate)
                                                <button data-target="EditShipment{{ $shipment->ship_id }}" title="تعديل" class="hover:text-primary">
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
                                                </button>
                                            @endif
                                            @if($isUpdate)
                                                <button data-target="translate{{ $shipment->ship_id }}" title="تسليم" class="hover:text-primary">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.625 9.28125C18.5 9.0625 18.3125 8.90625 18.0937 8.78125L3.68747 0.718748C3.43747 0.593748 3.15622 0.531248 2.87497 0.562498C2.59372 0.593748 2.34372 0.687498 2.12497 0.874998C1.90622 1.0625 1.74997 1.3125 1.68747 1.5625C1.59372 1.84375 1.62497 2.125 1.71872 2.40625L4.40622 10L1.71872 17.5937C1.62497 17.875 1.62497 18.1562 1.68747 18.4062C1.74997 18.6875 1.90622 18.9062 2.12497 19.0937C2.34372 19.2812 2.59372 19.375 2.87497 19.4062C2.90622 19.4062 2.96872 19.4062 2.99997 19.4062C3.21872 19.4062 3.46872 19.3437 3.68747 19.2187L18.0937 11.1562C18.3125 11.0312 18.5 10.875 18.625 10.6562C18.75 10.4375 18.8125 10.1875 18.8125 9.96875C18.8125 9.75 18.75 9.5 18.625 9.28125ZM3.06247 1.96875L16.125 9.28125H5.65622L3.06247 1.96875ZM3.06247 18.0312L5.68747 10.7187H16.1562L3.06247 18.0312Z" fill=""></path>
                                                    </svg>
                                                </button>
                                            @endif
                                            <a title="طباعة"
                                               href="{{ route('shipments.downloadShipmentData', ['page_id' => $id_page, 'ship_id' => $shipment->ship_id]) }}"
                                               onclick="() => printInvoice()"
                                               class="hover:text-meta-6">
                                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.3566 4.07803V1.96865C15.3566 1.15303 14.6816 0.478027 13.866 0.478027H4.10664C3.29102 0.478027 2.61602 1.15303 2.61602 1.96865V4.07803C1.82852 4.10615 1.18164 4.75303 1.18164 5.54053V9.59053C1.18164 10.378 1.82852 11.0249 2.61602 11.053V16.0312C2.61602 16.8468 3.29102 17.5218 4.10664 17.5218H13.8941C14.7098 17.5218 15.3848 16.8468 15.3848 16.0312V11.053C16.1723 11.0249 16.8191 10.378 16.8191 9.59053V5.54053C16.791 4.75303 16.1441 4.10615 15.3566 4.07803ZM3.90977 1.96865C3.90977 1.85615 3.99414 1.74365 4.13477 1.74365H13.9223C14.0348 1.74365 14.1473 1.82803 14.1473 1.96865V4.07803H3.90977V1.96865ZM14.091 16.0312C14.091 16.1437 14.0066 16.2562 13.866 16.2562H4.10664C3.99414 16.2562 3.88164 16.1718 3.88164 16.0312V11.053H14.091V16.0312V16.0312ZM15.5254 9.59053C15.5254 9.70303 15.441 9.81553 15.3004 9.81553H2.67227C2.55977 9.81553 2.44727 9.73115 2.44727 9.59053V5.54053C2.44727 5.42803 2.53164 5.31553 2.67227 5.31553H15.3004C15.4129 5.31553 15.5254 5.3999 15.5254 5.54053V9.59053V9.59053Z" fill=""></path>
                                                    <path d="M6.89102 13.2186H11.1098C11.4473 13.2186 11.7566 12.9373 11.7566 12.5717C11.7566 12.2061 11.4754 11.9248 11.1098 11.9248H6.89102C6.55352 11.9248 6.24414 12.2061 6.24414 12.5717C6.24414 12.9373 6.55352 13.2186 6.89102 13.2186Z" fill=""></path>
                                                    <path d="M14.0629 6.5249H11.9535C11.616 6.5249 11.3066 6.80615 11.3066 7.17178C11.3066 7.5374 11.5879 7.81865 11.9535 7.81865H14.0629C14.4004 7.81865 14.7098 7.5374 14.7098 7.17178C14.7098 6.80615 14.4285 6.5249 14.0629 6.5249Z" fill=""></path>
                                                    <path d="M6.89102 15.3562H11.1098C11.4473 15.3562 11.7566 15.075 11.7566 14.7094C11.7566 14.3437 11.4754 14.0625 11.1098 14.0625H6.89102C6.55352 14.0625 6.24414 14.3437 6.24414 14.7094C6.24414 15.075 6.55352 15.3562 6.89102 15.3562Z" fill=""></path>
                                                </svg>
                                            </a>
                                            <button onclick="searchInGoogleMaps(event)" data-address="{{ $shipment->shipment->address }}" title="{{ $shipment->address }}" class=" hover:text-meta-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 256 256" xml:space="preserve">
                                                        <defs>
                                                        </defs>
                                                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                                                <path d="M 48.647 69.718 c 13.692 0.652 24.265 4.924 24.265 10.098 C 72.912 85.44 60.415 90 45 90 s -27.912 -4.56 -27.912 -10.184 c 0 -5.173 10.573 -9.446 24.265 -10.098" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(221,200,47); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                                <path d="M 45 79.665 l 21.792 -6.211 c -3.033 -1.381 -7.032 -2.466 -11.622 -3.122 L 45 79.665 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(168,149,38); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                                <path d="M 45 0 C 30.802 0 19.291 11.51 19.291 25.709 c 0 20.07 21.265 33.961 25.709 53.956 C 48.304 53.11 48.304 26.555 45 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,49,64); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                                <path d="M 45 14.965 c -6.011 0 -10.885 4.873 -10.885 10.885 S 38.989 36.735 45 36.735 C 47.897 29.478 47.897 22.222 45 14.965 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                                <path d="M 45 0 c 14.198 0 25.709 11.51 25.709 25.709 c 0 20.07 -21.265 33.961 -25.709 53.956 V 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(199,34,46); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                                <path d="M 45 14.965 c 6.011 0 10.885 4.873 10.885 10.885 S 51.011 36.735 45 36.735 V 14.965 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(240,240,240); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                            </g>
                                                    </svg>
                                                </button>
                                        </div>
                                    </td>
                                @endif
                                <td>
                                    {{ $shipment->ship_id }}
                                </td>
                                <td>
                                    {{ $shipment->shipment->name_ship }}
                                </td>
                                <td class="{{ Auth()->user()->id_type_users == 3 ? 'hidden' : '' }}">
                                    {{ $shipment->shipment->customer->customer_name }}
                                </td>
                                <td>
                                    @if(Auth()->user()->id_type_users != 2)
                                        {{ $shipment->customer->customer_name }}
                                        <h5 class="font-medium text-black dark:text-white">
                                            0{{ $shipment->phone_number }}
                                        </h5>
                                        <h5 class="font-medium {{ $shipment->phone_number2 == null ? 'hidden' : '' }} text-black dark:text-white">
                                            0{{ $shipment->phone_number2 }}
                                        </h5>
                                    @else
                                        {{ $shipment->shipment->customer->customer_name }}
                                        <h5 class="font-medium text-black dark:text-white">
                                            0{{ $shipment->shipment->phone_number }}
                                        </h5>
                                        <h5 class="font-medium {{ $shipment->shipment->phone_number2 == null ? 'hidden' : '' }} text-black dark:text-white">
                                            0{{ $shipment->shipment->phone_number2 }}
                                        </h5>
                                    @endif
                                </td>
                                <td>
                                    <p class="inline-flex rounded-full @if($shipment->status_id == 3) bg-success text-success @elseif($shipment->status_id == 4) bg-danger text-danger @else bg-warning text-warning @endif  bg-opacity-10 px-3 py-1 text-md font-medium">
                                        {{ $shipment->state->title }}
                                    </p>
                                </td>
                                <td>
                                    {{ $shipment->city->branch->title  .' - ' . $shipment->shipment->city->title }}
                                </td>
                                <td class="green">
                                    {{ $shipment->shipment->address }}
                                </td>
                                <td class="text-center">
                                    {{ $shipment->delegate->delivery_name }}
                                    <h6 class="font-medium text-black dark:text-white">0{{ $shipment->delegate->phone_number }}</h6>
                                </td>
                                {{--                        @include('site.Shipments.modal.edit')--}}
                                {{--                        @include('site..Shipments.modal.delete')--}}
                                @include('site.Status Shipments.modal.transfer')
                            </tr>
                        @endif
                        @include('site.Shipments.modal.edit')
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

