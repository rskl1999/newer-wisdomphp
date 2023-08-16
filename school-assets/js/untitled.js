function addStudent() {
  // Get the container element for the new row
  var container = document.getElementById("addStudent-1");

  // Create a new row element
  var newRow = document.createElement("div");
  newRow.classList.add("row");

   // Generate a unique ID for the new row
  var id = Math.floor(Math.random() * 1000);

  // Add the new row's HTML
    newRow.innerHTML = `
      <div class="col">
          <label class="form-label"><strong>First Name</strong></label>
          <input class="form-control" name="fname[${id}]" type="text" style="height: 45px;border-radius: 35px;" placeholder="First Name" required />
        </div>
        <div class="col">
          <label class="form-label"><strong>Last Name</strong></label>
          <input class="form-control" name="lname[${id}]" type="text" style="height: 45px;border-radius: 35px;" placeholder="Last Name" required />
        </div>
        <div class="col">
          <label class="form-label"><strong>Email </strong></label>
          <input class="form-control" name="email[${id}]" type="email" style="height: 45px;border-radius: 35px;" placeholder="Email" required />
        </div>
        <div class="col d-flex align-items-end align-content-start">
        <button class="btn btn-danger delete-row" type="button" style="background: #dc3545;height: 45px;border-radius: 35px;border-width: 2px;border-color: #dc3545;color: #ffffff;margin: 0px 12px;width: 122px;">

          <i class="fa fa-trash"></i>
        </button>
      </div>
    `;

  // Attach a click event listener to the new row's "trash" icon
  var deleteButton = newRow.querySelector(".delete-row");
  deleteButton.addEventListener("click", function(){
    newRow.remove();
  });

  // Add the new row to the container element, after the existing rows
  container.appendChild(newRow);
}

// Attach a click event listener to the "Add" button
var addButton = document.querySelector("#addStudent-1 button");
addButton.addEventListener("click", addStudent);
