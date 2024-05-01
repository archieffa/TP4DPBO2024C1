<?php
include_once("connection.php");
include_once("models/Members.class.php");
include_once("models/Sports.class.php");
include_once("views/Sports.view.php");

class SportController
{
    private $sports;

    // inisialisasi objek sports
    function __construct()
    {
        $this->sports = new Sports(Connection::$db_host, Connection::$db_user, Connection::$db_pass, Connection::$db_name);
    }

    // menampilkan data kelas olahraga
    public function index()
    {
        $this->sports->open();
        $this->sports->getSport();

        $data = array(
            'sports' => array()
        );

        while ($row = $this->sports->getResult()) {
            array_push($data['sports'], $row);
        }
        
        $this->sports->close();

        $view = new SportsView();
        $view->render($data);
    }

    // menambahkan kelas anggota 
    function add($data)
    {
        $this->sports->open();
        $this->sports->addSport($data);
        $this->sports->close();
        
        header("location:sports.php");
    }

    // menampilkan form untuk menambahkan kelas anggota
    function formAdd()
    {
        $id = null;
        $view = new Template("templates/sportForm.html");
        $view->replace("GET_ID", $id);
        $view->replace("DATA_BUTTON", 'add');
        $view->replace("DATA_TITLE", 'Add');
        $view->write();
    }

    // mengedit data kelas olahraga
    function edit($id, $data)
    {
        $this->sports->open();
        $this->sports->updateSport($id, $data);
        $this->sports->close();

        header("location:sports.php");
    }
    
    // menampilkan form untuk mengedit data kelas olahraga
    function formEdit($id)
    {
        $this->sports->open();
        $this->sports->getSportById($id);

        $data = array();
        while ($row = $this->sports->getResult()) {
            $data[] = $row;
        }

        $this->sports->close();
        
        if (count($data) > 0) {
            foreach ($data as $val) {
                $id = $val[0];
                $nama_sport = $val[1];
            }
        }

        $view = new Template("templates/sportForm.html");
        $view->replace("DATA_BUTTON", 'edit');
        $view->replace("DATA_TITLE", 'Edit');
        $view->replace("GET_ID", $id);
        $view->replace("DATA_SPORTS", $nama_sport);
        $view->write();
    }

    // menghapus kelas olahraga
    function delete($data)
    {
        $this->sports->open();
        $this->sports->deleteSport($data);
        $this->sports->close();

        header("location:sports.php");
    }
}