<?php

class MyModels extends Database
{

    // public $table;
    function select_array($data = "*", $where = NULL)
    {
        $sql = "SELECT $data FROM $this->table";
        if ($where != NULL) {
            $fields = array_keys($where);
            $fields_list = implode("", $fields);
            $values = array_values($where);
            $wheres = 'WHERE';
            $isFields = true;
            for ($i = 0; $i < count($fields); $i++) {
                if (!$isFields) {
                    $sql .= " and";
                    $wheres = '';
                }
                $isFields = false;
                $sql .= "  " . $wheres . " " . $fields[$i] . " = ?";
            }
            // echo $sql;
            $query = $this->conn->prepare($sql);
            $query->execute($values);
        } else {
            $query = $this->conn->prepare($sql);
            $query->execute();
        }


        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    function add($data = NULL)
    {
        $fields = array_keys($data);
        $fields_list = implode(",", $fields);
        $values = array_values($data);
        $qr = str_repeat("?,", count($fields) - 1);
        $sql = "INSERT INTO `" . $this->table . "`(" . $fields_list . ") VALUES (${qr}?)";
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



    function update($data = NULL, $where = NULL)
    {
        $sql = "UPDATE $this->table SET ";
        if ($data != NULL && $where != NULL) {
            $fields = array_keys($data);
            $values = array_values($data);
            $where_array = array_keys($where);
            $where_value = array_values($where);

            $wheres = 'WHERE';
            $isFields = true;
            $isWhere = true;
            for ($i = 0; $i < count($fields); $i++) {
                if (!$isFields) {
                    $sql .= ", ";
                }
                $isFields = false;
                $sql .= "" . $fields[$i] . " = ?";
            }
            for ($i = 0; $i < count($where_array); $i++) {
                if (!$isWhere) {
                    $sql .= " and";
                    $wheres = "";
                }
                $isWhere = false;
                $sql .= "  " . $wheres . " " . $where_array[$i] . " = " . $where_value[$i] . "";
            }
            $query = $this->conn->prepare($sql);
            if ($query->execute($values)) {
                return json_encode(
                    array(
                        'type'  => 'sucessFully',
                        'Message' => 'Update data success',
                    )
                );
            } else {
                return json_encode(
                    array(
                        'type'  => 'fails',
                        'Message' => 'Update data fails',
                    )
                );
            }
        }
    }


    function delete($where = NULL)
    {
        $sql = "DELETE FROM $this->table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $where_value = array_values($where);
            $wheres = 'WHERE';
            $isWhere = true;

            for ($i = 0; $i < count($where_array); $i++) {
                if (!$isWhere) {
                    $sql .= " and";
                    $wheres = "";
                }
                $isWhere = false;
                $sql .= "  " . $wheres . " " . $where_array[$i] . " = " . $where_value[$i] . "";
            }
            $query = $this->conn->prepare($sql);
            if ($query->execute()) {
                return json_encode(
                    array(
                        'type'  => 'sucessFully',
                        'Message' => 'Delete data success',
                    )
                );
            } else {
                return json_encode(
                    array(
                        'type'  => 'fails',
                        'Message' => 'Delete data fails',
                    )
                );
            }
        }
    }


    function select_row($data = '*', $where = NULL)
    {
        $sql = " SELECT $data FROM $this->table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $where_value = array_values($where);
            $wheres = 'WHERE';
            $isWhere = true;
            for ($i = 0; $i < count($where_array); $i++) {
                if (!$isWhere) {
                    $sql .= " and";
                    $wheres = "";
                }
                $isWhere = false;
                $sql .= "  " . $wheres . " " . $where_array[$i] . " = " . $where_value[$i] . "";
            }

            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    function select_max_fields($data = '', $where = NULL)
    {
        if ($data != '') {
            $sql = "SELECT MAX(" . $data . ") as sort FROM $this->table";
        }
        if ($where != NULL) {
            $where_array = array_keys($where);
            $value_where = array_values($where);
            $isFields_where = true;
            $stringWhere = 'WHERE';
            for ($i = 0; $i < count($where_array); $i++) {
                if (!$isFields_where) {
                    $sql .= "and";
                    $stringWhere = '';
                }
                $isFields_where = false;
                $sql .= "" . $stringWhere . "" . $where_array[$i] . "=?";
            }
            $query = $this->conn->prepare($sql);
            $query->execute($value_where);
        }
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
