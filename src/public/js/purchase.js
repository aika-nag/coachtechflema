let select = document.querySelector('[name="payment"]');

let zipcode = document.getElementById("zipcode");
let address = document.getElementById("address");
let building = document.getElementById("building");

let hiddenSelect = document.getElementById("hidden_select");
let hiddenZipcode = document.getElementById("hidden_zipcode");
let hiddenAddress = document.getElementById("hidden_address");
let hiddenBuilding = document.getElementById("hidden_building");

hiddenZipcode.value = zipcode.value;
hiddenAddress.value = address.value;
hiddenBuilding.value = building.value;

select.addEventListener('change', function () {
    let method_info = document.getElementById("method_info");
    method_info.textContent = select.options[select.selectedIndex].textContent;

    hiddenSelect.value = select.options[select.selectedIndex].value;
});





