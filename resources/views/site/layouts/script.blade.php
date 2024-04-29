<script defer src="{{ asset('assets/js/bundle.js') }}"></script>
{{-- <script src="{{ asset('assets/js/index.js') }}"></script> --}}
<script src="{{ asset('assets/js/modals.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let link = document.getElementById("clickLink")
        if (link) {
            link.onclick = function() {
                selected = (selected === 'Dashboard' ? '' : 'Dashboard');
                console.log("csd")
            };
        }
        var numberInputs = document.querySelectorAll('input[type="number"]');
        numberInputs.forEach(function(input) {
            input.addEventListener('input', function(event) {
                var value = event.target.value.trim();
                var maxLength = parseInt(event.target.getAttribute('maxlength'));
                var minLength = parseInt(event.target.getAttribute('minlength'));

                if (maxLength && value.length > maxLength) {
                    event.target.value = value.slice(0, maxLength); // قص القيمة لتكون بحد أقصى من عدد الخانات المسموح بها
                } else if (minLength && value.length < minLength) {
                    // يمكنك إضافة رسالة تنبيه هنا إذا كنت ترغب
                }
            });
        });


    });
</script>
