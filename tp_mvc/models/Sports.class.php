<?php

class Sports extends DB
{
    function getSport()
    {
        $query = "SELECT * FROM sports";
        return $this->execute($query);
    }

    function getSportById($id)
    {
        $query = "SELECT * FROM sports WHERE id_sports=$id";
        return $this->execute($query);
    }

    function addSport($data)
    {
        $sports_name = $data['sports_name'];
        $query = "INSERT INTO sports VALUES('','$sports_name')";
        return $this->execute($query);
    }

    function updateSport($id, $data)
    {
        $sports_name = $data['sports_name'];
        $query = "UPDATE sports SET sports_name = '$sports_name' WHERE id_sports = $id";
        return $this->execute($query);
    }

    function deleteSport($id)
    {
        $query = "DELETE FROM sports WHERE id_sports = '$id'";
        return $this->execute($query);
    }
}