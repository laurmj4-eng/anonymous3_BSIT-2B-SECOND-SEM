<?php

namespace App\Controllers;

use App\Models\StaffModel;
use App\Models\LogModel;
use CodeIgniter\Controller;

class Staff extends Controller
{
    public function index(){
        return view('staff/index');
    }

    public function save(){
        $model = new StaffModel();
        $logModel = new LogModel();

        $data = [
            'name'       => $this->request->getPost('name'),
            'birthday'   => $this->request->getPost('birthday'),
            'address'    => $this->request->getPost('address'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($model->insert($data)) {
            $logModel->addLog('Added new staff: ' . $data['name'], 'ADD');
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save staff']);
        }
    }

    public function edit($id){
        $model = new StaffModel();
        $staff = $model->find($id);

        if ($staff) {
            return $this->response->setJSON(['data' => $staff]);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Staff not found']);
        }
    }

    public function update(){
        $model = new StaffModel();
        $logModel = new LogModel();
        
        $id = $this->request->getPost('id');

        if (empty($id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: Staff ID is missing.']);
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'birthday'   => $this->request->getPost('birthday'),
            'address'    => $this->request->getPost('address'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $updated = $model->set($data)->where('id', $id)->update();

        if ($updated) {
            $logModel->addLog('Updated staff: ' . $data['name'], 'UPDATED');
            return $this->response->setJSON(['success' => true, 'message' => 'Staff updated successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error updating staff. No changes were made.']);
        }
    }

    public function delete($id){
        $model = new StaffModel();
        $logModel = new LogModel();
        $staff = $model->find($id);

        if (!$staff) {
            return $this->response->setJSON(['success' => false, 'message' => 'Staff not found.']);
        }

        if ($model->delete($id)) {
            $logModel->addLog('Deleted staff: ' . $staff['name'], 'DELETED');
            return $this->response->setJSON(['success' => true, 'message' => 'Staff deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete staff.']);
        }
    }

    public function fetchRecords()
    {
        $request = service('request');
        $model = new StaffModel();

        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 10;
        $searchValue = $request->getPost('search')['value'] ?? '';

        $totalRecords = $model->countAll();
        $result = $model->getRecords($start, $length, $searchValue);

        $data = [];
        $counter = $start + 1;
        foreach ($result['data'] as $row) {
            $row['row_number'] = $counter++;
            $data[] = $row;
        }

        return $this->response->setJSON([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $result['filtered'],
            'data' => $data,
        ]);
    }
}