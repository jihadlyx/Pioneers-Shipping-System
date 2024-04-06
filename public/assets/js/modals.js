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
            openModal(modal)

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
        const modal = close.parentElement.parentElement.parentElement;
        // قم بفحص التغييرات بعد إغلاق النافذة
        if (changes) {
            mainForm = idTerget.querySelector("form");
            // إذا تم تغيير أحد الحقول، أظهر تنبيه
            const target = close.getAttribute("data-target"); // احصل على القيمة الموجودة في data-target
            const modalChild = document.getElementById(target); // استهدف العنصر المستهدف بواسطة هذه القيمة
            openModal(modalChild)
            modalChild
                .querySelector(".save-change")
                .addEventListener("click", () => {
                    mainForm.submit();
                    changes = false;
                });
            modalChild
                .querySelector(".btn-close")
                .addEventListener("click", () => {
                    closeModal(modalChild)
                });
            modalChild
                .querySelector(".closeBoth")
                .addEventListener("click", () => {
                    clearForm(mainForm)
                    closeModal(modalChild)
                    closeModal(modal)
                    changes = false;
                });
        } else {
            // قم إخفاء النافذة المنبثقة
            closeModal(modal)
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

function closeModal(modal){
    modal.classList.add("hidden");
    modal.classList.remove("flex");

}

function openModal(modal){
    modal.classList.add("flex");
    modal.classList.remove("hidden");
}
function clearForm(form) {
    // استهداف وتفريغ حقول النموذج
    form.querySelectorAll('input, textarea, select').forEach(field => {
        switch (field.type) {
            case 'text':
            case 'password':
            case 'textarea':
                field.value = '';
                break;
            case 'checkbox':
            case 'radio':
                field.checked = false;
                break;
            case 'select-one':
            case 'select-multiple':
                field.selectedIndex = -1;
                break;
            default:
                // إعادة تعيين القيمة الافتراضية إذا كان نوع الحقل غير معروف
                field.value = '';
                break;
        }
    });
}
