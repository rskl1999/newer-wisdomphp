
// Find logo
const logo = document.querySelector('.img-profile');

$(document).ready(function(){
    $.get("scripts/StudentProfile.php", function(data, status) {
            if(status == 'success' && data.length > 0) {
                logo.src = '../Student-Logo/' + data;
            }
            else {
                logo.src = '../Student-Logo/default.png';
            }
    });
});