<?php

function getStage()
{
    $mysqli = require "config/database.php";

    $res = $mysqli->query("SELECT * FROM academic_stage");
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return empty($data) ? null : $data;
}

if (isset($_GET["type"]) && isset($_GET["id"])) {
    $type = $_GET["type"];
    $id = htmlspecialchars($_GET["id"]);

    if ($type === "grade") {
        echo getGrade($id);
    } elseif ($type === "semester") {
        echo getSemester($id);
    } elseif ($type === "subject") {
        echo getSubject($id);
    }
    exit;
}

function getGrade($id)
{
    $mysqli = require "config/database.php";

    $res = $mysqli->query("SELECT * FROM grade WHERE academic_id = '$id'");
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return empty($data) ? json_encode([]) : json_encode($data);
}

function getSemester($id)
{
    $mysqli = require "config/database.php";

    $res = $mysqli->query("SELECT * FROM semester WHERE grade_id = '$id'");
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return empty($data) ? json_encode([]) : json_encode($data);
}

function getSubject($id)
{
    $mysqli = require "config/database.php";

    $id = htmlspecialchars($id);


    $res = $mysqli->query("SELECT * FROM subject WHERE semester_id = '$id'");
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return empty($data) ? json_encode([]) : json_encode($data);
}
