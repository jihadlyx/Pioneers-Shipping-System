<!DOCTYPE html>
<html lang="en" dir="rtl">
@include('site.layouts.head')

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
<!-- ===== Preloader Start ===== -->
@include('site.layouts.preloader')
<!-- ===== Preloader End ===== -->

<main>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">

        <!-- ====== Forms Section Start -->
        <div
            class=" rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
        >
            <div class="flex flex-wrap items-center">
                <div class="hidden w-full xl:block xl:w-1/2">
                    <div class="px-26 py-17.5 text-center">
                        <a class="mb-5.5 inline-block" href="index.html">
                            {{--                            <img class="" src="{{ asset('assets/images/logo/logo2.svg') }}" alt="Logo">--}}
                            {{--                            <img class="dark:hidden" src="{{ asset('assets/images/logo/logo-dark.svg') }}" alt="Logo">--}}
                        </a>

                        <p class="font-medium 2xl:px-20">

                        </p>

                        <span class="mt-15 inline-block">
                      <img src="{{ asset('assets/images/illustration/illustration-03.svg') }}" alt="illustration">
                    </span>
                    </div>
                </div>
                <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-r-2">
                    <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                        {{--                        <span class="mb-1.5 block font-medium">Start for free</span>--}}
                        <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                            انشاء حساب جديد
                        </h2>

                        @if(Session::has('message'))
                            <div class="alert-{{ Session::get('message')["type"] }} flex  rounded-lg p-4 mb-4 text-md " role="alert">
                                <svg class="w-5 h-5 inline ltr:mr-3 rtl:ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <div>
                                    <span class="font-medium">{{ Session::get('message')["title"] }} !</span> {{ Session::get('message')["text"] }}
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate >
                            @csrf
                            <div class="mb-4">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">الاسم</label>
                                <div class="relative">
                                    <input type="text" name="name" placeholder="ادخل اسمك" required maxlength="50" minlength="2"
                                           class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                    <span class="absolute ltr:right-4 rtl:left-4 top-1/2 transform -translate-y-1/2">
                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g opacity="0.5">
                                            <path d="M11.0008 9.52185C13.5445 9.52185 15.607 7.5281 15.607 5.0531C15.607 2.5781 13.5445 0.584351 11.0008 0.584351C8.45703 0.584351 6.39453 2.5781 6.39453 5.0531C6.39453 7.5281 8.45703 9.52185 11.0008 9.52185ZM11.0008 2.1656C12.6852 2.1656 14.0602 3.47185 14.0602 5.08748C14.0602 6.7031 12.6852 8.00935 11.0008 8.00935C9.31641 8.00935 7.94141 6.7031 7.94141 5.08748C7.94141 3.47185 9.31641 2.1656 11.0008 2.1656Z" fill=""></path>
                                            <path d="M13.2352 11.0687H8.76641C5.08828 11.0687 2.09766 14.0937 2.09766 17.7719V20.625C2.09766 21.0375 2.44141 21.4156 2.88828 21.4156C3.33516 21.4156 3.67891 21.0719 3.67891 20.625V17.7719C3.67891 14.9531 5.98203 12.6156 8.83516 12.6156H13.2695C16.0883 12.6156 18.4258 14.9187 18.4258 17.7719V20.625C18.4258 21.0375 18.7695 21.4156 19.2164 21.4156C19.6633 21.4156 20.007 21.0719 20.007 20.625V17.7719C19.9039 14.0937 16.9133 11.0687 13.2352 11.0687Z" fill=""></path>
                                          </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">رقم الهاتف</label>
                                <div class="relative">
                                    <input type="number" name="phone_number" inputmode="numeric" required maxlength="12" minlength="10" placeholder="ادخل رقم الهاتف" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">

                                    <span class="absolute ltr:right-4 rtl:left-4 top-1/2 transform -translate-y-1/2">
{{--                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                          <g opacity="0.5">--}}
{{--                                            <path d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z" fill=""></path>--}}
{{--                                          </g>--}}
{{--                                        </svg>--}}
                                     </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">البريد الإلكتروني</label>
                                <div class="relative">
                                    <input type="email" name="email" required maxlength="255" minlength="13" placeholder="ادخل بريدك الإلكتروني" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">

                                    <span class="absolute ltr:right-4 rtl:left-4 top-1/2 transform -translate-y-1/2">
                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g opacity="0.5">
                                            <path d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z" fill=""></path>
                                          </g>
                                        </svg>
                                     </span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">كلمة السر</label>
                                <div class="relative">
                                    <input type="password" name="password"
                                           required maxlength="255" minlength="6" placeholder="ادخل كلمة السر" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">

                                    <span class="absolute ltr:right-4 rtl:left-4 top-1/2 transform -translate-y-1/2">
                            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g opacity="0.5">
                                <path d="M16.1547 6.80626V5.91251C16.1547 3.16251 14.0922 0.825009 11.4797 0.618759C10.0359 0.481259 8.59219 0.996884 7.52656 1.95938C6.46094 2.92188 5.84219 4.29688 5.84219 5.70626V6.80626C3.84844 7.18438 2.33594 8.93751 2.33594 11.0688V17.2906C2.33594 19.5594 4.19219 21.3813 6.42656 21.3813H15.5016C17.7703 21.3813 19.6266 19.525 19.6266 17.2563V11C19.6609 8.93751 18.1484 7.21876 16.1547 6.80626ZM8.55781 3.09376C9.31406 2.40626 10.3109 2.06251 11.3422 2.16563C13.1641 2.33751 14.6078 3.98751 14.6078 5.91251V6.70313H7.38906V5.67188C7.38906 4.70938 7.80156 3.78126 8.55781 3.09376ZM18.1141 17.2906C18.1141 18.7 16.9453 19.8688 15.5359 19.8688H6.46094C5.05156 19.8688 3.91719 18.7344 3.91719 17.325V11.0688C3.91719 9.52189 5.15469 8.28438 6.70156 8.28438H15.2953C16.8422 8.28438 18.1141 9.52188 18.1141 11V17.2906Z" fill=""></path>
                                <path d="M10.9977 11.8594C10.5852 11.8594 10.207 12.2031 10.207 12.65V16.2594C10.207 16.6719 10.5508 17.05 10.9977 17.05C11.4102 17.05 11.7883 16.7063 11.7883 16.2594V12.6156C11.7883 12.2031 11.4102 11.8594 10.9977 11.8594Z" fill=""></path>
                              </g>
                            </svg>
                          </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="mb-3 block text-xl font-medium text-black dark:text-white">
                                    الفرع
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                                    <select name="id_branch"
                                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                            :class="isOptionSelected && 'text-black dark:text-white'"
                                            @change.once="isOptionSelected = true" required>
                                            <option value="" disabled selected class="text-body">
                                                اختر
                                            </option>
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id_branch }}" class="text-body"> {{ $branch->title }} </option>
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
                            </div>
                            <div class="mb-4">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">العنوان</label>
                                <div class="relative">
                                    <input type="text" name="address" required maxlength="30" minlength="5" placeholder="ادخل العنوان" class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">

                                    <span class="absolute ltr:right-4 rtl:left-4 top-1/2 transform -translate-y-1/2">
{{--                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                          <g opacity="0.5">--}}
{{--                                            <path d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z" fill=""></path>--}}
{{--                                          </g>--}}
{{--                                        </svg>--}}
                                     </span>
                                </div>
                            </div>
                            <div class="mb-5">
                                <input type="submit" value="تسجيل" class="save-data w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                            </div>
                        </form>
                        <div>
                            <span>
                                هل لديك حساب؟ <a class="mr-3 cursor-pointer text-primary" href="{{ route('login') }}">تسجيل الدخول</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Forms Section End -->
    </div>
</main>

@include('site.layouts.script')
<script>
    const forms = document.querySelectorAll(".needs-validation");

    forms.forEach(form => {
        form.addEventListener("submit", onSubmitForm);

        function onSubmitForm(event) {
            event.preventDefault();
            event.stopPropagation();

            // استهداف جميع الحقول داخل النموذج
            const fields = form.querySelectorAll(
                "input[required], select[required], textarea[required]"
            );

// تحقق مما إذا كانت هناك حقول فارغة
            let isFormValid = true;
            fields.forEach(function (field) {

                if (!field.value.trim()) {
                    isFormValid = false;
                    field.classList.add("is-invalid"); // إضافة كلاس 'is-invalid' إلى الحقل الفارغ
                    field.nextElementSibling.style.display = "block"; // عرض العنصر الذي يحمل الكلاس 'invalid-feedback'
                } else {
                    // إذا كان هناك قيمة في الحقل، قم بالتحقق من الحد الأقصى والأدنى لعدد الأحرف
                    if (
                        field.minLength && field.value.trim().length < field.minLength ||
                        field.maxLength && field.value.trim().length > field.maxLength
                    ) {
                        isFormValid = false;
                        field.classList.add("is-invalid"); // إضافة كلاس 'is-invalid' إلى الحقل
                        field.nextElementSibling.style.display = "block"; // عرض العنصر الذي يحمل الكلاس 'invalid-feedback'
                    } else {
                        field.classList.remove("is-invalid"); // إزالة كلاس 'is-invalid' إذا كان الحقل غير فارغ
                        field.nextElementSibling.style.display = "none"; // إخفاء العنصر الذي يحمل الكلاس 'invalid-feedback'
                    }
                }
            });


            // إذا كان النموذج صالحاً، قم بإرساله
            if (isFormValid) {
                form.classList.remove("was-validated");
                form.submit();
            } else {
                form.classList.add("was-validated");
            }
        }
    });
</script>
</body>

</html>

