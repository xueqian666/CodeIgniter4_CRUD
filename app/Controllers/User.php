<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{

    public function index()
    {
        $model = new UserModel();
        $data['users_detail'] = $model->orderBy('id', 'DESC')->findAll();
        return view('list', $data);
    }


    public function store()
    {
        helper(['form', 'url']);

        $model = new UserModel();

        $data = [
            'name' => $this->request->getVar('txtName'),
            'username'  => $this->request->getVar('txtuserName'),
            'password'  => $this->request->getVar('txtPassword'),
        ];
        $save = $model->insert_data($data);

        if ($save != false) {
            $data = $model->where('id', $save)->first();
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function edit($id = null)
    {

        $model = new UserModel();

        $data = $model->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function update()
    {

        helper(['form', 'url']);

        $model = new UserModel();

        $id = $this->request->getVar('hdnuserId');

        $data = [
            'name' => $this->request->getVar('txtName'),
            'username'  => $this->request->getVar('txtuserName'),
            'password'  => $this->request->getVar('txtPassword'),
        ];

        $update = $model->update($id, $data);
        if ($update != false) {
            $data = $model->where('id', $id)->first();
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function delete($id = null)
    {
        $model = new UserModel();
        $delete = $model->where('id', $id)->delete();
        if ($delete) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }
}