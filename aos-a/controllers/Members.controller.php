<?php
include_once("connection.php");
include_once("models/Members.class.php");
include_once("models/Sports.class.php");
include_once("views/Members.view.php");

class MembersController
{
    private $members;
    private $sports;

    // inisialisasi objek members dan sports
    function __construct()
    {
        $this->members = new Members(Connection::$db_host, Connection::$db_user, Connection::$db_pass, Connection::$db_name);
        $this->sports = new Sports(Connection::$db_host, Connection::$db_user, Connection::$db_pass, Connection::$db_name);
    }

    // menampilkan daftar anggota
    public function index()
    {
        // buka koneksi ke database
        $this->members->open();
        $this->sports->open();

        // ambil data dari database
        $this->members->getMemberJoin();
        $this->sports->getSport();

        // array yang akan ditampilkan di view
        $data = array(
            'members' => array(),
            'sports' => array()
        );

        // ambil hasil query lalu masukkan ke dalam array
        while ($row = $this->members->getResult()) {
            array_push($data['members'], $row);
        }

        // tutup koneksi ke database
        $this->members->close();
        $this->sports->close();

        // tampilkan data ke view
        $view = new MembersView();
        $view->render($data);
    }

    // menambah anggota
    function add($data)
    { 
        // buka koneksi - tambahkan anggota baru ke database - tutup koneksi
        $this->members->open();
        $this->members->addMember($data);
        $this->members->close();

        header("location:index.php");  // halaman utama
    }

    // menampilkan formulir tambah anggota
    function formAdd()
    {
        // buka koneksi - ambil data olahraga dari database
        $this->sports->open();
        $this->sports->getSport();

        // siapkan data olahraga untuk ditampilkan
        $sports = array();
        while ($row = $this->sports->getResult()) {
            array_push($sports, $row);
        }

        $this->sports->close();  // tutup koneksi

        // format data olahraga ke dalam opsi di formulir
        $dataSports = null;
        $id = null;
        foreach ($sports as $val) {
            list($id, $name) = $val;
            $dataSports .= "<option value='" . $id . "'>" . $name . "</option>";
        }

        // template formulir untuk menambah anggota
        $view = new Template("templates/memberForm.html");
        $view->replace("GET_ID", $id);
        $view->replace("OPTION", $dataSports);
        $view->replace("DATA_BUTTON", 'add');
        $view->replace("DATA_TITLE", 'Add');
        $view->write();
    }

    // mengedit data anggota
    function edit($data)
    {
        // buka koneksi - edit data anggota di database - tutup koneksi
        $this->members->open();
        $this->members->updateMember($data);
        $this->members->close();

        header("location:index.php");
    }

    // menampilkan formulir edit anggota
    function formEdit($id)
    {
        // buka koneksi - ambil data anggota dan olahraga dari database
        $this->members->open();
        $this->sports->open();
        $this->members->getMemberById($id);
        $this->sports->getSport();

        // siapkan data anggota dan olahraga untuk ditampilkan
        $data = array(
            'members' => null,
            'sports' => array()
        );
        $dataMember = $data['members'];

        $dataMember = $this->members->getResult();
        while ($row = $this->sports->getResult()) {
            array_push($data['sports'], $row);
        }

        $dataSport = null;
        foreach ($data['sports'] as $val) {
            list($id, $name) = $val;
            $dataSport .= "<option value='" . $id . "' " . ($id == $dataMember['id_sports'] ? "selected" : "") . ">" . $name . "</option>";
        }
        
        // tutup koneksi
        $this->members->close();
        $this->sports->close();

        // template formulir untuk mengedit data anggota
        $view = new Template("templates/memberForm.html");
        $view->replace("DATA_BUTTON", 'edit');
        $view->replace("DATA_TITLE", 'Edit');
        $view->replace("GET_ID", $dataMember['id']);
        $view->replace("DATA_NAME", $dataMember['name']);
        $view->replace("DATA_EMAIL", $dataMember['email']);
        $view->replace("DATA_PHONE", $dataMember['phone']);
        $view->replace("DATA_JOININGDATE", $dataMember['joining_date']);
        $view->replace("OPTION", $dataSport);
        $view->write();
    }

    // menghapus anggota
    function delete($data)
    {
        // buka koneksi - hapus anggota dari database - tutup koneksi
        $this->members->open();
        $this->members->deleteMember($data);
        $this->members->close();

        header("location:index.php");
    }
}