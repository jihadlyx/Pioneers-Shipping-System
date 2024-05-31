<div id="EditPrice{{ $branch->id }}" x-transition=""
    class="modal hidden fixed left-0 top-0 z-99999 h-screen w-full justify-center overflow-y-scroll bg-black/80 px-4 py-5">
    <div
        class="relative m-auto w-full max-w-180 sm:max-w-230 rounded-sm border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-meta-4 sm:p-8 xl:p-10">
        <div class=" flex items-center justify-between">
            <h2 class="flex-1 text-center text-title-md font-bold text-meta-5 dark:text-white">
                تعديل سعر التوصيل
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
        <form action="#22" class="needs-validation" novalidate>
            <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="hidden mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            من الفرع
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                            <select
                                name="from_branch"
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                :class="isOptionSelected && 'text-black dark:text-white'"
                                @change.once="isOptionSelected = true" required>
                                <option value="{{ $branch->from_branch }}" selected class="text-body">
                                    {{ $branch->fromBranch->title }}
                                </option>
                            </select>
                        </div>
                        <span class="absolute ltr:right-4 rtl:left-4 top-1/2 z-30 -translate-y-1/2">
                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.8">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                              fill=""></path>
                                    </g>
                                </svg>
                            </span>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء اختيار فرع
                        </div>
                    </div>
                    <div class="mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            إلى الفرع
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                            <select
                                name="to_branch"
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                :class="isOptionSelected && 'text-black dark:text-white'"
                                @change.once="isOptionSelected = true" required>
                                <option value="{{ $branch->to_branch }}" selected class="text-body">
                                    {{ $branch->toBranch->title }}
                                </option>
                            </select>
                            <span class="absolute ltr:right-4 rtl:left-4 top-1/2 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                          fill=""></path>
                                </g>
                            </svg>
                        </span>
                        </div>

                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء اختيار فرع
                        </div>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            سعر التوصيل للفرع
                        </label>
                        <input type="number" name="price" value="{{ $branch->price }}" placeholder="ادخل اسم السعر"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل السعر
                        </div>
                    </div>
                </div>

            </div>
            <button type="submit"
                    class="save-data modal-show flex transition-transform hover:scale-95 items-center gap-2 text-white hover:bg-opacity-80 rounded bg-primary px-4.5 py-2 font-bold border-b-4 border-blue-700 hover:border-blue-500">
                تعديل السعر
            </button>
        </form>
    </div>
</div>
