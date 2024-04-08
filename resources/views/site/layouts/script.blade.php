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
            input.addEventListener('keydown', function(event) {
                if (event.key === 'ArrowUp' || event.key === 'ArrowDown') {
                    event.preventDefault();
                }
            });
        });
    });
</script>
