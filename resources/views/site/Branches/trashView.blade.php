@extends('site.layouts.master')

@section('title')
    سلة المحذوفات
@endsection
@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 text-3d font-bold text-black dark:text-white">
            سلة المحذوفات
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
                    <a class="flex items-center gap-3 font-medium" href="/branches/1">
                        <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.4296 2.58734L3.1773 0.510459C3.3292 0.333165 3.6078 0.307837 3.8104 0.459804C3.9877 0.61177 4.0131 0.890376 3.8611 1.093L2.2148 3.04324H16.2464C16.4997 3.04324 16.7023 3.24586 16.7023 3.49914C16.7023 3.75241 16.4997 3.95504 16.2464 3.95504H2.2148L3.8611 5.90528C4.0131 6.08257 3.9877 6.36118 3.8104 6.53847C3.7345 6.61445 3.6332 6.63978 3.5318 6.63978C3.4052 6.63978 3.2786 6.58913 3.2026 6.48782L1.455 4.41094C1.0009 3.85373 1.0009 3.09389 1.4296 2.58734Z"
                                fill=""></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M3.8104 0.459804C3.6078 0.307837 3.3292 0.333165 3.1773 0.510459L1.4296 2.58734C1.0009 3.09389 1.0009 3.85373 1.455 4.41094L3.2026 6.48782C3.2786 6.58913 3.4052 6.63978 3.5318 6.63978C3.6332 6.63978 3.7345 6.61445 3.8104 6.53847C3.9877 6.36118 4.0131 6.08257 3.8611 5.90528L2.2148 3.95504H16.2464C16.4997 3.95504 16.7023 3.75241 16.7023 3.49914C16.7023 3.24586 16.4997 3.04324 16.2464 3.04324H2.2148L3.8611 1.093C4.0131 0.890376 3.9877 0.61177 3.8104 0.459804ZM2.9903 2.68302H16.2464C16.6986 2.68302 17.0625 3.04692 17.0625 3.49914C17.0625 3.95136 16.6986 4.31525 16.2464 4.31525H2.9903L4.1346 5.67085C4.1349 5.67123 4.1352 5.67161 4.1356 5.67199C4.4275 6.01385 4.354 6.50432 4.0652 6.79318C3.8978 6.96055 3.6887 7 3.5318 7C3.3205 7 3.0797 6.91713 2.9216 6.71335L1.1793 4.64286L1.1762 4.63904C0.618 3.95682 0.6042 3.00293 1.1545 2.35478C1.1547 2.35453 1.155 2.35429 1.1552 2.35404L2.9016 0.278534L2.9038 0.276033C3.1903 -0.0583053 3.6861 -0.0837548 4.0266 0.17163L4.036 0.17867L4.0449 0.186306C4.3792 0.472882 4.4047 0.968616 4.1493 1.30913L4.143 1.31743L2.9903 2.68302Z"
                                  fill=""></path>
                        </svg>

                        <span class="hover:text-primary">الفروع</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-3 font-medium" href="">
                        <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.4296 2.58734L3.1773 0.510459C3.3292 0.333165 3.6078 0.307837 3.8104 0.459804C3.9877 0.61177 4.0131 0.890376 3.8611 1.093L2.2148 3.04324H16.2464C16.4997 3.04324 16.7023 3.24586 16.7023 3.49914C16.7023 3.75241 16.4997 3.95504 16.2464 3.95504H2.2148L3.8611 5.90528C4.0131 6.08257 3.9877 6.36118 3.8104 6.53847C3.7345 6.61445 3.6332 6.63978 3.5318 6.63978C3.4052 6.63978 3.2786 6.58913 3.2026 6.48782L1.455 4.41094C1.0009 3.85373 1.0009 3.09389 1.4296 2.58734Z"
                                fill=""></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M3.8104 0.459804C3.6078 0.307837 3.3292 0.333165 3.1773 0.510459L1.4296 2.58734C1.0009 3.09389 1.0009 3.85373 1.455 4.41094L3.2026 6.48782C3.2786 6.58913 3.4052 6.63978 3.5318 6.63978C3.6332 6.63978 3.7345 6.61445 3.8104 6.53847C3.9877 6.36118 4.0131 6.08257 3.8611 5.90528L2.2148 3.95504H16.2464C16.4997 3.95504 16.7023 3.75241 16.7023 3.49914C16.7023 3.24586 16.4997 3.04324 16.2464 3.04324H2.2148L3.8611 1.093C4.0131 0.890376 3.9877 0.61177 3.8104 0.459804ZM2.9903 2.68302H16.2464C16.6986 2.68302 17.0625 3.04692 17.0625 3.49914C17.0625 3.95136 16.6986 4.31525 16.2464 4.31525H2.9903L4.1346 5.67085C4.1349 5.67123 4.1352 5.67161 4.1356 5.67199C4.4275 6.01385 4.354 6.50432 4.0652 6.79318C3.8978 6.96055 3.6887 7 3.5318 7C3.3205 7 3.0797 6.91713 2.9216 6.71335L1.1793 4.64286L1.1762 4.63904C0.618 3.95682 0.6042 3.00293 1.1545 2.35478C1.1547 2.35453 1.155 2.35429 1.1552 2.35404L2.9016 0.278534L2.9038 0.276033C3.1903 -0.0583053 3.6861 -0.0837548 4.0266 0.17163L4.036 0.17867L4.0449 0.186306C4.3792 0.472882 4.4047 0.968616 4.1493 1.30913L4.143 1.31743L2.9903 2.68302Z"
                                  fill=""></path>
                        </svg>

                        <span class="hover:text-primary">سلة المحذوفات</span>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    @if(Session::has('message'))
        <div class="alert-{{ Session::get('message')["type"] }} flex rounded-lg p-4 mb-4 text-md"  role="alert">
            <svg class="w-5 h-5 inline ltr:mr-3 rtl:ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                <span class="font-medium">{{ Session::get('message')["title"] }} !</span> {{ Session::get('message')["text"] }}
            </div>
        </div>
    @endif

    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="data-table-common data-table-one max-w-full overflow-x-auto">
            <form class="TrashedForm" method="POST">
                @csrf
                @method("PATCH")
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="flex items-center gap-1 border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                        <button type="button" data-target="RestoreBranch"
                                class="modal-show flex items-center gap-2 text-white hover:bg-opacity-80 rounded bg-primary px-4.5 py-2 font-bold border-b-4 border-blue-700 hover:border-blue-500 transition-transform hover:scale-95">
                            استعادة
                        </button>
                        <button type="button" data-target="DeleteTrashBranch"
                                class="bg-meta-1 transition-transform hover:scale-95 flex items-center gap-2 hover:bg-opacity-80 hover:bg-redblue-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">
                            حذف
                        </button>
                    </div>
                @include('site.Branches.modal.save')
                @include('site.branches.modal.restore')
                @include('site.branches.modal.deleteTrash')
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
                            <th data-sortable="true" style="width: 8.549511854951188%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>#</p>
                                    </div>
                                </a>
                            </th>
                            <th data-sortable="true" style="width: 8.549511854951188%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>اسم الفرع</p>
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
                            <th data-sortable="true" style="width: 9.549511854951188%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p> رقم الهاتف </p>
                                    </div>
                                </a>
                            </th>
                            <th data-sortable="true" style="width: 8.549511854951188%">
                                <a href="#" class="datatable-sorter">
                                    <div class="flex items-center gap-1.5">
                                        <p>العنوان </p>
                                    </div>
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $index => $branch)
                            <tr data-index="{{ $index }}">
                                <td class="px-4 py-5 h-full">
                                    <div x-data="{ checkboxToggle: false }">
                                        <label for="checkboxLabelOneCreate{{ $index }}"
                                               class="flex cursor-pointer select-none items-center text-sm font-medium">
                                            <div class="relative">
                                                <input class="hidden" name="branches[{{ $index }}][id]" value="{{ $branch->id_branch }}">
                                                <input type="checkbox" name="branches[{{ $index }}][check]" id="checkboxLabelOneCreate{{ $index }}" class="sr-only"
                                                       @change="checkboxToggle = !checkboxToggle"   />
                                                <div :class="checkboxToggle && 'border-primary bg-gray dark:bg-transparent'"
                                                     class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                                        <span :class="checkboxToggle && 'bg-primary'"
                                                              class="h-2.5 w-2.5 rounded-sm"></span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{ $branch->title}}
                                </td>
                                <td class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11">
                                    <h5 class="font-medium text-black dark:text-white">0{{ $branch->phone_number }}</h5>
                                    <h5 class="font-medium {{ $branch->phone_number2 ? '' : 'hidden' }} text-black dark:text-white">0{{ $branch->phone_number2 }}</h5>
                                </td>
                                <td>
                                    {{ $branch->address }}
                                </td>

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
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/table.js') }}"></script>
@endsection

