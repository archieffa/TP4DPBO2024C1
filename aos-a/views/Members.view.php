<?php

class MembersView
{
    // merender data anggota ke dalam HTML
    public function render($data)
    {
        $no = 1;
        $dataMembers = null;

        // menampilkan data anggota dalam bentuk tabel di HTML
        foreach ($data['members'] as $val) {
            list($id) = $val;
            $dataMembers .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $val['name'] . "</td>
                <td>" . $val['email'] . "</td>
                <td>" . $val['phone'] . "</td>
                <td>" . $val['sports_name'] . "</td>
                <td>" . $val['joining_date'] . "</td>
                <td>
                <a href='index.php?id_edit=" . $id . "'class ='btn btn-success'>Update</a>
                <a href='index.php?id_delete= " . $id . "'class ='btn btn-danger' >Delete</a>
                </td>
               </tr>";
        }
        $view = new Template("templates/index.html");
        $view->replace("DATA_TABEL_INDEX", $dataMembers);
        $view->write();
    }
}