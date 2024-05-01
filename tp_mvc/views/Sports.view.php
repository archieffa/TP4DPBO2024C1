<?php

class SportsView
{
    public function render($data)
    {
        $dataSports = null;
        $no = 1;

        foreach ($data['sports'] as $val) {
            list($id) = $val;
            $dataSports .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $val['sports_name'] . "</td>
                <td>
                <a href='sports.php?id_edit=" . $val['id_sports'] . "'class ='btn btn-success'>Update</a>
                <a href='sports.php?id_delete= " . $id . "'class ='btn btn-danger'>Delete</a>
                </td>
               </tr>";
        }
        $view = new Template("templates/sports.html");
        $view->replace("DATA_TABEL_INDEX", $dataSports);
        $view->write();
    }
}