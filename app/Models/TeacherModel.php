<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    
    // 1. ENABLE SOFT DELETES
    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';
    
    // 2. Add 'deleted_at' to the allowed fields
    protected $allowedFields = ['name', 'birthday', 'address', 'created_at', 'updated_at', 'deleted_at'];

    public function getRecords($start, $length, $searchValue = '')
    {
        $builder = $this->builder();
        $builder->select('*');

        // 3. Hide deleted teachers from the DataTable view
        $builder->where('deleted_at', null);

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('name', $searchValue)
                ->orLike('address', $searchValue)
                ->groupEnd();
        }

        $filteredBuilder = clone $builder;
        $filteredRecords = $filteredBuilder->countAllResults(false);

        $builder->limit($length, $start);
        $data = $builder->get()->getResultArray();

        return ['data' => $data, 'filtered' => $filteredRecords];
    }
}