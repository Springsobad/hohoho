<?php

include_once __DIR__ . '/DB.php';
include_once __DIR__ . '/helper.php';

class User
{
    static public function all() // trả về tất cả các dữ liệu của DB
    {
        $sql = "SELECT * FROM users";
        $users = DB::execute($sql);
        return $users;
    }
    static public function create($data)
    {
        $sql = "INSERT INTO users(id,name, email, gender, password) values(:id, :name, :email, :gender, :password)";
        $user = DB::execute($sql, $data);
        return count($user) > 0 ? $user[0] : [];
    }

    static public function find($id)
    {
        $sql = "SELECT * FROM users where id=:id";
        $datafind = ['id' => $id];
        $user = DB::execute($sql, $datafind);
        return count($user) > 0 ? $user[0] : [];
    }

    static public function update($dataUpdate)
    {
        $sql = "UPDATE users set name=:name, email=:email, gender=:gender, password=:password where id=:id";
        DB::execute($sql, $dataUpdate);
    }

    static public function destroy($id)
    {
        $sql = "DELETE FROM users where id=:id";
        $dataDelete = ['id' => $id];
        DB::execute($sql, $dataDelete);
    }
}
