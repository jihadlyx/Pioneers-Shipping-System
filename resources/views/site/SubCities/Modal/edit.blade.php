<div id="EditCity{{ $city->id_city }}" x-transition=""
    class="modal hidden fixed left-0 top-0 z-99999 h-screen w-full justify-center overflow-y-scroll bg-black/80 px-4 py-5">
    <div
        class="relative m-auto w-full max-w-180 sm:max-w-230 rounded-sm border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-meta-4 sm:p-8 xl:p-10">
        <div class=" flex items-center justify-between">
            <h2 class="flex-1 text-center text-title-md font-bold text-meta-3 dark:text-white">
                المدن أو المناطق
            </h2>
            <button data-target="SaveChanging"
                class="btn-modal-close absolute ltr:right-1 rtl:left-1 top-1 ltr:sm:right-5 rtl:sm:left-5 sm:top-5">
                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.8913 9.99599L19.5043 2.38635C20.032 1.85888 20.032 1.02306 19.5043 0.495589C18.9768 -0.0317329 18.141 -0.0317329 17.6135 0.495589L10.0001 8.10559L2.38673 0.495589C1.85917 -0.0317329 1.02343 -0.0317329 0.495873 0.495589C-0.0318274 1.02306 -0.0318274 1.85888 0.495873 2.38635L8.10887 9.99599L0.495873 17.6056C-0.0318274 18.1331 -0.0318274 18.9689 0.495873 19.4964C0.717307 19.7177 1.05898 19.9001 1.4413 19.9001C1.75372 19.9001 2.13282 19.7971 2.40606 19.4771L10.0001 11.8864L17.6135 19.4964C17.8349 19.7177 18.1766 19.9001 18.5589 19.9001C18.8724 19.9001 19.2531 19.7964 19.5265 19.4737C20.0319 18.9452 20.0245 18.1256 19.5043 17.6056L11.8913 9.99599Z"
                        fill=""></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('subCities.update', ['page_id' => $id_page, 'id_city' => $city->id_city]) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PATCH')
            <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            رقم المدينة أو المنطقة
                        </label>
                        <input type="number" name="id_city" value="{{ $city->id_city }}" placeholder="ادخل رقم المدينة أو المنطقة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل رقم المدينة أو المنطقة
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            اسم المدينة أو المنطقة
                        </label>
                        <input type="text" name="title" value="{{ $city->title }}" placeholder="ادخل اسم المدينة أو المنطقة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل اسم المدينة أو المنطقة
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            سعر التوصيل
                        </label>
                        <input type="number" name="price" value="{{ $city->price }}" placeholder="ادخل سعر التوصيل"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="4" minlength="1"/>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل سعر التوصيل
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex items-center justify-between">
                <button
                    class="save-data flex w-fit items-center justify-center gap-2 rounded bg-meta-3 px-4.5 py-2.5 text-white font-bold border-b-4 border-green-700 hover:border-green-500 transition-transform hover:scale-95">
                    تعديل المدينة أو المنطقة
                </button>
                <div class="flex items-center gap-2">
                    <span class="text-meta-1 text-xl">*</span> الحقول الإلزامية
                </div>
            </div>
        </form>
    </div>
</div>
