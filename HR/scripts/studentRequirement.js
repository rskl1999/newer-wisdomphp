function studentRequirement() {
    // Find logo
    const logo = document.querySelector('#student-profile');
    // Find student name
    const name = document.querySelector('#student-name strong');
    // Find student email
    const email = document.querySelector('#student-email span');

    const getParams = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
    });

    $(document).ready(function(){
        $.get("scripts/StudentProfile.php?std="+getParams['std'], function(data, status) {
                if(status == 'success' && data.length > 0) {
                    data_out = data.split(',');
                    student_pic = data_out[0];
                    student_name = data_out[1];
                    student_email = data_out[2];
                    logo.src = '../Student-Logo/' + student_pic;
                    name.innerHTML = student_name;
                    email.innerHTML = student_email;
                }
                else {
                    logo.src = '../Student-Logo/default.png';
                    name.innerHTML = 'Student_name';
                    email.innerHTML = 'student_email';
                }
        });
    });
}

studentRequirement();