function addSchoolCard(card_count, count_per_page) {
    // Identifying container element;
    var container = document.getElementById("schoolCards");
    // Guard Check(s)
    if(!container) {
        console.log("container not found.");
    }

    // Assigned Number of rows
    // var row_count = count_per_page / 4;

    for(var i = 0; i < 2; i++) {
        // Create a new row element
        var newRow = document.createElement("div");
        newRow.classList.add("row");

        // Add Card elements to row
        for(var j = 0; j < 4; j++) {
            newRow.innerHTML += `
                <div class="col-md-3">
                    <div class="card" style="border-radius: 25px;border-style: none;">
                        <div class="card-body" style="border-radius: 25px;box-shadow: 0px 4px 20px rgba(0,0,0,0.15);border-style: none;"><img width="100" height="80" style="height: 20%;width: 100%;">
                            <h4 class="card-title" style="margin-top: 5%;text-align: center;font-weight: bold;margin-bottom: 25'px;">Pamantasan ng Lungsod ng Maynila</h4>
                            <h6 class="text-muted card-subtitle mb-2" style="text-align: center;font-size: 14px;margin-top: 25px;margin-bottom: 30px;">General Luna, corner Muralla St, Intramuros, Manila</h6>
                        </div>
                    </div>
                </div>
            `;
        }
        container.appendChild(newRow);
    }
}

addSchoolCard(8, 8);