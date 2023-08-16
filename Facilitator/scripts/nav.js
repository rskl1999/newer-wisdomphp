
// Find logo
const logo = document.querySelector('.img-profile');

$(document).ready(function(){
    $.get("scripts/FacilitatorProfile.php", function(data, status) {
            if(status == 'success' && data.length > 0) {
                logo.src = '../Facilitator-Logo/' + data;
            }
            else {
                logo.src = '../Facilitator-Logo/default.png';
            }
    });
});