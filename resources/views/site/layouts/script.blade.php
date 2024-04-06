<script defer src="{{ asset('assets/js/bundle.js') }}"></script>
{{-- <script src="{{ asset('assets/js/index.js') }}"></script> --}}
<script src="{{ asset('assets/js/modals.js') }}"></script>

<script>
    let link = document.getElementById("clickLink")
    if (link) {
        link.onclick = function() {
            selected = (selected === 'Dashboard' ? '' : 'Dashboard');
            console.log("csd")
        };
    }
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.needs-validation');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();

        // استهداف جميع الحقول داخل النموذج
        const fields = form.querySelectorAll('input[required], select[required], textarea[required]');

        // تحقق مما إذا كانت هناك حقول فارغة
        let isFormValid = true;
        fields.forEach(function(field) {
            if (!field.value.trim()) {
                isFormValid = false;
                field.classList.add('is-invalid'); // إضافة كلاس 'is-invalid' إلى الحقل الفارغ
                field.nextElementSibling.style.display = 'block'; // عرض العنصر الذي يحمل الكلاس 'invalid-feedback'
            } else {
                field.classList.remove('is-invalid'); // إزالة كلاس 'is-invalid' إذا كان الحقل غير فارغ
                field.nextElementSibling.style.display = 'none'; // إخفاء العنصر الذي يحمل الكلاس 'invalid-feedback'
            }
        });

        // إذا كان النموذج صالحاً، قم بإرساله
        if (isFormValid) {
            form.classList.remove('was-validated');
            form.submit();
        } else {
            form.classList.add('was-validated');
        }
    });
});

</script>
