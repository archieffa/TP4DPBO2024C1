<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Sports.Controller.php");

$sports = new SportController();

if (isset($_POST['add'])) { //data button
    $sports->add($_POST);
} else if (!empty($_POST['id'])) { //data button
    $id = $_POST['id'];
    $sports->edit($id, $_POST);
} else if (!empty($_GET['new'])) {
    $sports->formAdd();
} else if (!empty($_GET['id_delete'])) {
    $id = $_GET['id_delete'];
    $sports->delete($id);
} else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $sports->formEdit($id);
} else {
    $sports->index();
}