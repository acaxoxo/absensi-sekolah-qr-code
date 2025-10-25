<?php

namespace App\Controllers\Admin;

use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Controllers\BaseController;

class JurusanController extends BaseController
{
    protected JurusanModel $jurusanModel;
    protected KelasModel $kelasModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->kelasModel = new KelasModel();
        $this->jurusanModel = new JurusanModel();
    }

    /**
     * Return redirect to kelas controller
     *
     * @return mixed
     */
    public function index()
    {
        return redirect()->to('admin/kelas');
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */

    public function listData()
    {
        $vars['data'] = $this->jurusanModel->getDataJurusan();
        $htmlContent = '';
        if (!empty($vars['data'])) {
            $htmlContent = view('admin/jurusan/list-jurusan', $vars);
            $data = [
                'result' => 1,
                'htmlContent' => $htmlContent,
            ];
            echo json_encode($data);
        } else {
            echo json_encode(['result' => 0]);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function tambahJurusan()
    {
        $data = [
            'ctx' => 'kelas',
            'title' => 'Tambah Data Jurusan',
        ];
        return view('/admin/jurusan/create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function tambahJurusanPost()
    {
        $val = \Config\Services::validation();
        $val->setRule('jurusan', 'Jurusan', 'required|max_length[32]|is_unique[tb_jurusan.jurusan]');

        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->to('admin/jurusan/tambah')->withInput();
        } else {
            if ($this->jurusanModel->addJurusan()) {
                $this->session->setFlashdata('success', 'Tambah data berhasil');
                return redirect()->to('admin/jurusan');
            } else {
                $this->session->setFlashdata('error', 'Gagal menambah data');
                return redirect()->to('admin/jurusan/tambah')->withInput();
            }
        }

        return redirect()->to('admin/jurusan/tambah');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function editJurusan($id)
    {
        $data['title'] = 'Edit Jurusan';
        $data['ctx'] = 'kelas';
        $data['jurusan'] = $this->jurusanModel->getJurusan($id);
        if (empty($data['jurusan'])) {
            return redirect()->to('admin/kelas');
        }

        return view('/admin/jurusan/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function editJurusanPost()
    {
        $val = \Config\Services::validation();
        $val->setRule('jurusan', 'Jurusan', 'required|max_length[32]|is_unique[tb_jurusan.jurusan]');
        if (!$this->validate(getValRules($val))) {
            $this->session->setFlashdata('errors', $val->getErrors());
            return redirect()->back();
        } else {
            $id = inputPost('id');
            if ($this->jurusanModel->editJurusan($id)) {
                $this->session->setFlashdata('success', 'Edit data berhasil');
                return redirect()->to('admin/jurusan');
            } else {
                $this->session->setFlashdata('error', 'Gagal Mengubah data');
            }
        }
        return redirect()->to('admin/jurusan/edit/' . cleanNumber($id));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function deleteJurusanPost($id = null)
    {
        $id = inputPost('id');
        $jurusan = $this->jurusanModel->getJurusan($id);
        if (!empty($jurusan)) {
            // Start transaction
            $this->jurusanModel->transStart();
            
            try {
                // Delete all related data in correct order
                $db = \Config\Database::connect();
                
                // 1. Delete attendance records for students in classes of this jurusan
                $db->query("DELETE ps FROM tb_presensi_siswa ps
                    INNER JOIN tb_siswa s ON ps.id_siswa = s.id_siswa
                    INNER JOIN tb_kelas k ON s.id_kelas = k.id_kelas
                    WHERE k.id_jurusan = ?", [$id]);
                
                // 2. Delete students in classes of this jurusan
                $db->query("DELETE s FROM tb_siswa s
                    INNER JOIN tb_kelas k ON s.id_kelas = k.id_kelas
                    WHERE k.id_jurusan = ?", [$id]);
                
                // 3. Delete all classes of this jurusan
                $db->query("DELETE FROM tb_kelas WHERE id_jurusan = ?", [$id]);
                
                // 4. Finally delete the jurusan itself
                $this->jurusanModel->deleteJurusan($id);
                
                // Complete transaction
                $this->jurusanModel->transComplete();
                
                if ($this->jurusanModel->transStatus() === false) {
                    $this->session->setFlashdata('error', 'Gagal menghapus data');
                } else {
                    $this->session->setFlashdata('success', 'Data berhasil dihapus');
                }
            } catch (\Exception $e) {
                $this->jurusanModel->transRollback();
                $this->session->setFlashdata('error', 'Gagal menghapus data: ' . $e->getMessage());
            }
        }
    }
}
