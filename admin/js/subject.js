function updateGrades(stageId) {
    const gradeDropdown = document.getElementById('grade');
    const semesterDropdown = document.getElementById('semester');

    // Disable the Grade and Semester dropdowns initially
    gradeDropdown.disabled = true;
    semesterDropdown.disabled = true;

    gradeDropdown.innerHTML = '<option value="">Loading...</option>';
    semesterDropdown.innerHTML = '<option value="">All Semesters</option>';

    if (stageId) {
        fetch(`subject.php?action=getGrades&stage_id=${stageId}`)
            .then(response => response.json())
            .then(data => {
                gradeDropdown.innerHTML = '<option value="">All Grades</option>';
                data.forEach(grade => {
                    gradeDropdown.innerHTML += `<option value="${grade.id}">${grade.grade}</option>`;
                });

                // Enable the Grade dropdown after data is loaded
                gradeDropdown.disabled = false;
            });
    } else {
        gradeDropdown.innerHTML = '<option value="">All Grades</option>';
    }
}

function updateSemesters(gradeId) {
    const semesterDropdown = document.getElementById('semester');

    // Disable the Semester dropdown initially
    semesterDropdown.disabled = true;

    semesterDropdown.innerHTML = '<option value="">Loading...</option>';

    if (gradeId) {
        fetch(`subject.php?action=getSemesters&grade_id=${gradeId}`)
            .then(response => response.json())
            .then(data => {
                semesterDropdown.innerHTML = '<option value="">All Semesters</option>';
                data.forEach(semester => {
                    semesterDropdown.innerHTML += `<option value="${semester.id}">${semester.semester_number}</option>`;
                });

                // Enable the Semester dropdown after data is loaded
                semesterDropdown.disabled = false;
            });
    } else {
        semesterDropdown.innerHTML = '<option value="">All Semesters</option>';
    }
}

function updateTable() {
    const stageId = document.getElementById('stage').value;
    const gradeId = document.getElementById('grade').value;
    const semesterId = document.getElementById('semester').value;

    const tableBody = document.getElementById('subject-table-body');
    tableBody.innerHTML = '<tr><td colspan="5">Loading...</td></tr>';

    const url = `subject.php?action=getSubjects&stage=${stageId}&grade=${gradeId}&semester=${semesterId}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = '';
            if (data.length > 0) {
                data.forEach(subject => {
                    const row = `
                        <tr>
                            <td>${subject.subject || 'null'}</td>
                            <td>${subject.semester_number || 'null'}</td>
                            <td>${subject.grade || 'null'}</td>
                            <td>${subject.academic_stage || 'null'}</td>
                            <td>
                                <a href="edit-subject.php?type=subject&id=${subject.id}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="delete.php?type=subject&id=${subject.id}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            } else {
                tableBody.innerHTML = '<tr><td colspan="5">No subjects found.</td></tr>';
            }
        });
}

// Update the table and dropdowns whenever a filter changes
document.getElementById('stage').addEventListener('change', () => {
    const stageId = document.getElementById('stage').value;

    // Disable Grade and Semester dropdowns if no Academic Stage is selected
    if (!stageId) {
        document.getElementById('grade').disabled = true;
        document.getElementById('semester').disabled = true;
    }

    updateGrades(stageId);
    updateTable();
});

document.getElementById('grade').addEventListener('change', () => {
    updateSemesters(document.getElementById('grade').value);
    updateTable();
});

document.getElementById('semester').addEventListener('change', updateTable);

// Initial table load
document.getElementById('grade').disabled = true;
document.getElementById('semester').disabled = true;
updateTable();