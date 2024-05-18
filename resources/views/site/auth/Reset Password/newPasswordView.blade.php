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
                            إعادة تعيين كلمة المرور
                        </h2>

                        <form action="{{ route('password.resetPassword') }}" method="POST" >
                            @csrf
                            @method("GET")
                            <input type="text" name="token" value="{{ $passwordReset->token }}" class="hidden">
                            <div class="mb-4">
                                <label class="mb-2.5 block font-medium text-black dark:text-white"> كلمة المرور الجديدة</label>
                                <div class="relative">
                                    <input type="password" id="enter-password" name="password" required maxlength="255" minlength="6" placeholder="ادخل كلمة المرور الجديدة"
                                           class="new-password w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">

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

                            <div class="mb-6">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">تأكيد كلمة السر</label>
                                <div class="relative">
                                    <input type="password" id="password-confirm" name="confirm" required maxlength="255" minlength="6" placeholder="ادخل تأكيد كلمة السر"
                                           class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none  focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">

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

                            <div class="mb-5">
                                <input type="submit" id="submit" value="إعادة تعيين كلمة السر"
                                       class="w-full  cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                            </div>

                        </form>
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

    var password = document.getElementById("enter-password");
    var confirmPassword = document.getElementById("password-confirm");

    confirmPassword.addEventListener('input', () => {
        confirmPassword.style.boxShadow = 'none'
        password.classList.remove("focus:border-primary");
        confirmPassword.classList.remove("focus:border-meta-3")
        confirmPassword.classList.remove("focus:border-meta-1");
        if (password.value !== confirmPassword.value) {
            confirmPassword.classList.add("is-invalid");
            confirmPassword.classList.add("focus:border-meta-1");
            document.getElementById('submit').style.visibility = 'hidden';
        } else {
            confirmPassword.classList.add("focus:border-meta-3");
            confirmPassword.classList.remove("is-invalid");
            document.getElementById('submit').style.visibility = 'visible';
        }
    })
</script>
</body>

</html>


