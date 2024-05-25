<div id="EditEmp{{ $employee->id_emp }}" x-transition=""
    class="modal hidden fixed left-0 top-0 z-99999 h-screen w-full justify-center overflow-y-scroll bg-black/80 px-4 py-5">
    <div
        class="relative m-auto w-full max-w-180 sm:max-w-230 rounded-sm border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-meta-4 sm:p-8 xl:p-10">
        <div class=" flex items-center justify-between">

            <h2 class="flex-1 text-center text-title-md font-bold text-meta-3 dark:text-white">
                الموظفين
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
        <form action="{{ route('employees.update', ['page_id' => $id_page, 'id_emp' => $employee->id_emp]) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PATCH')
            <div class="p-6.5">
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            رقم الموظف
                        </label>
                        <input type="number" name="id_emp" value="{{ $employee->id_emp }}" placeholder="ادخل رقم الموظف"
                               class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                               required maxlength="10" minlength="1"/>
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل رقم الموظف
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            اسم الموظف
                        </label>
                        <input type="text" name="name" placeholder="ادخل اسم الموظف" value="{{ $employee->name_emp }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="50" minlength="3" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل الاسم
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            رقم الهاتف
                        </label>
                        <input type="number" name="phone_number" inputmode="numeric" placeholder="ادخل رقم هاتف الموظف" value="0{{ $employee->phone_number }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="12" minlength="10" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل رقم الهاتف
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            رقم الهاتف احتياطي
                        </label>
                        <input type="number" name="phone_number2" step="1" placeholder="ادخل رقم هاتف الموظف" value="{{ $employee->phone_number2 == null ? '' : "0$employee->phone_number2"}}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل رقم الهاتف
                        </div>
                    </div>
                </div>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            البريد الالكتروني
                        </label>
                        <input type="email" name="email" placeholder="ادخل البريد الالكتروني" value="{{ $employee->user($employee->id_emp)->email }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="255" minlength="13" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل البريد
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2 hidden" id="reset-{{ $employee->id_emp }}">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            كلمة السر
                        </label>
                        <input type="password" name="password" placeholder="ادخل كلمة السر الجديدة"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="255" minlength="6" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل كلمة السر
                        </div>
                    </div>
                    <div class="mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            العنوان
                        </label>
                        <input type="text" name="address" placeholder="ادخل العنوان" value="{{ $employee->address }}"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            required maxlength="30" minlength="5" />
                        <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                            الرجاء ادخل حقل العنوان
                        </div>
                    </div>
                    <div class="mb-4.5 w-full xl:w-1/2">
                        <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                            الصلاحية
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                            <select name="id_role"
                                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                    :class="isOptionSelected && 'text-black dark:text-white'"
                                    @change.once="isOptionSelected = true" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id_role }}" @if($role->id_role == $employee->id_role) selected @endif class="text-body"> {{ $role->title }} </option>
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
                            الرجاء اختيار صلاحية للموظف
                        </div>
                    </div>
                </div>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="mb-4.5 w-full xl:w-1/3">
                    <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                        اختيار صورة
                    </label>
                    <input type="file" accept="image/gif, image/jpeg, image/png" aria-label="file example" name="photo"  required class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary">
                    <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                        الرجاء اختيار صورة للموظف
                    </div>
                </div>
                </div>

            </div>

            <div class="flex items-center justify-between">
                <div class="mb-4.5 flex items-center gap-6 ">
                    <button type="submit"
                            class="save-data flex w-fit items-center justify-center gap-2 rounded bg-meta-3 px-4.5 py-2.5 text-white font-bold border-b-4 border-green-700 hover:border-green-500 transition-transform hover:scale-95">
                        تعديل الموظف
                    </button>
                    <div x-data="{ checkboxToggle: false }">
                        <label for="checkboxLabel{{ $employee->id_emp }}" class="flex gap-2 cursor-pointer select-none items-center text-sm font-medium" @click="checkboxToggle = !checkboxToggle">
                            <div class="relative ">
                                <input type="checkbox" data-set="reset-{{ $employee->id_emp }}" id="checkboxLabel{{ $employee->id_emp }}"
                                       @change="checkboxToggle = !checkboxToggle" class="check-box sr-only" x-model="checkboxToggle" />
                                <div :class="checkboxToggle && 'border-primary bg-gray dark:bg-transparent'"
                                     class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                    <span :class="checkboxToggle && 'bg-primary'"
                                      class="h-2.5 w-2.5 rounded-sm"></span>
                                </div>
                            </div>
                            تغيير كلمة المرور
                        </label>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-lg">
                    <span class="text-meta-1 ">*</span> حقول الزامية
                </div>
            </div>
        </form>
    </div>
</div>
