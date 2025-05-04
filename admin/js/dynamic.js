function getGrade(idStage) {
    let gradeDropDwon = document.forms["ebook-form"].grade;

    if (idStage.trim() === "") {
        gradeDropDwon.disabled = true;
        gradeDropDwon.selectedIndex = 0;
        return false;
    }

    fetch(`ebook-function.php?type=grade&id=${idStage}`)
        .then(response => response.json())
        .then(function (grades) {
            let out = "";
            out += '<option value="">Choose a Grade</option>';
            for (let grade of grades) {
                out += `<option value="${grade["id"]}">${grade["grade"]}</option>`;
            }

            gradeDropDwon.innerHTML = out;
            gradeDropDwon.disabled = false;
        });
}

function getSemester(idGrade) {
    let semesterDropDown = document.forms["ebook-form"].semester;

    if (idGrade.trim() === "") {
        semesterDropDown.disabled = true;
        semesterDropDown.selectedIndex = 0;
        return false;
    }

    fetch(`ebook-function.php?type=semester&id=${idGrade}`)
        .then(response => response.json())
        .then(function (semesters) {
            let out = "";
            out += '<option value="">Choose a Semester</option>';
            for (let semester of semesters) {
                out += `<option value="${semester["id"]}">${semester["semester_number"]}</option>`;
            }

            semesterDropDown.innerHTML = out;
            semesterDropDown.disabled = false;
        });

    console.log("Semester Drop Down:", semesterDropDown);
}

function getSubject(idSemester) {
    let subjectDropDown = document.getElementById("subject-dropdown"); // Use the unique id

    if (idSemester.trim() === "") {
        subjectDropDown.disabled = true;
        subjectDropDown.selectedIndex = 0;
        return false;
    }

    fetch(`ebook-function.php?type=subject&id=${idSemester}`)
        .then(response => response.json())
        .then(function (subjects) {
            let out = "";
            out += '<option value="">Choose a Subject</option>';
            for (let subject of subjects) {
                out += `<option value="${subject["id"]}">${subject["subject"]}</option>`;
            }

            subjectDropDown.innerHTML = out;
            subjectDropDown.disabled = false;
        })
        .catch(function (error) {
            console.error("Error fetching subjects:", error);
        });
}