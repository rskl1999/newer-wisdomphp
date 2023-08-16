    const daysTag = document.querySelector(".days"),
    currentDate = document.querySelector(".current-date"),
    prevNextIcon = document.querySelectorAll(".icons span");

    // getting new date, current year and month
    let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

    // storing full name of all months in array
    const months = ["January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"];

    const renderCalendar = () => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
        let liTag = "";

        for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
            liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        }

        for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
            // adding active class to li if the current day, month, and year matched
            let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                        && currYear === new Date().getFullYear() ? "active" : "";
            liTag += `<li class="${isToday}">${i}</li>`;
        }

        for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
            liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
        }
        currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
        daysTag.innerHTML = liTag;

    }
    renderCalendar();

    prevNextIcon.forEach(icon => { // getting prev and next icons
        icon.addEventListener("click", () => { // adding click event on both icons
            // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
            currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

            if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
                // creating a new date of current year & month and pass it as date value
                date = new Date(currYear, currMonth, new Date().getDate());
                currYear = date.getFullYear(); // updating current year with new date year
                currMonth = date.getMonth(); // updating current month with new date month
            } else {
                date = new Date(); // pass the current date as date value
            }
            renderCalendar(); // calling renderCalendar function
        });
    });

    window.addEventListener('load', () => {
        let todos = JSON.parse(localStorage.getItem('todos')) || [];
        const newTodoForm = document.querySelector('#new-todo-form');

        newTodoForm.addEventListener('submit', e => {
            e.preventDefault();

            const newTodoContent = e.target.elements.content.value.trim(); // Trim leading and trailing spaces

            if (newTodoContent === "") {
                alert("Please enter a task.");
                return; // Stop execution if the content is blank
            }

            const newTodo = {
                content: e.target.elements.content.value,
                done: false,
                createdAt: new Date().getTime()
            }

            if (!Array.isArray(todos)) {
                todos = []; // Reset todos to an empty array if it's not an array
            }

            todos.push(newTodo);

            localStorage.setItem('todos', JSON.stringify(todos));

            // Reset the form
            e.target.reset();

            DisplayTodos(todos);
        });

        DisplayTodos(todos);
    })

    function DisplayTodos(todos, index) {
        const todoList = document.querySelector('#todo-list');
        const completedTasksList = document.querySelector('#completed-tasks'); // Get the completed tasks list
        todoList.innerHTML = "";
        completedTasksList.innerHTML = ""; // Clear the completed tasks list

        if (!Array.isArray(todos)) {
            todos = []; // Reset todos to an empty array if it's not an array
        }

        todos.forEach((todo, index) => {
            const todoItem = document.createElement('div');
            todoItem.classList.add('todo-item');

            const label = document.createElement('label');
            const checkbox = document.createElement('input');
            const span = document.createElement('span');
            const content = document.createElement('div');
            const actions = document.createElement('div');
            const edit = document.createElement('button');
            const deleteButton = document.createElement('button');

            checkbox.type = 'checkbox';
            checkbox.checked = todo.done;
            content.classList.add('todo-content');
            actions.classList.add('actions');
            edit.classList.add('edit');
            deleteButton.classList.add('delete');

            const inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.value = todo.content;
            inputField.readOnly = true;
            inputField.style.display = 'none'; // Hide the input field initially

            content.textContent = todo.content;

            // Append the input field and content to the todoItem
            todoItem.appendChild(inputField);
            todoItem.appendChild(content);

            edit.innerHTML = '<i class="far fa-edit edit" style="color: #0017eb; font-size: 17px;"></i>';
            edit.className = "btn btn-primary float-end edit";
            edit.type = "button";
            edit.style.padding = "10px";
            edit.style.background = "rgba(255, 255, 255, 0)";
            edit.style.borderStyle = "none";
            edit.style.height = "22px";

            // Add a class for styling the delete button
            deleteButton.innerHTML = '<i class="far fa-trash-alt" style="color: rgb(221, 21, 21); font-size: 17px;"></i>';
            deleteButton.classList.add('delete-button');
            deleteButton.className = "btn btn-primary float-end delete";
            deleteButton.type = "button";
            deleteButton.style.padding = "10px";
            deleteButton.style.background = "rgba(255, 255, 255, 0)";
            deleteButton.style.borderStyle = "none";
            deleteButton.style.height = "22px";

            label.appendChild(checkbox);
            label.appendChild(span);
            actions.appendChild(edit);
            actions.appendChild(deleteButton);
            todoItem.appendChild(label);
            todoItem.appendChild(content);
            todoItem.appendChild(actions);

            // Append the todoItem to the appropriate list based on whether it's done or not
            if (todo.done) {
                content.style.textDecoration = 'line-through';
                content.style.color = '#888';
                label.classList.add("checked");
                completedTasksList.appendChild(todoItem); // Append completed tasks to the completed tasks list
            } else {
                todoList.appendChild(todoItem); // Append pending tasks to the todo list
            }
        
            checkbox.addEventListener('change', (e) => {
                todo.done = e.target.checked;
                localStorage.setItem('todos', JSON.stringify(todos));
        
                if (todo.done) {
                content.style.textDecoration = 'line-through';
                content.style.color = '#888';
                label.classList.add("checked");
                moveTaskToCompleted(todoItem); // Move the task to completed tasks list
                } else {
                content.style.textDecoration = 'none';
                content.style.color = 'inherit';
                label.classList.remove("checked");
                moveTaskToIncomplete(todoItem); // Move the task back to the pending tasks list
                }
            });
        
            edit.addEventListener('click', () => {
                if (!todo.done) { // Add this condition to check if the task is not completed
                    // Toggle the visibility of the input field and content when the edit button is clicked
                    inputField.style.display = inputField.style.display === 'none' ? 'block' : 'none';
                    content.style.display = content.style.display === 'none' ? 'block' : 'none';
            
                    // Focus on the input field when it becomes visible
                    if (inputField.style.display !== 'none') {
                        inputField.focus();
                        inputField.removeAttribute('readOnly');
                    }
                }
            });
            
        
            inputField.addEventListener('blur', (e) => {
                const updatedContent = e.target.value;
                todo.content = updatedContent;
                localStorage.setItem('todos', JSON.stringify(todos));
                DisplayTodos(todos);
            });
        
            deleteButton.addEventListener('click', () => {
                todos.splice(index, 1);
                localStorage.setItem('todos', JSON.stringify(todos));
                DisplayTodos(todos);
            });
            });
        }

    function moveTaskToCompleted(todoItem) {
        const completedTasksList = document.querySelector('#completed-tasks');
        completedTasksList.appendChild(todoItem);
    }

    function moveTaskToIncomplete(todoItem) {
        const todoList = document.querySelector('#todo-list');
        todoList.appendChild(todoItem);
    }

    function changeHoursRendered() {
        // get time in value
        const timein = document.querySelector("#input-timein");
        timeinHourMin = timein.value;
        // split into hours & mins
        const timeinHoursarr = timeinHourMin.split(":");
        timeinHour = parseInt(timeinHoursarr[0]);
        timeinMin = parseInt(timeinHoursarr[1]);
        // get time out value
        const timeout = document.querySelector("#input-timeout");
        timeoutHourMin = timeout.value;
        // split into hours & mins
        const timeoutHoursarr = timeoutHourMin.split(":");
        timeoutHour = parseInt(timeoutHoursarr[0]);
        timeoutMin = parseInt(timeoutHoursarr[1]);

        // convert to total mins
        var totalmMinsTimein = (timeinHour * 60) + timeinMin;
        var totalmMinsTimeout = (timeoutHour * 60) + timeoutMin;

        // get total rendered mins
        var totalMinsRendered = totalmMinsTimeout - totalmMinsTimein;
        // convert hours from total rendered mins
        var renderedHours = Math.floor(totalMinsRendered / 60);
        renderedHours = renderedHours > 0 ? renderedHours : 0;
        // convert remaining mins from total rendered mins
        var renderedMins = Math.floor(totalMinsRendered % 60);
        renderedMins = renderedMins > 0 ? renderedMins : 0;

        // Set rendered Hours text
        const hoursRenderedLabel = document.querySelector("#renderedHours");
        hoursRenderedLabel.innerHTML = ('0'  + renderedHours).slice(-2);
        // Set rendered Mins text
        const minsRenderedLabel = document.querySelector("#renderedMins");
        minsRenderedLabel.innerHTML = ('0' + renderedMins).slice(-2);
    }

    function submitNewTask() {

        $("#new-task").click(function() {
            const timeIn = document.querySelector("#input-timein").value;
            const timeOut = document.querySelector("#input-timeout").value;
            var timeRendered = document.querySelector("#renderedHours").innerHTML + ":" + document.querySelector("#renderedMins").innerHTML;

            if(timeIn != "" && timeOut != "" && timeRendered != "") {
                $.ajax({
                    url:'submitDailyLog.php',
                    type:'post',
                    data:{timein: timeIn, timeout: timeOut, renderedHours: timeRendered},
                    success:function(response) {
                        if(response == 1) {
                            // console.log("timeIn: " + timeIn + " | " + "timeOut: " + timeOut + " | " + "Time rendered: " + timeRendered);
                        }
                        else {
                            // console.log("response: " + response);
                        }
                    }
                })
            }
        });
    }
    submitNewTask();