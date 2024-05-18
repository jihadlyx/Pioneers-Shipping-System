<div id="AddShipment" x-transition=""
    class="modal hidden fixed left-0 top-0 z-99999 h-screen w-full justify-center overflow-y-scroll bg-black/80 px-4 py-5">
    <div
        class="relative m-auto w-full max-w-180 sm:max-w-230 rounded-sm border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-meta-4 sm:p-8 xl:p-10">
        <div class=" flex items-center justify-between">
            <h2 class="flex-1 text-3d text-center text-title-md font-bold text-meta-5 dark:text-white">
                شحنة جديدة
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
        <form action="{{ route('shipments.store', ['page_id' => 5]) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            رقم الشحنة
                        </label>
                        <input type="number" name="id_ship" value="{{ $maxShipmentId }}" placeholder="ادخل رقم الشحنة"
                               class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                               required maxlength="10" minlength="1" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل رقم الشحنة
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            اسم الشحنة
                        </label>
                        <input type="text" name="name_ship" placeholder="ادخل اسم الشحنة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="50" minlength="3"/>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل الاسم
                        </div>
                    </div>
                    <div class="mb-4.5 {{ Auth()->user()->id_type_users == 3 ? 'hidden' : '' }} w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            الزبون
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                            <select name="id_customer"
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                :class="isOptionSelected && 'text-black dark:text-white'"
                                @change.once="isOptionSelected = true" required>
                                <option value="" disabled selected class="text-body">
                                    اختر
                                </option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id_customer }}" @if(Auth()->user()->id_type_users == 3) selected @endif class="text-body"> {{ $customer->name_customer }} </option>
                                @endforeach
                            </select>
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
                        </div>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء اختيار زبون للشحنة
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            سعر الشحنة
                        </label>
                        <input type="number" name="ship_value" inputmode="numeric" placeholder="ادخل سعر الشحنة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="999" minlength="1"/>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخال سعر الشحنة
                        </div>
                    </div>
                </div>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            اسم المستلم
                        </label>
                        <input type="text" name="recipient_name" placeholder="ادخل العنوان"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="50" minlength="3"/>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل اسم المستلم
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            رقم الهاتف
                        </label>
                        <input type="number" name="phone_number" inputmode="numeric" placeholder="ادخل رقم هاتف الشحنة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="12" minlength="10"/>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل رقم الهاتف
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            رقم الهاتف احتياطي
                        </label>
                        <input type="number" name="phone_number2" step="1" placeholder="ادخل رقم هاتف الشحنة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل رقم الهاتف
                        </div>
                    </div>
                </div>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            مكان التوصيل
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                            <select name="id_city"
                                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                    :class="isOptionSelected && 'text-black dark:text-white'"
                                    @change.once="isOptionSelected = true" required>
                                <option value="" disabled selected class="text-body">
                                    اختر
                                </option>
                                @foreach($sub_cites as $city)
                                    <option value="{{ $city->id_city }}" class="text-body">
                                        {{ $city->branch->title .' - ' . $city->title . '  ' . $city->getPrice() }}
                                    </option>
                                @endforeach
                            </select>
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
                        </div>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء اختيار مكان التوصيل
                        </div>
                    </div>
                    <div class="mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            العنوان التفصيلي
                        </label>
                        <input type="text" name="address" placeholder="ادخل العنوان"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="30" minlength="5"/>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل العنوان
                        </div>
                    </div>
                    <div class="mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            ملاحظة
                        </label>
                        <input type="text" name="notes" placeholder="ادخل ملاحظة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                               maxlength="50" minlength="5" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخال ملاحظة
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit"
                class="save-data flex w-fit items-center justify-center gap-2 rounded bg-primary px-4.5 py-2.5 font-medium text-white">
                إضافة شحنة
            </button>
        </form>
    </div>
</div>
