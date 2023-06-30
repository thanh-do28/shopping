<?php

class MyModels extends Database
{
    function select_array($data = "*", $table = '', $where = NULL)
    {
        $sql = "SELECT $data FROM $table";
        if ($where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("", $fields);
            $values = array_values($where);
            $sql .= " WHERE $fields_list = ?";
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        } else {
            $query = $this->conn->prepare($sql);
            $query->execute();
        }


        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function add($table = '', $data = NULL)
    {
        $fields = array_keys($data);
        $fields_list = implode(",", $fields);
        $values = array_values($data);
        $qr = str_repeat("?,", count($fields) - 1);
        $sql = "INSERT INTO `" . $table . "`(" . $fields_list . ") VALUES (${qr}?)";
        $query = $this->conn->prepare($sql);
        if ($query->execute($values)) {
            return json_encode(
                array(
                    'type'  => 'sucessFully',
                    'Message' => 'Insert data success',
                    'id' => $this->conn->lastInsertId()
                )
            );
        } else {
            return json_encode(
                array(
                    'type'  => 'fails',
                    'Message' => 'Insert data fails',
                )
            );
        }
    }
}
