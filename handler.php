<?php
require_once("connection.php");
require_once("classes/Client.php");
$record = new Client($conn);
if (isset($_POST["add_record"])) {
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $birth_date = trim($_POST["birth_date"] ?? "");
    $contact_number = trim($_POST["contact_number"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $record->add($first_name, $last_name, $gender, $birth_date, $contact_number, $address, $email);
    header("Location: index.php?message=added"); exit();
}
if (isset($_POST["update_record"])) {
    $client_id = $_POST["client_id"];
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $birth_date = trim($_POST["birth_date"] ?? "");
    $contact_number = trim($_POST["contact_number"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $record->update($client_id, $first_name, $last_name, $gender, $birth_date, $contact_number, $address, $email);
    header("Location: index.php?message=updated"); exit();
}
if (isset($_POST["delete_record"])) {
    $client_id = $_POST["client_id"];
    $record->delete($client_id);
    header("Location: index.php?message=deleted"); exit();
}
?>