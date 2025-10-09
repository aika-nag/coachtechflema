let select = document.querySelector('[name="payment_select"]');

select.addEventListener('change', function () {
    let method_info = document.getElementById("method_info");
    method_info.textContent = select.options[select.selectedIndex].textContent;
});
