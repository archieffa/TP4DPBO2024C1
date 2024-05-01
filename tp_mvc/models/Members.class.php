<?php

class Members extends DB
{
    // mendapatkan daftar anggota beserta informasi olahraga yang diikuti
    function getMemberJoin()
    {
        $query = "SELECT * FROM members JOIN sports ON members.id_sports=sports.id_sports ORDER BY members.id";
        return $this->execute($query);
    }

    // mendapatkan daftar semua anggota
    function getMember()
    {
        $query = "SELECT * FROM members";
        return $this->execute($query);
    }

    // mendapatkan informasi anggota berdasarkan ID
    function getMemberById($id)
    {
        $query = "SELECT * FROM members JOIN sports ON members.id_sports=sports.id_sports WHERE members.id=$id";
        return $this->execute($query);
    }

    // menambahkan anggota baru ke dalam database
    function addMember($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $joining_date = $data['joining_date'];
        $id_sports = $data['id_sports'];

        $query = "INSERT INTO members VALUES('','$name', '$email' , '$phone', '$joining_date', '$id_sports')";

        return $this->execute($query);
    }

    // edit data anggota di database
    function updateMember($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $joining_date = $data['joining_date'];
        $id_sports = $data['id_sports'];

        $query = "UPDATE members SET name = '$name', email = '$email', phone = '$phone', joining_date = '$joining_date', id_sports = '$id_sports' WHERE members.id = '$id'";

        return $this->execute($query);
    }

    // hapus anggota dari database
    function deleteMember($id)
    {
        $query = "DELETE FROM members WHERE id = $id";
        return $this->execute($query);
    }
}