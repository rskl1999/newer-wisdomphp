function setAccountProfile() {
    // Find logo
    const logo = document.querySelector('.img-profile');

    $(document).ready(function(){
        $.get("scripts/HRProfile.php", function(data, status) {
                if(status == 'success' && data.length > 0) {
                    logo.src = '../HR-Logo/' + data;
                }
                else {
                    logo.src = '../HR-Logo/default.png';
                }
        });
    });
}