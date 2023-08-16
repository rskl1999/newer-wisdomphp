
// Find logo
const logo = document.querySelector('.img-profile');

$(document).ready(function(){
    $.get("scripts/AdminProfile.php", function(data, status) {
            if(status == 'success' && data.length > 0) {
                logo.src = '../Admin-Logo/' + data;
            }
            else {
                logo.src = '../Admin-Logo/default.png';
            }
    });
});