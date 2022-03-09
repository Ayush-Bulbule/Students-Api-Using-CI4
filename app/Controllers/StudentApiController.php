<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student;
use CodeIgniter\API\ResponseTrait;

class StudentApiController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        //
        $students = new Student();
        $data = $students->orderBy('id', 'ASC')->findAll();

        if ($data) {
            return $this->respond([
                'status' => '1',
                'message' => 'Student feched successfully',
                'data' => $data
            ]);
        } else {
            return $this->respond([
                'status' => 0,
                'message' => 'Student creation failed'
            ]);
        }
    }
    public function create()
    {
        $students = new Student();
        $data = [
            'name' => $this->request->getVar('name'),
            'age' => $this->request->getVar('age'),
            'country' => $this->request->getVar('country')
        ];
        $result = $students->save($data);

        if ($result) {
            return $this->respond([
                'status' => '1',
                'message' => 'Student created successfully',
                'data' => $result
            ]);
        } else {
            return $this->respond([
                'status' => 0,
                'message' => 'Student creation failed'
            ]);
        }
    }

    //show single student
    public function show()
    {
        $students = new Student();

        $id = $this->request->getVar('id');
        $data = $students->find($id);
        if ($data) {
            return $this->respond([
                'status' => '1',
                'message' => 'Student feched successfully',
                'data' => $data
            ]);
        } else {
            return $this->respond([
                'status' => 0,
                'message' => 'Student not found'
            ]);
        }
    }


    public function update($id)
    {
        $student = new Student();
        $data = [
            'name' => $this->request->getVar('name'),
            'age' => $this->request->getVar('age'),
            'country' => $this->request->getVar('country')
        ];

        $result = $student->update($id, $data);
        if ($result) {
            return $this->respond([
                'status' => '1',
                'message' => 'Student updated successfully',
                'data' => $data
            ]);
        } else {
            return $this->respond([
                'status' => 0,
                'message' => 'Student not updated'
            ]);
        }
    }
    public function delete($id)
    {
        $student = new Student();

        $result = $student->delete($id);
        if ($result) {
            return $this->respond([
                'status' => '1',
                'message' => 'Student Deleted successfully',
            ]);
        } else {
            return $this->respond([
                'status' => 0,
                'message' => $id . '  not Found Student Not Deleted'
            ]);
        }
    }
}


















// 