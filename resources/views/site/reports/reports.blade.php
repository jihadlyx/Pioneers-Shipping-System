@extends('site.layouts.master')

@section('title')
    التقارير
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 text-3d font-bold text-black dark:text-white">
            التقارير
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
                    <a class="flex items-center gap-3 font-medium" href="/reports/12">
                        <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.4296 2.58734L3.1773 0.510459C3.3292 0.333165 3.6078 0.307837 3.8104 0.459804C3.9877 0.61177 4.0131 0.890376 3.8611 1.093L2.2148 3.04324H16.2464C16.4997 3.04324 16.7023 3.24586 16.7023 3.49914C16.7023 3.75241 16.4997 3.95504 16.2464 3.95504H2.2148L3.8611 5.90528C4.0131 6.08257 3.9877 6.36118 3.8104 6.53847C3.7345 6.61445 3.6332 6.63978 3.5318 6.63978C3.4052 6.63978 3.2786 6.58913 3.2026 6.48782L1.455 4.41094C1.0009 3.85373 1.0009 3.09389 1.4296 2.58734Z"
                                fill=""></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M3.8104 0.459804C3.6078 0.307837 3.3292 0.333165 3.1773 0.510459L1.4296 2.58734C1.0009 3.09389 1.0009 3.85373 1.455 4.41094L3.2026 6.48782C3.2786 6.58913 3.4052 6.63978 3.5318 6.63978C3.6332 6.63978 3.7345 6.61445 3.8104 6.53847C3.9877 6.36118 4.0131 6.08257 3.8611 5.90528L2.2148 3.95504H16.2464C16.4997 3.95504 16.7023 3.75241 16.7023 3.49914C16.7023 3.24586 16.4997 3.04324 16.2464 3.04324H2.2148L3.8611 1.093C4.0131 0.890376 3.9877 0.61177 3.8104 0.459804ZM2.9903 2.68302H16.2464C16.6986 2.68302 17.0625 3.04692 17.0625 3.49914C17.0625 3.95136 16.6986 4.31525 16.2464 4.31525H2.9903L4.1346 5.67085C4.1349 5.67123 4.1352 5.67161 4.1356 5.67199C4.4275 6.01385 4.354 6.50432 4.0652 6.79318C3.8978 6.96055 3.6887 7 3.5318 7C3.3205 7 3.0797 6.91713 2.9216 6.71335L1.1793 4.64286L1.1762 4.63904C0.618 3.95682 0.6042 3.00293 1.1545 2.35478C1.1547 2.35453 1.155 2.35429 1.1552 2.35404L2.9016 0.278534L2.9038 0.276033C3.1903 -0.0583053 3.6861 -0.0837548 4.0266 0.17163L4.036 0.17867L4.0449 0.186306C4.3792 0.472882 4.4047 0.968616 4.1493 1.30913L4.143 1.31743L2.9903 2.68302Z"
                                  fill=""></path>
                        </svg>

                        <span class="hover:text-primary">التقارير</span>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->
    {{--    @if(Session::has('message'))--}}
    {{--        <div class="alert-{{ Session::get('message')["type"] }} flex  rounded-lg p-4 mb-4 text-md " role="alert">--}}
    {{--            <svg class="w-5 h-5 inline ltr:mr-3 rtl:ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>--}}
    {{--            <div>--}}
    {{--                <span class="font-medium">{{ Session::get('message')["title"] }} !</span> {{ Session::get('message')["text"] }}--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    @endif--}}

    <div id="print" class="mb-10 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="p-4 sm:p-6 xl:p-9">

            <div class="mb-10 flex flex-wrap items-center justify-between gap-3.5">
                <div>
                    <img class="hidden !print:flex" width="100px" src="{{ asset('assets/images/logo/light-logo.png') }}" />
                </div>
                <button id="btn-print" class="inline-flex print:hidden items-center gap-2.5 rounded bg-meta-3 px-4 py-2 font-medium text-white hover:bg-opacity-90">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.3566 4.07803V1.96865C15.3566 1.15303 14.6816 0.478027 13.866 0.478027H4.10664C3.29102 0.478027 2.61602 1.15303 2.61602 1.96865V4.07803C1.82852 4.10615 1.18164 4.75303 1.18164 5.54053V9.59053C1.18164 10.378 1.82852 11.0249 2.61602 11.053V16.0312C2.61602 16.8468 3.29102 17.5218 4.10664 17.5218H13.8941C14.7098 17.5218 15.3848 16.8468 15.3848 16.0312V11.053C16.1723 11.0249 16.8191 10.378 16.8191 9.59053V5.54053C16.791 4.75303 16.1441 4.10615 15.3566 4.07803ZM3.90977 1.96865C3.90977 1.85615 3.99414 1.74365 4.13477 1.74365H13.9223C14.0348 1.74365 14.1473 1.82803 14.1473 1.96865V4.07803H3.90977V1.96865ZM14.091 16.0312C14.091 16.1437 14.0066 16.2562 13.866 16.2562H4.10664C3.99414 16.2562 3.88164 16.1718 3.88164 16.0312V11.053H14.091V16.0312V16.0312ZM15.5254 9.59053C15.5254 9.70303 15.441 9.81553 15.3004 9.81553H2.67227C2.55977 9.81553 2.44727 9.73115 2.44727 9.59053V5.54053C2.44727 5.42803 2.53164 5.31553 2.67227 5.31553H15.3004C15.4129 5.31553 15.5254 5.3999 15.5254 5.54053V9.59053V9.59053Z" fill=""></path>
                        <path d="M6.89102 13.2186H11.1098C11.4473 13.2186 11.7566 12.9373 11.7566 12.5717C11.7566 12.2061 11.4754 11.9248 11.1098 11.9248H6.89102C6.55352 11.9248 6.24414 12.2061 6.24414 12.5717C6.24414 12.9373 6.55352 13.2186 6.89102 13.2186Z" fill=""></path>
                        <path d="M14.0629 6.5249H11.9535C11.616 6.5249 11.3066 6.80615 11.3066 7.17178C11.3066 7.5374 11.5879 7.81865 11.9535 7.81865H14.0629C14.4004 7.81865 14.7098 7.5374 14.7098 7.17178C14.7098 6.80615 14.4285 6.5249 14.0629 6.5249Z" fill=""></path>
                        <path d="M6.89102 15.3562H11.1098C11.4473 15.3562 11.7566 15.075 11.7566 14.7094C11.7566 14.3437 11.4754 14.0625 11.1098 14.0625H6.89102C6.55352 14.0625 6.24414 14.3437 6.24414 14.7094C6.24414 15.075 6.55352 15.3562 6.89102 15.3562Z" fill=""></path>
                    </svg>
                    طباعة
                </button>
            </div>

            <div class="flex flex-wrap justify-between gap-5">
                <div>
                    <p class="mb-1.5 text-title-sm font-bold text-black dark:text-white">
                        اصدار من :
                    </p>
                    <h4 class="mb-3 text-xl font-bold text-black dark:text-white">
                        {{ $branch->title }}
                    </h4>
                    <a href="#" class="text-lg block"><span class="font-bold text-black dark:text-white">الهاتف :</span>
                        0{{ $branch->phone_number }}</a>
                    <span class="mt-1.5 text-lg block"><span class="font-bold  text-black dark:text-white">العنوان :</span>
                      {{ $branch->address }}</span>
                </div>

                <div class="ml-10">
                    <p class="mb-1.5  text-title-sm font-bold text-black dark:text-white">
                        ارسال الى :
                    </p>
                    <h4 class="mb-3 text-xl font-bold text-black dark:text-white">
                        @if(isset($sendTo))
                            {{ $sendTo->delivery_name }}
                        @else
                            {{ $user->getName() }}
                        @endif
                    </h4>
                    <a href="#" class="text-lg block"><span class="font-bold text-black dark:text-white">الهاتف :</span>
                        @if(isset($sendTo))
                            0{{ $sendTo->phone_number }}
                        @else
                            0{{ $user->findUserByType($user->id_type_users)->phone_number }}
                        @endif
                        </a>
                    <span class="mt-1.5 text-lg block"><span class="font-bold  text-black dark:text-white">العنوان :</span>
                        @if(isset($sendTo))
                            {{ $sendTo->address }}
                        @else
                            {{ $user->findUserByType($user->id_type_users)->address }}
                        @endif
                    </span>
                </div>
            </div>

            <div style="margin-top: 30px; margin-bottom: 30px" class="my-7.5 grid grid-cols-1 xsm:grid-cols-2 sm:grid-cols-3 border border-stroke dark:border-strokedark ">
                <div class="border-b border-r border-stroke px-5 py-4 last:border-r-0 dark:border-strokedark sm:border-b-0">
                    <h5 class="mb-1.5 text-title-sm font-bold text-black dark:text-white">
                        رقم الفاتورة :
                    </h5>
                    <span class="text-md font-medium"> {{ date('sHdmy')  }} </span>
                </div>

                <div class="border-b border-r border-stroke px-5 py-4 last:border-r-0 dark:border-strokedark sm:border-b-0 sm:border-r">
                    <h5 class="mb-1.5 text-title-sm font-bold text-black dark:text-white">
                        تاريخ الإصدار :
                    </h5>
                    <span class="text-md font-medium"> {{ date('Y M, d')  }} </span>
                </div>


                <div class=" border-r border-stroke px-5 py-4  dark:border-strokedark">
                    <h5 class="mb-1.5 text-title-sm font-bold text-black dark:text-white">
                        المبلغ المستحق :
                    </h5>
                    <span class="text-md font-medium">
                        @if($user->id_type_users == 1)
                            @if(isset($sendTo))
                                {{ $prices }}
                            @else
                                {{ $prices - ( $reports->count() * $reports[0]->delegate->piece_delivery_price ) }}
                            @endif

                        @elseif($user->id_type_users == 2)
                            {{ $prices  }}
                        @else
                            {{ $prices  }}
                        @endif
                        دينار
                    </span>
                </div>
            </div>

            <div class="border border-stroke dark:border-strokedark">
                <div class="max-w-full overflow-x-auto print:overflow-x-hidden">
                    <div class="min-w-[670px]">
                        <!-- table header start -->
                        <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                            @if($user->id_type_users != 2)
                                <div class="col-span-3">
                                    <h5 class="font-medium text-black dark:text-white">
                                        اسم المندوب
                                    </h5>
                                </div>
                            @endif
                            @if($user->id_type_users != 3)
                                <div class="col-span-3">
                                    <h5 class="font-medium text-black dark:text-white">
                                        اسم الزبون
                                    </h5>
                                </div>
                            @endif

                            <div class="{{ $user->id_type_users == 1 ? 'col-span-2' : 'col-span-3' }}">
                                <h5 class="font-medium text-black dark:text-white">
                                    الشحنة
                                </h5>
                            </div>

                            <div class="{{ $user->id_type_users == 1 ? 'col-span-2' : 'col-span-3' }}">
                                <h5 class="font-medium text-black dark:text-white">
                                    {{ $user->id_type_users == 3 ? 'سعر الشحنة' : 'سعر التوصيل' }}
                                </h5>
                            </div>

                            <div class="{{ $user->id_type_users == 1 ? 'col-span-2' : 'col-span-3' }}">
                                <h5 class="text-right font-medium text-black dark:text-white">
                                    التاريخ
                                </h5>
                            </div>
                        </div>
                        <!-- table header end -->

                        <!-- product item -->
                        @foreach($reports as $report)
                            <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                                @if($user->id_type_users != 2)
                                    <div class="col-span-3">
                                        <p class="font-medium">{{ $report->delegate->delivery_name }}</p>
                                    </div>
                                @endif
                                @if($user->id_type_users != 3)
                                    <div class="col-span-3">
                                        <p class="font-medium">{{ $report->shipment->customer->customer_name }}</p>
                                    </div>
                                @endif
                                <div class="{{ $user->id_type_users == 1 ? 'col-span-2' : 'col-span-3' }}">
                                    <p class="font-medium">{{ $report->shipment->ship_name }}</p>
                                </div>
                                <div class="{{ $user->id_type_users == 1 ? 'col-span-2' : 'col-span-3' }}">
                                    <p class="font-medium">
                                        @if($user->id_type_users == 1)
                                            {{ $report->shipment->getPrice() }}
                                        @elseif($user->id_type_users == 2)
                                            {{ $report->delegate->piece_delivery_price  }}
                                        @else
                                            {{ $prices  }}
                                        @endif
                                        دينار
                                    </p>
                                </div>
                                <div class="{{ $user->id_type_users == 1 ? 'col-span-2' : 'col-span-3' }}">
                                    <p class="font-medium">{{ $report->date_update }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- total price start -->
                <div class="flex justify-end p-6">
                    <div class="w-full max-w-65">
                        <div class="flex text-lg flex-col gap-4">
                            <p class="flex justify-between font-medium text-black dark:text-white">
                                <span> المجموع </span>
                                <span> {{ $prices  }} دينار </span>
                            </p>

                            @if($user->id_type_users == 1)
                                <p class="flex justify-between font-medium text-black dark:text-white">
                                    <span> سعر التوصيل </span>
                                    <span>
                                        @if(isset($sendTo))
                                            {{ $prices }} دينار
                                        @else
                                            {{ $reports->count() * $reports[0]->delegate->piece_delivery_price }} دينار
                                        @endif
                                        </span>
                                </p>
                            @endif

                        <p class="mt-4 flex justify-between border-t border-stroke pt-5 dark:border-strokedark">
                        <span class="font-medium text-black dark:text-white">
                          الصافي
                        </span>
                            <span class="font-bold text-meta-3">
                            @if($user->id_type_users == 1)
                                    @if(isset($sendTo))
                                        {{ $prices }}
                                    @else
                                        {{ $prices - ( $reports->count() * $reports[0]->delegate->piece_delivery_price ) }}
                                    @endif
                            @elseif($user->id_type_users == 2)
                                {{ $prices  }}
                            @else
                                {{ $prices  }}
                            @endif
                            دينار
                            </span>
                        </p>
                    </div>
                </div>
                <!-- total price end -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
            <script>
                document.getElementById('btn-print').addEventListener('click', function(e) {
                    var printContents = document.getElementById('print').innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                });
            </script>

@endsection
