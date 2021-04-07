<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;

use App\Models\CountryModel;

class Country extends BaseController
{
    use ResponseTrait;

	public function index()
	{
        $model = new CountryModel();
        $data['employees'] = $model->findAll();
        return $this->respond($data, 200);
	}

    public function create() {
        $model = new CountryModel();
        
        $data = [
            'name' => $this->request->getVar('name')
        ];
        $model->insert($data);
        
        $errors = $model->errors();

        if ($errors) {
            return $this->failValidationError(json_encode($errors));
        }

        $response = [
            'error'    => $errors,
            'messages' => [
                'success' => 'Employee created successfully'
            ]
        ];

        return $this->respondCreated($response);
    }
}
