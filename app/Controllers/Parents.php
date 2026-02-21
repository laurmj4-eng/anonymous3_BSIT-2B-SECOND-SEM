<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\LogModel;
use CodeIgniter\Controller;

class Parents extends Controller
{
    public function index(){
        return view('parents/index');
    }

    public function save(){
        $model = new ParentsModel();
        $logModel = new LogModel();

        $data = [
            'name'       => $this->request->getPost('name'),
            'birthday'   => $this->request->getPost('birthday'),
            'address'    => $this->request->getPost('address'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($model->insert($data)) {
            $logModel->addLog('Added new parent: ' . $data['name'], 'ADD');
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save parent']);
        }
    }

    public function edit($id){
        $model = new ParentsModel();
        $parentData = $model->find($id);

        if ($parentData) {
            return $this->response->setJSON(['data' => $parentData]);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Parent not found']);
        }
    }

    public function update(){
        $model = new ParentsModel();
        $logModel = new LogModel();
        
        $id = $this->request->getPost('id');

        if (empty($id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: Parent ID is missing.']);
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'birthday'   => $this->request->getPost('birthday'),
            'address'    => $this->request->getPost('address'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $updated = $model->set($data)->where('id', $id)->update();

        if ($updated) {
            $logModel->addLog('Updated parent: ' . $data['name'], 'UPDATED');
            return $this->response->setJSON(['success' => true, 'message' => 'Parent updated successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error updating parent. No changes were made.']);
        }
    }

    public function delete($id){
        $model = new ParentsModel();
        $logModel = new LogModel();
        $parentData = $model->find($id);

        if (!$parentData) {
            return $this->response->setJSON(['success' => false, 'message' => 'Parent not found.']);
        }

        if ($model->delete($id)) {
            $logModel->addLog('Deleted parent: ' . $parentData['name'], 'DELETED');
            return $this->response->setJSON(['success' => true, 'message' => 'Parent deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete parent.']);
        }
    }

    public function fetchRecords()
    {
        $request = service('request');
        $model = new ParentsModel();

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