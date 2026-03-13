let selectedRow = null;

function selectRow(row) {

    if (selectedRow) {
        selectedRow.classList.remove("selected");
    }

    row.classList.add("selected");
    selectedRow = row;

    let cells = row.getElementsByTagName("td");

    document.getElementById("emp_id").value = cells[0].innerText;
    document.getElementById("emp_name").value = cells[1].innerText;
    document.getElementById("age").value = cells[2].innerText;
    document.getElementById("phone").value = cells[3].innerText;
}

function clearForm() {

    document.getElementById("emp_id").value =
        document.getElementById("next_id").value;

    document.getElementById("emp_name").value = "";
    document.getElementById("age").value = "";
    document.getElementById("phone").value = "";

    if (selectedRow) {
        selectedRow.classList.remove("selected");
        selectedRow = null;
    }
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this employee?");
}