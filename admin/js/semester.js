function updateGrades(stageId) {
    const gradeDropdown = document.getElementById('grade');
    gradeDropdown.disabled = true;
    gradeDropdown.innerHTML = '<option value="">Loading...</option>';

    if (stageId) {
        fetch(`semester.php?action=getGrades&stage_id=${stageId}`)
            .then(response => response.json())
            .then(data => {
                gradeDropdown.innerHTML = '<option value="">All Grades</option>';
                data.forEach(grade => {
                    gradeDropdown.innerHTML += `<option value="${grade.id}">${grade.grade}</option>`;
                });
                gradeDropdown.disabled = false;
            });
    } else {
        gradeDropdown.innerHTML = '<option value="">All Grades</option>';
    }
}

function updateTable() {
    const stageId = document.getElementById('stage').value;
    const gradeId = document.getElementById('grade').value;

    const tableBody = document.getElementById('semester-table-body');
    tableBody.innerHTML = '<tr><td colspan="4">Loading...</td></tr>';

    const url = `semester.php?action=getSemesters&stage=${stageId}&grade=${gradeId}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = '';
            if (data.length > 0) {
                data.forEach(semester => {
                    const row = `
                        <tr>
                            <td>${semester.semester_number || 'null'}</td>
                            <td>${semester.grade || 'null'}</td>
                            <td>${semester.academic_stage || 'null'}</td>
                            <td>
                                <a href="edit-semester.php?type=semester&id=${semester.id}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete.php?type=semester&id=${semester.id}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            } else {
                tableBody.innerHTML = '<tr><td colspan="4">No semesters found.</td></tr>';
            }
        });
}

document.getElementById('stage').addEventListener('change', () => {
    updateGrades(document.getElementById('stage').value);
    updateTable();
});

document.getElementById('grade').addEventListener('change', updateTable);
updateTable();