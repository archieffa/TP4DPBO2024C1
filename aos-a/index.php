<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Members.controller.php");

$members = new MembersController();

if (isset($_POST['add'])) {  // permintaan POST adalah untuk menambahkan anggota baru
  $members->add($_POST);
} else if (isset($_POST['edit'])) {  // permintaan POST adalah untuk mengedit data anggota
  $members->edit($_POST);
} else if (!empty($_GET['new'])) {  // adanya permintaan untuk menampilkan formulir penambahan anggota baru
  $members->formAdd();
} else if (!empty($_GET['id_delete'])) {  // adanya permintaan untuk menghapus anggota
  $id = $_GET['id_delete'];
  $members->delete($id);
} else if (!empty($_GET['id_edit'])) {  // adanya permintaan untuk menampilkan formulir edit anggota
  $id = $_GET['id_edit'];
  $members->formEdit($id);
} else {  // tampilkan daftar anggota
  $members->index();
}