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
        setTimeout(function(){
            let alert = document.querySelector("div[role='alert']")
                if(alert){
                    alert.style.visibility = 'hidden';
                }
        }, 5000);

    });
    function printInvoice(){
        window.print();
    }

    function searchInGoogleMaps(e) {
        let button = e.target.closest('button');
        let addressValue = button.getAttribute('data-address');
        if (addressValue &&  addressValue.trim() !== "") {
            let encodedAddress = encodeURIComponent(addressValue);
            let googleMapsUrl = `https://www.google.com/maps/search/?api=1&query=${encodedAddress}`;

            window.open(googleMapsUrl, '_blank');
        } else {
            alert("يرجى إدخال العنوان أولاً");
        }
    }
</script>

<script>
    let buttons = document.querySelectorAll('.transferButton')
        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Get the original form
                // var originalForm = document.getElementById('originalForm');
                // Get the target form
                var targetForm = document.querySelector('.TrashedForm');
                // Update the target form's action with the original form's action
                // alert(targetForm)
                targetForm.action = btn.getAttribute('data-action');

                // Optionally, copy other necessary data from the original form to the target form here

                // Submit the target form
                targetForm.submit();
            });
        })

</script>
