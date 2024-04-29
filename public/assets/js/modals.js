document.addEventListener("DOMContentLoaded", function () {
    // استهدف كل الأزرار التي تحتوي على الـ data-target
    const buttons = document.querySelectorAll("[data-target]");
    let mainForm = null;
    let idTerget = null;
    let changes = false;
    // قم بتحديد كل زر وأضف حدث النقر إليه
    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const target = button.getAttribute("data-target"); // احصل على القيمة الموجودة في data-target
            if (target != "SaveChanging") {
                const modal = document.getElementById(target); // استهدف العنصر المستهدف بواسطة هذه القيمة
                idTerget = modal;
                // قم بإظهار النافذة المنبثقة
                openModal(modal);

                // تابع لفحص التغييرات
                checkChanges(modal);
            }
        });
    });

    // استهدف كل الأزرار الإغلاق (close)
    const closes = document.querySelectorAll(".btn-modal-close");

    // قم بتحديد كل زر وأضف حدث النقر إليه
    closes.forEach((close) => {
        close.addEventListener("click", () => {
            // استهدف العنصر الذي يحتوي على زر الإغلاق
            let modal = close.parentElement.parentElement.parentElement;
            if(!modal.classList.contains('modal')){
                modal = modal.parentElement;
            }
            // قم بفحص التغييرات بعد إغلاق النافذة
            if (changes) {
                mainForm = idTerget.querySelector("form");
                // إذا تم تغيير أحد الحقول، أظهر تنبيه
                const target = close.getAttribute("data-target"); // احصل على القيمة الموجودة في data-target
                const modalChild = document.getElementById(target); // استهدف العنصر المستهدف بواسطة هذه القيمة
                openModal(modalChild);
                modalChild
                    .querySelector(".save-change")
                    .addEventListener("click", () => {
                        mainForm.submit();
                        // onSubmitForm(mainForm);
                        changes = false;
                    });
                modalChild
                    .querySelector(".btn-close")
                    .addEventListener("click", () => {
                        closeModal(modalChild);
                    });
                modalChild
                    .querySelector(".closeBoth")
                    .addEventListener("click", () => {
                        clearForm(mainForm);
                        closeModal(modalChild);
                        closeModal(modal);
                        changes = false;
                    });
            } else {
                // قم إخفاء النافذة المنبثقة
                closeModal(modal);
            }
            //  modal.style.display = "none"; // قم بإخفاء النافذة المنبثقة
        });
    });

    // تابع لفحص التغييرات
    function checkChanges(modal) {
        // استهدف كل الحقول داخل النافذة المنبثقة
        const fields = modal.querySelectorAll("input, textarea");

        // قم بتحديد كل حقل وأضف حدث input إليه
        fields.forEach((field) => {
            field.addEventListener("input", () => {
                changes = true; // تم تغيير الحقل
            });
        });
    }

    function closeModal(modal) {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }

    function openModal(modal) {
        modal.classList.add("flex");
        modal.classList.remove("hidden");
    }
    function clearForm(form) {
        // استهداف وتفريغ حقول النموذج
        form.querySelectorAll("input, textarea, select").forEach((field) => {
            switch (field.type) {
                case "text":
                case "password":
                case "textarea":
                    field.value = "";
                    break;
                case "checkbox":
                case "radio":
                    field.checked = false;
                    break;
                case "select-one":
                case "select-multiple":
                    field.selectedIndex = -1;
                    break;
                default:
                    // إعادة تعيين القيمة الافتراضية إذا كان نوع الحقل غير معروف
                    field.value = "";
                    break;
            }
        });
    }

    const form = document.querySelector(".needs-validation");

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
