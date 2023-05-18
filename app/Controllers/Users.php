<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    public function __construct()
    {

        $this->Users = new UsersModel();
        helper('form');
    }
    public function index()
    {
        if (session()->get('name') == True) {
            $data = [
                'title' => 'Page | Users',
                'user' => $this->Users->getData()
            ];
            return view('admin/V_admin', $data);
        } else {
            return redirect()->to('/');
        }
    }
    public function insert()
    {
        $password = $this->request->getPost('password');
        $passx = md5($password);
        $data = [

            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $passx,
            'status' => $this->request->getPost('status')

        ];
        $this->Users->insertUsers($data);

        session()->setFlashdata('pesan', 'Congratulation data successfully added');
        //dd($data);
        return redirect()->to('/Users');
    }
    public function update($user_id)
    {
        $data = [
            'title' => 'Page Update | Users',
            'user' => $this->Users->getDetail($user_id),

        ];
        //dd($data);
        return view('admin/V_update', $data);
    }
    public function EditAction($user_id)
    {
        $password = $this->request->getPost('password');
        $passx = md5($password);
        $data = [
            'user_id' => $user_id,
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $passx,
            'status' => $this->request->getPost('status')

        ];
        $this->Users->editData($data);


        session()->setFlashdata('pesan', 'Data Successfully Updated.');
        return redirect()->to('/Users');
    }
    public function deleteData($user_id)
    {

        $this->Users->deleteOum($user_id);
        session()->setFlashdata('pesan', 'Data Successfully Deleted.');
        return redirect()->to('/Users');
    }
}
