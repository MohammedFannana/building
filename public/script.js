// script.js
document.addEventListener('DOMContentLoaded', function() {
    const customerRadio = document.getElementById('customerRadio');
    const providerRadio = document.getElementById('providerRadio');
    const providerInputs = document.getElementById('providerInputs');

    customerRadio.addEventListener('change', function() {
        if (customerRadio.checked) {
            providerInputs.classList.add('hidden');
        }
    });

    providerRadio.addEventListener('change', function() {
        if (providerRadio.checked) {
            providerInputs.classList.remove('hidden');
        }
    });
});


