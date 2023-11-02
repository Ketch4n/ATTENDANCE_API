<?php
include '../../db/database.php';

$data = json_decode(file_get_contents('php://input'), true);

$student_id = $data['student_id'];
$estab_id = $data['estab_id'];
$time_in_am = $data['time_in_am'];
$in_am = $data['in_am'];
$time_out_am = $data['time_out_am'];
$out_am = $data['out_am'];
$time_in_pm = $data['time_in_pm'];
$in_pm = $data['in_pm'];
$time_out_pm = $data['time_out_pm'];
$out_pm = $data['out_pm'];
$date = $data['date'];

// Check if data already exists for the given student_id and date
$checkIfExists = $con->prepare("SELECT id FROM dtr WHERE student_id = ? AND date = ?");
$checkIfExists->bind_param("is", $student_id, $date);
$checkIfExists->execute();
$checkIfExists->store_result();
$rows = $checkIfExists->num_rows;
$checkIfExists->close();

if ($rows > 0) {
    // Update the existing row if data for the student_id and date already exist
    $sql = "UPDATE dtr SET time_in_am = ?, in_am = ?, time_out_am = ?, out_am = ?, time_in_pm = ?, in_pm = ?, time_out_pm = ?, out_pm = ? WHERE student_id = ? AND date = ?";
    $stmtUpdate = $con->prepare($sql);
    $stmtUpdate->bind_param("ssssssssis", $time_in_am, $in_am, $time_out_am, $out_am, $time_in_pm, $in_pm, $time_out_pm, $out_pm, $student_id, $date);

    if ($stmtUpdate->execute()) {
        $response = array('status' => 'Success', 'message' => "Updated existing entry");
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => $stmtUpdate->error);
        echo json_encode($response);
    }
} else {
    // Insert a new row if data for the student_id and date doesn't exist
    $sql = "INSERT INTO dtr (student_id, estab_id, time_in_am, in_am, time_out_am, out_am, time_in_pm, in_pm, time_out_pm, out_pm, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $con->prepare($sql);
    $stmtInsert->bind_param("iisssssssss", $student_id, $estab_id, $time_in_am, $in_am, $time_out_am, $out_am, $time_in_pm, $in_pm, $time_out_pm, $out_pm, $date);

    if ($stmtInsert->execute()) {
        $response = array('status' => 'Success', 'message' => "Inserted new entry");
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => $stmtInsert->error);
        echo json_encode($response);
    }
}
