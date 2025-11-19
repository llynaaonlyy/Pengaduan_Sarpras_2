<?php

namespace App\Controllers;

use App\Models\TemporaryItemModel;

class TemporaryItemController extends BaseController
{
    public function index()
    {
        $model = new TemporaryItemModel();
        $data['row'] = $model->findAll();

        return view('temporary_item', $data);
    }

    public function delete($id)
    {
        $model = new TemporaryItemModel();
        $model->delete($id);

        return redirect()->to('/temporary_item')->with('success', 'Data berhasil dihapus.');
    }
}