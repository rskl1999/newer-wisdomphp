document.addEventListener("DOMContentLoaded", function () {
    // Get the elements for Time In and Time Out
    const timeInInput = document.getElementById('time-in');
    const timeOutInput = document.getElementById('time-out');

    // Function to calculate the rendered hours
    function calculateRenderedHours() {
        // Get the values of Time In and Time Out
        const timeIn = timeInInput.value;
        const timeOut = timeOutInput.value;

        // Split the time strings and parse hours and minutes
        const [inHours, inMinutes] = timeIn.split(':').map(Number);
        const [outHours, outMinutes] = timeOut.split(':').map(Number);

        // Calculate the rendered hours and minutes
        let renderedHours = outHours - inHours;
        let renderedMinutes = outMinutes - inMinutes;

        // Adjust if renderedMinutes is negative (when Time Out is before Time In)
        if (renderedMinutes < 0) {
            renderedHours -= 1;
            renderedMinutes += 60;
        }

        // Update the HTML elements with the calculated values
        document.getElementById('rendered-hours').innerText = renderedHours;
        document.getElementById('rendered-minutes').innerText = renderedMinutes;
    }

    // Variable to store total rendered hours and minutes
    let totalRenderedHours = 0;
    let totalRenderedMinutes = 0;

    // Function to calculate rendered hours and minutes for the day
    function calculateRenderedTime(timeIn, timeOut) {
        const timeInHours = parseInt(timeIn.slice(0, 2));
        const timeInMinutes = parseInt(timeIn.slice(3, 5));
        const timeOutHours = parseInt(timeOut.slice(0, 2));
        const timeOutMinutes = parseInt(timeOut.slice(3, 5));

        let renderedHours = timeOutHours - timeInHours;
        let renderedMinutes = timeOutMinutes - timeInMinutes;

        if (renderedMinutes < 0) {
            renderedHours -= 1;
            renderedMinutes += 60;
        }

        return { hours: renderedHours, minutes: renderedMinutes };
    }

    // Function to update the Total Rendered section in the HTML
    function updateTotalRendered() {
        const totalRenderedHoursElement = document.getElementById("total-rendered-hours");
        const totalRenderedMinutesElement = document.getElementById("total-rendered-minutes");

        totalRenderedHoursElement.textContent = totalRenderedHours.toString().padStart(2, "0");
        totalRenderedMinutesElement.textContent = totalRenderedMinutes.toString().padStart(2, "0");
    }

    // Submit Hours button click event
    document.getElementById("new-task").addEventListener("click", function () {
        // Check if the button is disabled (already clicked today)
        if (this.disabled) {
            alert("You have already submitted hours today.");
            return;
        }

        calculateRenderedHours(); // Call the function to calculate rendered hours
        const timeInValue = timeInInput.value;
        const timeOutValue = timeOutInput.value;

        // Calculate rendered hours for the day
        const renderedTime = calculateRenderedTime(timeInValue, timeOutValue);

        // Update total rendered hours and minutes
        totalRenderedHours += renderedTime.hours;
        totalRenderedMinutes += renderedTime.minutes;

        // Update Total Rendered section in the HTML
        updateTotalRendered();

        // Retrieve the stored total required value from local storage
        const storedTotalRequired = localStorage.getItem("totalRequiredHours");

        // If there is a stored value, update the total remaining with the new value
        if (storedTotalRequired !== null) {
            updateTotalRemaining(parseInt(storedTotalRequired));
        }

        document.getElementById("new-task").style.backgroundColor = "#BDCBD3";
        document.getElementById("new-task").style.borderColor = "#BDCBD3";
        document.getElementById("new-task").innerHTML = 'Submitted Hours<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="margin-left: 5px;">\n' +
            '<!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->\n' +
            '<path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>\n' +
            '</svg>';

        // Disable the "Submit Hours" button after a successful click
        this.disabled = true;

        // Update the last submission date using cookies
        const currentDate = new Date().toDateString();
        setCookie("lastSubmissionDate", currentDate, 1); // The cookie will expire in 1 day
    });

    // Function to handle the input change event of the total required hours
    function handleTotalRequiredChange() {
        const totalRequiredInput = document.getElementById("total-required-hours");
        const totalRequired = parseInt(totalRequiredInput.value);

        // Store the total required value in local storage
        localStorage.setItem("totalRequiredHours", totalRequired);

        // Update the total remaining with the new value
        updateTotalRemaining(totalRequired);
    }

    function updateTotalRemaining(totalRequired) {
        const totalRenderedHours = parseInt(document.getElementById("total-rendered-hours").innerText);

        let totalRemainingHours = totalRequired - totalRenderedHours;

        if (totalRemainingHours < 0) {
            totalRemainingHours = 0;
        }

        document.getElementById("total-remaining-hours").innerText = totalRemainingHours.toString().padStart(2, "0");
    }

    // Function to initialize the total required hours input field
    function initTotalRequiredInput() {
        const totalRequiredInput = document.getElementById("total-required-hours");

        // Retrieve the stored total required value from local storage
        const storedTotalRequired = localStorage.getItem("totalRequiredHours");

        // If there is a stored value, update the total remaining with the new value
        if (storedTotalRequired !== null) {
            updateTotalRemaining(parseInt(storedTotalRequired));
        }

        // Update the total remaining with the default value
        updateTotalRemaining(parseInt(totalRequiredInput.value));

        // Add an event listener to handle changes in the total required input field
        totalRequiredInput.addEventListener("change", handleTotalRequiredChange);
        totalRequiredInput.addEventListener("input", handleTotalRequiredChange); // Also listen for input changes
    }

    // Call the initialization function when the page loads
    initTotalRequiredInput();

    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + encodeURIComponent(value) + ";expires=" + expires.toUTCString();
    }

    // Function to get a cookie
    function getCookie(name) {
        const cookieArr = document.cookie.split(";");

        for (let i = 0; i < cookieArr.length; i++) {
            const cookiePair = cookieArr[i].split("=");
            const cookieName = cookiePair[0].trim();

            if (cookieName === name) {
                return decodeURIComponent(cookiePair[1]);
            }
        }

        // Return null if the cookie is not found
        return null;
    }
});
