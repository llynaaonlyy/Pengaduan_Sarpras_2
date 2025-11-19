<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Health extends Controller
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            $db->query('SELECT 1');
            
            return $this->response->setJSON([
                'status' => 'ok',
                'timestamp' => date('Y-m-d H:i:s'),
                'environment' => getenv('CI_ENVIRONMENT'),
                'database' => 'connected'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(503)->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function info()
    {
        return $this->response->setJSON([
            'php_version' => phpversion(),
            'environment' => getenv('CI_ENVIRONMENT'),
            'baseURL' => config('App')->baseURL,
            'extensions' => get_loaded_extensions()
        ]);
    }
}
