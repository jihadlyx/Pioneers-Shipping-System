@extends('site.layouts.master')

@section('title')
    الصفحة الرئيسية
@endsection
@section('content')
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-2 2xl:gap-7.5">
    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "status_id" => 1]) }}" class="{{ Auth()->user()->id_type_users == 2 ? 'hidden' : '' }}">
        <div
            class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div
                class="flex h-16.5 w-16.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <img src="{{ asset('assets/images/timing.png') }}"  alt="">
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4 class="text-title-lg font-bold text-black dark:text-white">
                        {{ $ship1->count() }}
                    </h4>
                    <span class="text-3xl dark:text-white font-medium">عدد الشحنات قيد الانتظار</span>
                </div>

                <span class="flex -translate-y-22.5 items-center gap-1 text-lg font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-meta-5 text-meta-5   bg-opacity-10 px-2 py-1 text-2xl font-medium">
                    قيد الانتظار
                </p>
            </span>
            </div>
        </div>
    </a>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "status_id" => 2]) }}">
        <div
        class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-16.5 w-16.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <img src="{{ asset('assets/images/fast-delivery.png') }}">
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-lg font-bold text-black dark:text-white">
                    {{ $ship2->count() }}
                </h4>
                <span class="text-3xl font-medium dark:text-white">عدد الشحنات قيد التوصيل</span>
            </div>

            <span class="flex -translate-y-22.5 items-center gap-1 text-lg font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-warning text-warning  bg-opacity-10 px-2 py-1 text-2xl font-medium">
                    قيد التوصيل
                </p>
            </span>
        </div>
    </div>
    </a>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "status_id" => 3]) }}">
        <div
        class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-16.5 w-16.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <img src="{{ asset('assets/images/delivery (3).png') }}">
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-lg font-bold text-black dark:text-white">
                    {{ $ship3->count() }}
                </h4>
                <span class="text-3xl font-medium dark:text-white">عدد الشحنات التي تم تسليمها</span>
            </div>

            <span class="flex -translate-y-22.5 items-center gap-1 text-lg font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-success text-success bg-opacity-10 px-2 py-1 text-2xl font-medium">
                    تم التسليم
                </p>
            </span>
        </div>
    </div>
    </a>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "status_id" => 4]) }}">
        <div
        class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-16.5 w-16.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <img src="{{ asset('assets/images/throw.png') }}" alt="">
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-lg font-bold text-black dark:text-white">
                    {{ $ship4->count() }}
                </h4>
                <span class="text-3xl font-medium dark:text-white">عدد الشحنات التي تعذر تسليمها</span>
            </div>

            <span class="flex -translate-y-22.5 items-center gap-1 text-lg font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-danger text-danger  bg-opacity-10 px-2 py-1 text-2xl font-medium">
                    تعذر التسليم
                </p>
            </span>
        </div>
    </div>
    </a>
    <!-- Card Item End -->
</div>


@endsection



