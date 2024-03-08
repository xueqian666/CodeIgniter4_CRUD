<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['name', 'username', 'password'];

    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $db = \Config\Database::connect();
        $builder = $db->table('users');
    }

    public function insert_data($data)
    {
        if ($this->db->table($this->table)->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
}