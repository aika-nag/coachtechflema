let select = document.querySelector('[name="payment"]');
let hiddenSelect = document.getElementById('hidden_select');



select.addEventListener('change', function () {
    let method_info = document.getElementById("method_info");
    method_info.textContent = select.options[select.selectedIndex].textContent;

    hiddenSelect.value = select.options[select.selectedIndex].value;
    
    }
);





