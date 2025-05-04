function getGrade(stageId) {
    const gradeDropdown = document.getElementById('grade_id');
    const semesterDropdown = document.getElementById('semester_id');
    const subjectDropdown = document.getElementById('subject_id');

    gradeDropdown.disabled = true;
    semesterDropdown.disabled = true;
    subjectDropdown.disabled = true;

    gradeDropdown.innerHTML = '<option selected disabled>Loading...</option>';
    semesterDropdown.innerHTML = '<option selected disabled>Select a semester</option>';
    subjectDropdown.innerHTML = '<option selected disabled>Select a subject</option>';

    if (stageId) {
        fetch(`dynamic-handler.php?action=getGrades&stage_id=${stageId}`)
            .then(response => response.json())
            .then(data => {
                gradeDropdown.innerHTML = '<option selected disabled>Select a grade</option>';
                data.forEach(grade => {
                    gradeDropdown.innerHTML += `<option value="${grade.id}">${grade.grade}</option>`;
                });
                gradeDropdown.disabled = false;
            });
    }
}

function getSemester(gradeId) {
    const semesterDropdown = document.getElementById('semester_id');
    const subjectDropdown = document.getElementById('subject_id');

    semesterDropdown.disabled = true;
    subjectDropdown.disabled = true;

    semesterDropdown.innerHTML = '<option selected disabled>Loading...</option>';
    subjectDropdown.innerHTML = '<option selected disabled>Select a subject</option>';

    if (gradeId) {
        fetch(`dynamic-handler.php?action=getSemesters&grade_id=${gradeId}`)
            .then(response => response.json())
            .then(data => {
                semesterDropdown.innerHTML = '<option selected disabled>Select a semester</option>';
                data.forEach(semester => {
                    semesterDropdown.innerHTML += `<option value="${semester.id}">Semester ${semester.semester_number}</option>`;
                });
                semesterDropdown.disabled = false;
            });
    }
}

function getSubject(semesterId) {
    const subjectDropdown = document.getElementById('subject_id');

    subjectDropdown.disabled = true;
    subjectDropdown.innerHTML = '<option selected disabled>Loading...</option>';

    if (semesterId) {
        fetch(`dynamic-handler.php?action=getSubjects&semester_id=${semesterId}`)
            .then(response => response.json())
            .then(data => {
                subjectDropdown.innerHTML = '<option selected disabled>Select a subject</option>';
                data.forEach(subject => {
                    subjectDropdown.innerHTML += `<option value="${subject.id}">${subject.subject}</option>`;
                });
                subjectDropdown.disabled = false;
            });
    }
}