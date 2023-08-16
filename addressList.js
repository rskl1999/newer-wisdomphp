
const provinceList = [
    "Metro Manila", "Abra", "Agusan del Norte", "Agusan del Sur", "Aklan", "Albay", "Antique",
    "Apayao", "Aurora", "Basilan", "Bataan", "Batanes", "Batangas", "Biliran", "Benguet", "Bohol",
    "Bukidnon", "Bulacan", "Cagayan", "Camarines Norte", "Camarines Sur", "Camiguin", "Capiz",
    "Catanduanes", "Cavite", "Cebu", "Compostela", "Davao del Norte", "Davao del Sur",
    "Davao Oriental", "Eastern Samar", "Guimaras", "Ifugao", "Ilocos Norte", "Ilocos Sur", "Iloilo",
    "Isabela", "Kalinga", "Laguna", "Lanao del Norte", "Lanao del Sur", "La Union", "Leyte",
    "Maguindanao", "Marinduque", "Masbate", "Mindoro Occidental", "Mindoro Oriental",
    "Misamis Occidental", "Misamis Oriental", "Mountain Province", "Negros Occidental",
    "Negros Oriental", "North Cotabato", "Northern Samar", "Nueva Ecija", "Nueva Vizcaya",
    "Palawan", "Pampanga", "Pangasinan", "Quezon", "Quirino", "Rizal", "Romblon", "Samar", "Sarangani",
    "Siquijor", "Sorsogon", "South Cotabato", "Southern Leyte", "Sultan Kudarat", "Sulu",
    "Surigao del Norte", "Surigao del Sur", "Tarlac", "Tawi-Tawi", "Zambales", "Zamboanga del Norte",
    "Zamboanga del Sur", "Zamboanga Sibugay"
];
const selectElementProvince = document.getElementById("provinceSelect");

function populateProvince() {
    provinceList.forEach(province => {
        const optionElement = document.createElement("option");
        optionElement.textContent = province;
        optionElement.value = province;
        selectElementProvince.appendChild(optionElement);
    });
}

// Call the function to populate the select element
populateProvince();

const cityList = [
    "Manila", "Quezon City", "Caloocan", "Davao City", "Cebu City", "Zamboanga City", "Taguig",
    "Pasig", "Antipolo", "Valenzuela", "Las Piñas", "Makati", "Mandaluyong", "Marikina", "Muntinlupa",
    "Navotas", "Parañaque", "Pasay", "San Juan", "Tagaytay", "Tarlac City", "Lapu-Lapu City",
    "Iloilo City", "Baguio City", "Batangas City", "General Santos City", "Olongapo City",
    "Puerto Princesa City", "Cagayan de Oro City", "Bacolod City", "Butuan City", "Cotabato City",
    "Laoag City", "Naga City", "Tacloban City"
];
const selectElementCity = document.getElementById("citySelect");

function populateCity() {
    cityList.forEach(city => {
        const optionElement = document.createElement("option");
        optionElement.textContent = city;
        optionElement.value = city;
        selectElementCity.appendChild(optionElement);
    });
}

// Call the function to populate the select element
populateCity();