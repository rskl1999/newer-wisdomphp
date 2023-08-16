
// Find logo
const logo = document.querySelector('#school-logo');

$(document).ready(function(){
    $.get("scripts/schoolLogo.php", function(data, status) {
            if(status == 'success' && data.length > 0) {
                logo.src = '../School-Logo/' + data;
            }
            else {
                logo.src = '../School-Logo/default.png';
            }
    });
});