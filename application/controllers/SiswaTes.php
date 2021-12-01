<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaTes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();       
        $this->load->model('Sekolah_model');
        $this->load->model('Siswa_model');
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
    }

    public function index()
    {
        $data['sekolah'] = $this->Sekolah_model->get_by_id();
        $data['title'] = " Data Siswa";
        $this->load->view('templates/header', $data);
        $this->load->view('admin/siswa', $data);
        $this->load->view('templates/footer');
    }
    public function validasi()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required|is_unique[siswa.nis]', [
            'required' => 'NIS tidak boleh kosong!',
            'is_unique' => 'NIS sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('jk', 'Jenis kelamin', 'required', [
            'required' => 'Jenis kelamin tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required', [
            'required' => 'Tempat lahir tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required', [
            'required' => 'Tanggal lahir tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Alamat tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $output = [
                'error'   => true,
                'nis_error' => form_error('nis'),
                'nama_error' => form_error('nama'),
                'jk_error' => form_error('jk'),
                'tempat_lahir_error' => form_error('tempat_lahir'),
                'tanggal_lahir_error' => form_error('tanggal_lahir'),
                'alamat_error' => form_error('alamat'),
            ];
        } else {
            $nis = htmlspecialchars($this->input->post('nis', true));
            $data = [
                'nis' => htmlspecialchars($this->input->post('nis', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jk' => htmlspecialchars($this->input->post('jk', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'qr' => htmlspecialchars($this->input->post('nis', true) . ".png"),
                'foto' => htmlspecialchars($this->input->post('nis', true)),
            ];
            if ($this->Siswa_model->tambah($data) > 0) {
                $this->load->library('ciqrcode'); //pemanggilan library QR CODE
                $config['cacheable']    = true; //boolean, the default is true
                $config['cachedir']     = './assets/'; //string, the default is application/cache/
                $config['errorlog']     = './assets/'; //string, the default is application/logs/
                $config['imagedir']     = './asset/kartu/qr/'; //direktori penyimpanan qr code
                $config['quality']      = true; //boolean, the default is true
                $config['size']         = '1024'; //interger, the default is 1024
                $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                $this->ciqrcode->initialize($config);

                $image_name = $nis . '.png'; //buat name dari qr code sesuai dengan nip

                $params['data'] = $nis; //data yang akan di jadikan QR CODE
                $params['level'] = 'H'; //H=High
                $params['size'] = 10;
                $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
                $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
                $this->session->set_flashdata('flash', 'Data berhasil disimpan');
            } else {
                $this->session->set_flashdata('flash-error', 'Data gagal disimpan');
            }
            $output = [
                'success'   => true,
            ];
        }

        echo json_encode($output);
    }
    public function update()
    {
        $this->form_validation->set_rules('enis', 'NIS', 'required|callback_check_user_nis', [
            'required' => 'NIS tidak boleh kosong!',
            'is_unique' => 'NIS sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('enama', 'Nama', 'required', [
            'required' => 'Nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('ejk', 'Jenis kelamin', 'required', [
            'required' => 'Jenis kelamin tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('etempat_lahir', 'Tempat lahir', 'required', [
            'required' => 'Tempat lahir tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('etanggal_lahir', 'Tanggal lahir', 'required', [
            'required' => 'Tanggal lahir tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('ealamat', 'Alamat', 'required', [
            'required' => 'Alamat tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $output = [
                'error'   => true,
                'enis_error' => form_error('enis'),
                'enama_error' => form_error('enama'),
                'ejk_error' => form_error('ejk'),
                'etempat_lahir_error' => form_error('etempat_lahir'),
                'etanggal_lahir_error' => form_error('etanggal_lahir'),
                'ealamat_error' => form_error('ealamat'),
            ];
        } else {
            $nis = htmlspecialchars($this->input->post('enis', true));
            $data = [
                'id_siswa' => htmlspecialchars($this->input->post('id_siswa', true)),
                'nis' => htmlspecialchars($this->input->post('enis', true)),
                'nama' => htmlspecialchars($this->input->post('enama', true)),
                'jk' => htmlspecialchars($this->input->post('ejk', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('etempat_lahir', true)),
                'tanggal_lahir' => htmlspecialchars($this->input->post('etanggal_lahir', true)),
                'alamat' => htmlspecialchars($this->input->post('ealamat', true)),
            ];
            if ($this->Siswa_model->update(['id_siswa' => $this->input->post('id_siswa')], $data) > 0) {
                $output = [
                    'success'   => true,
                ];
            } else {
                $output = [
                    'success'   => false,
                ];
            }
        }

        echo json_encode($output);
    }
    function check_user_nis($niy)
    {
        $id = $this->input->post('id_siswa');
        $queryId = $this->db->get_where('siswa', ['id_siswa' => $id])->row_array();
        $query = $this->db->get_where('siswa', ['nis' => $niy]);
        if ($query->num_rows() > 0 && $queryId['nis'] !== $niy) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function akunImport()
    {
        $this->load->library('upload');

        $jmlsukses = 0;
        $jmlgagal = 0;
        $fileName = $_FILES['importfileakun']['name'];

        $config['upload_path'] = './asset/fileimport/akun/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';

        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('importfileakun')) {
            $json = 'failed';
        } else {
            $media = $this->upload->data();
            $json = 'success';
            $inputFileName = './asset/fileimport/akun/' . $media['file_name'];

            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray(
                    'A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE
                );

                $username = $rowData[0][1];
                $password = $rowData[0][2];
                $nis_siswa = $rowData[0][3];
                $cost = 10;
                $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
                // var_dump($date);
                // die;
                $cekdata = $this->db->get_where('akun_siswa', ['username' => $username]);
                if ($cekdata->num_rows() > 0) {
                    ++$jmlgagal;
                    $json = 'failed';
                } else {
                    $datasimpan = [
                        'username' => $username,
                        'password' => $hash,
                        'nis_siswa' => $nis_siswa                        
                    ];
                    if ($this->db->insert('akun_siswa', $datasimpan)) {                      
                        $json = 'success';
                        ++$jmlsukses;
                    } else {
                        ++$jmlgagal;
                    }
                }
            }
        }
        $jsons = [
            'status' => $json,
            'data_gagal' => "Data siswa gagal : $jmlgagal",
            'data_berhasil' => "Data siswa berhasil : $jmlsukses",

        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($jsons));
    }

    function doimport()
    {
        $jmlsukses = 0;
        $jmlgagal = 0;
        $fileName = $_FILES['importfile']['name'];

        $config['upload_path'] = './asset/fileimport/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('importfile')) {
            $json = 'failed';
        } else {
            $media = $this->upload->data();
            $json = 'success';
            $inputFileName = './asset/fileimport/' . $media['file_name'];

            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray(
                    'A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE
                );

                $nis = $rowData[0][1];
                $nama = $rowData[0][2];
                $jk = $rowData[0][3];
                $tempat_lahir = $rowData[0][4];
                $date = $rowData[0][5];
                $tanggal_lahir = PHPExcel_Style_NumberFormat::toFormattedString($date, "DD/MM/YYYY");
                $alamat = $rowData[0][6];
                $foto_siswa = $rowData[0][7];
                $kendaraan = $rowData[0][8];
                $nomor_pol = $rowData[0][9];
                $jenjang = $rowData[0][10];
                // var_dump($date);
                // die;
                $cekdata = $this->db->get_where('siswa2', ['nomor_induk_siswa' => $nis]);
                if ($cekdata->num_rows() > 0) {
                    ++$jmlgagal;
                    $json = 'failed';
                } else {
                    $datasimpan = [
                        'nomor_induk_siswa' => $nis,
                        'nama_siswa' => $nama,
                        'jk' => $jk,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => htmlspecialchars($tanggal_lahir),
                        'alamat' => htmlspecialchars($alamat),
                        'foto_siswa' => $foto_siswa,
                        'qr_siswa' => $nis . '.png',
                        'tipe_kendaraan' => $kendaraan,
                        'nomor_polisi' => $nomor_pol,
                        'foto_stnk' => '-',
                        'id_jenjang' => $jenjang,
                    ];
                    if ($this->db->insert('siswa2', $datasimpan)) {
                        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
                        $config['cacheable']    = true; //boolean, the default is true
                        $config['cachedir']     = './assets/'; //string, the default is application/cache/
                        $config['errorlog']     = './assets/'; //string, the default is application/logs/
                        $config['imagedir']     = './asset/kartu/qr/'; //direktori penyimpanan qr code
                        $config['quality']      = true; //boolean, the default is true
                        $config['size']         = '1024'; //interger, the default is 1024
                        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                        $this->ciqrcode->initialize($config);

                        $image_name = $nis . '.png'; //buat name dari qr code sesuai dengan nip

                        $params['data'] = base_url('detail_siswa/').$nis; //data yang akan di jadikan QR CODE
                        $params['level'] = 'H'; //H=High
                        $params['size'] = 10;
                        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
                        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
                        $json = 'success';
                        ++$jmlsukses;
                    } else {
                        ++$jmlgagal;
                    }
                }
            }
        }
        $jsons = [
            'status' => $json,
            'data_gagal' => "Data siswa gagal : $jmlgagal",
            'data_berhasil' => "Data siswa berhasil : $jmlsukses",

        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($jsons));
    }
    // AKHIR TAMBAH SISWA

    public function get_data_siswa()
    {
        $hasil = $this->Siswa_model->get_siswa();
        // var_dump($hasil);
        // die;

        $data = [];
        $no = $_POST['start'];
        //pengulangan sesuai tabel yang ingin ditampilkan
        foreach ($hasil as $h) {
            $baris = [];
            $baris[] = ++$no; //nomor ururt
            $baris[] = $h->nis; // nama field yang mau ditampilkan
            $baris[] = $h->nama; // nama field yang mau ditampilkan
            $baris[] = '<div class="text-center">            
            <a class="btn btn-sm btn-success" href="#" title="Print" onclick="byid(' . "'" . $h->id_siswa . "', 'print'" . ')"><i class="fas fa-print"></i></a>
            <a class="btn btn-sm btn-info" href="#" title="Edit" onclick="byid(' . "'" . $h->id_siswa . "', 'edit'" . ')"><i class="fas fa-edit"></i></a>
			<a class="btn btn-sm btn-danger" href="#" title="Hapus" onclick="byid(' . "'" . $h->id_siswa . "', 'hapus'" . ')"><i class="fas fa-trash-alt"></i></a></div>';
            $data[] = $baris;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Siswa_model->count_all(),
            "recordsFiltered" => $this->Siswa_model->count_filter(),
            "data" => $data,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function byid($id)
    {
        $data = $this->Siswa_model->get_by_id($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function print($id)
    {
        $data = $this->Sekolah_model->get_by_id();
        $ids = $data['id_desain'];
        if ($ids == 1) {
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print2', $data);
        } else {
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print2', $data);
        }
    }

    public function print_single($id)
    {
        $data = $this->Sekolah_model->get_by_id();
        $ids = $data['id_desain'];
        if ($ids == 1) {
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print3', $data);
        } else {
            $data['sekolah'] = $this->Sekolah_model->get_by_id();
            $data['s'] = $this->Siswa_model->get_by_id($id);
            $this->load->view('print3', $data);
        }
    }


    public function hapus_data_siswa($id)
    {
        if ($this->Siswa_model->delete_by_id($id) > 0) {
            $output = [
                'success'   => true,
            ];
        } else {
            $output = [
                'success'   => false,
            ];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function edit_data_siswa()
    {
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Kelas tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('id_pk', 'Jurusan', 'required', [
            'required' => 'Jurusan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password tidak boleh kosong!'
        ]);
        $data = [ 'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)), 'id_pk' => htmlspecialchars($this->input->post('id_pk', true)), 'nis' => htmlspecialchars($this->input->post('nis', true)), 'nama' => htmlspecialchars($this->input->post('nama', true)), 'username' => htmlspecialchars($this->input->post('username', true)), 'password' => htmlspecialchars($this->input->post('password', true)), ];
        if ($this->form_validation->run() == FALSE) {
            $output = [
                'error'   => true,
                'id_kelas_error' => form_error('id_kelas'),
                'id_pk_error' => form_error('id_pk'),
                'nama_error' => form_error('nama'),
                'password_error' => form_error('password'),
            ];
        } else {
            if ($this->Siswa_model->update(['id_siswa' => $this->input->post('id_siswa')], $data) > 0) {
                $output = [
                    'success'   => true,
                ];
            } else {
                $output = [
                    'success'   => false,
                ];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
}
