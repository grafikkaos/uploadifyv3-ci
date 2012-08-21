<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_Upload $upload
 */

class Uploadify_v3 extends CI_Controller
{

    public $view_data = array();
    private $upload_config;

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper(array('url', 'form'));
        $this->load->view('uploadify_v3', $this->view_data);
    }

    public function do_upload()
    {
        $this->load->library('upload');

        $image_upload_folder = FCPATH . '/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp|tiff',
            'max_size'      => 2048,
            'remove_space'  => TRUE,
            'encrypt_name'  => TRUE,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            echo json_encode($upload_error);
        } else {
            $file_info = $this->upload->data();
            echo json_encode($file_info);
        }

    }

}

/* End of file uploadify_v3.php */
/* Location: ./application/controllers/uploadify_v3.php */


