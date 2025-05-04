function updateTable() {
    const stageId = document.getElementById('stage').value;

    const tableBody = document.getElementById('grade-table-body');
    tableBody.innerHTML = '<tr><td colspan="3">Loading...</td></tr>';

    const url = `grade.php?action=getGrades&stage=${stageId}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = '';
            if (data.length > 0) {
                data.forEach(grade => {
                    const row = `
                        <tr>
                            <td>${grade.grade || 'null'}</td>
                            <td>${grade.academic_stage || 'null'}</td>
                            <td>
                                <a href="edit-grade.php?type=grade&id=${grade.id}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete.php?type=grade&id=${grade.id}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            } else {
                tableBody.innerHTML = '<tr><td colspan="3">No grades found.</td></tr>';
            }
        });
}

document.getElementById('stage').addEventListener('change', updateTable);
updateTable();