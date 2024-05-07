@extends('site.layouts.master')

@section('title')
    الصفحة الرئيسية
@endsection
@section('content')
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "id_status" => 1]) }}">
        <div
            class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <svg class="fill-primary dark:fill-white" width="22" height="16"
                     viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 15.1156C4.19376 15.1156 0.825012 8.61876 0.687512 8.34376C0.584387 8.13751 0.584387 7.86251 0.687512 7.65626C0.825012 7.38126 4.19376 0.918762 11 0.918762C17.8063 0.918762 21.175 7.38126 21.3125 7.65626C21.4156 7.86251 21.4156 8.13751 21.3125 8.34376C21.175 8.61876 17.8063 15.1156 11 15.1156ZM2.26876 8.00001C3.02501 9.27189 5.98126 13.5688 11 13.5688C16.0188 13.5688 18.975 9.27189 19.7313 8.00001C18.975 6.72814 16.0188 2.43126 11 2.43126C5.98126 2.43126 3.02501 6.72814 2.26876 8.00001Z"
                        fill="" />
                    <path
                        d="M11 10.9219C9.38438 10.9219 8.07812 9.61562 8.07812 8C8.07812 6.38438 9.38438 5.07812 11 5.07812C12.6156 5.07812 13.9219 6.38438 13.9219 8C13.9219 9.61562 12.6156 10.9219 11 10.9219ZM11 6.625C10.2437 6.625 9.625 7.24375 9.625 8C9.625 8.75625 10.2437 9.375 11 9.375C11.7563 9.375 12.375 8.75625 12.375 8C12.375 7.24375 11.7563 6.625 11 6.625Z"
                        fill="" />
                </svg>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4 class="text-title-md font-bold text-black dark:text-white">
                        {{ $ship1->count() }}
                    </h4>
                    <span class="text-sm font-medium">عدد الشحنات قيد الانتظار</span>
                </div>

                <span class="flex -translate-y-22.5 items-center gap-1 text-sm font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-meta-5 text-meta-5  bg-opacity-10 px-2 py-1 text-md font-medium">
                    قيد الانتظار
                </p>
            </span>
            </div>
        </div>
    </a>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "id_status" => 2]) }}">
        <div
        class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <svg class="fill-primary dark:fill-white" width="22" height="16"
                 viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11 15.1156C4.19376 15.1156 0.825012 8.61876 0.687512 8.34376C0.584387 8.13751 0.584387 7.86251 0.687512 7.65626C0.825012 7.38126 4.19376 0.918762 11 0.918762C17.8063 0.918762 21.175 7.38126 21.3125 7.65626C21.4156 7.86251 21.4156 8.13751 21.3125 8.34376C21.175 8.61876 17.8063 15.1156 11 15.1156ZM2.26876 8.00001C3.02501 9.27189 5.98126 13.5688 11 13.5688C16.0188 13.5688 18.975 9.27189 19.7313 8.00001C18.975 6.72814 16.0188 2.43126 11 2.43126C5.98126 2.43126 3.02501 6.72814 2.26876 8.00001Z"
                    fill="" />
                <path
                    d="M11 10.9219C9.38438 10.9219 8.07812 9.61562 8.07812 8C8.07812 6.38438 9.38438 5.07812 11 5.07812C12.6156 5.07812 13.9219 6.38438 13.9219 8C13.9219 9.61562 12.6156 10.9219 11 10.9219ZM11 6.625C10.2437 6.625 9.625 7.24375 9.625 8C9.625 8.75625 10.2437 9.375 11 9.375C11.7563 9.375 12.375 8.75625 12.375 8C12.375 7.24375 11.7563 6.625 11 6.625Z"
                    fill="" />
            </svg>
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    {{ $ship2->count() }}
                </h4>
                <span class="text-sm font-medium">عدد الشحنات قيد التوصيل</span>
            </div>

            <span class="flex -translate-y-22.5 items-center gap-1 text-sm font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-warning text-warning  bg-opacity-10 px-2 py-1 text-md font-medium">
                    قيد التوصيل
                </p>
            </span>
        </div>
    </div>
    </a>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "id_status" => 3]) }}">
        <div
        class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <svg class="fill-primary dark:fill-white" width="22" height="16"
                 viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11 15.1156C4.19376 15.1156 0.825012 8.61876 0.687512 8.34376C0.584387 8.13751 0.584387 7.86251 0.687512 7.65626C0.825012 7.38126 4.19376 0.918762 11 0.918762C17.8063 0.918762 21.175 7.38126 21.3125 7.65626C21.4156 7.86251 21.4156 8.13751 21.3125 8.34376C21.175 8.61876 17.8063 15.1156 11 15.1156ZM2.26876 8.00001C3.02501 9.27189 5.98126 13.5688 11 13.5688C16.0188 13.5688 18.975 9.27189 19.7313 8.00001C18.975 6.72814 16.0188 2.43126 11 2.43126C5.98126 2.43126 3.02501 6.72814 2.26876 8.00001Z"
                    fill="" />
                <path
                    d="M11 10.9219C9.38438 10.9219 8.07812 9.61562 8.07812 8C8.07812 6.38438 9.38438 5.07812 11 5.07812C12.6156 5.07812 13.9219 6.38438 13.9219 8C13.9219 9.61562 12.6156 10.9219 11 10.9219ZM11 6.625C10.2437 6.625 9.625 7.24375 9.625 8C9.625 8.75625 10.2437 9.375 11 9.375C11.7563 9.375 12.375 8.75625 12.375 8C12.375 7.24375 11.7563 6.625 11 6.625Z"
                    fill="" />
            </svg>
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    {{ $ship3->count() }}
                </h4>
                <span class="text-sm font-medium">عدد الشحنات التي تم تسليمها</span>
            </div>

            <span class="flex -translate-y-22.5 items-center gap-1 text-sm font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-success text-success bg-opacity-10 px-2 py-1 text-md font-medium">
                    تم التسليم
                </p>
            </span>
        </div>
    </div>
    </a>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <a href="{{ route('dashboard.show', ["page_id" => 9, "id_status" => 4]) }}">
        <div
        class="rounded-sm border transition-transform hover:-translate-y-1 border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <svg class="fill-primary dark:fill-white" width="22" height="16"
                 viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11 15.1156C4.19376 15.1156 0.825012 8.61876 0.687512 8.34376C0.584387 8.13751 0.584387 7.86251 0.687512 7.65626C0.825012 7.38126 4.19376 0.918762 11 0.918762C17.8063 0.918762 21.175 7.38126 21.3125 7.65626C21.4156 7.86251 21.4156 8.13751 21.3125 8.34376C21.175 8.61876 17.8063 15.1156 11 15.1156ZM2.26876 8.00001C3.02501 9.27189 5.98126 13.5688 11 13.5688C16.0188 13.5688 18.975 9.27189 19.7313 8.00001C18.975 6.72814 16.0188 2.43126 11 2.43126C5.98126 2.43126 3.02501 6.72814 2.26876 8.00001Z"
                    fill="" />
                <path
                    d="M11 10.9219C9.38438 10.9219 8.07812 9.61562 8.07812 8C8.07812 6.38438 9.38438 5.07812 11 5.07812C12.6156 5.07812 13.9219 6.38438 13.9219 8C13.9219 9.61562 12.6156 10.9219 11 10.9219ZM11 6.625C10.2437 6.625 9.625 7.24375 9.625 8C9.625 8.75625 10.2437 9.375 11 9.375C11.7563 9.375 12.375 8.75625 12.375 8C12.375 7.24375 11.7563 6.625 11 6.625Z"
                    fill="" />
            </svg>
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    {{ $ship4->count() }}
                </h4>
                <span class="text-sm font-medium">عدد الشحنات التي تعذر تسليمها</span>
            </div>

            <span class="flex -translate-y-22.5 items-center gap-1 text-sm font-medium text-meta-3">
                <p class="inline-flex rounded-full bg-danger text-danger  bg-opacity-10 px-2 py-1 text-md font-medium">
                    تعذر التسليم
                </p>
            </span>
        </div>
    </div>
    </a>
    <!-- Card Item End -->
</div>
@endsection
