<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('catalogo_model', 'catalogos');
    }

    public function index() {
        $this->load->helper('url');
        $this->load->view('catalogo_view');
    }

    public function ajax_list() {
        $this->load->helper('url');

        $list = $this->catalogos->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $catalogos) {
            $no++;
            $row = array();
            $row[] = $catalogos->codigo_arte;
            $row[] = $catalogos->nombre_arte;
            $row[] = $catalogos->descripcion_arte;
            $row[] = $catalogos->precio_arte;
            if ($catalogos->imagen_arte)
                $row[] = '<a href=" ' . base_url('upload/' . $catalogos->imagen_arte) . '"><img src="' . base_url('upload/' . $catalogos->imagen_arte) . '" class="img-responsive" /></a>';
            else
                $row[] = '(No photo)';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_arte(' . "'" . $catalogos->id_catalogo . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_arte(' . "'" . $catalogos->id_catalogo . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->catalogos->count_all(),
            "recordsFiltered" => $this->catalogos->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->catalogos->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();

        $data = array(
            'codigo_arte' => $this->input->post('codigo'),
            'nombre_arte' => $this->input->post('nombre'),
            'descripcion_arte' => $this->input->post('descripcion'),
            'precio_arte' => $this->input->post('precio'),
        );

        if (!empty($_FILES['imagen']['name'])) {
            $upload = $this->_do_upload();
            $data['imagen_arte'] = $upload;
        }

        $insert = $this->catalogos->create($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $response = array('status' => FALSE, 'msg' => ''); // representa la salida de informacion
        $this->_validate();
        
        /*
         * La siguiente variable observa si se a chequeado la opcion de eliminar
         * imagen, de lo contrario no llevara a cabo ninguna opcion, solo la de 
         * actualizar los demas campos
         */
        $isRemoveImage = ($this->input->post('remove_photo') != FALSE) ? TRUE : FALSE;
        
        /*
         * Es mejor tener el ID desde un inicio y hacerlo mas leible ante todo
         * el codigo fuente, que sea mas como una poesia, es la diferencia 
         * entre un programador y un desarrollador
         */
        $idCatalogo = $this->input->post('id');
        
        $data = array(
            'codigo_arte' => $this->input->post('codigo'),
            'nombre_arte' => $this->input->post('nombre'),
            'descripcion_arte' => $this->input->post('descripcion'),
            'precio_arte' => $this->input->post('precio')
        );
        
        
        //obtenemos el catalogo para obtener el nombre de la imagen a actualizar
        $catalogos = $this->catalogos->get_by_id($idCatalogo);

        if($isRemoveImage) {
            $imageToDelete = $catalogos->imagen_arte;
            $msgDeleteImagen = '';
            
            
            /*
             * Chequeamos si existe archivo para re-emplazar la imagen en 
             * nuestro servidor y en nuestra base de datos, de lo contrario no
             * hacemos nada con respecto a la imagen
             */
            if (!empty($_FILES['imagen']['name'])) {
                $upload = $this->_do_upload();
                $data['imagen_arte'] = $upload;
                $response['msg'] = 'Se a reemplazado la imagen :'.$upload;
                               
                /*
                 * Con respecto a la eliminacion del archivo, lo hacemos solo si
                 * la otra imagen fue subida correctamente, sino se elimina 
                 * luego se podria hacer un crontab para que revise la DB y
                 * si no esta ahi es un archivo que se puede eliminar, aunque 
                 * eso es ya un trabajo aparte y fuera de esta ayuda
                 */
                if (file_exists('upload/' . $imageToDelete)) {
                    if(unlink('upload/' . $imageToDelete)){
                        $msgDeleteImagen .= 'Se a eliminado la imagen, ';
                    } else{
                        $msgDeleteImagen .= 'No se a eliminado el archivo del servidor, ';
                    }
                } else {
                    $msgDeleteImagen .= 'No existe archivo en el servidor, ';
                }
                
                $response['msg'] = $msgDeleteImagen.$response['msg'];
            } else {
                $response['msg'] = 'No hay imagen para reemplazar, no se realizaran cambios en la imagen';
            }
        } else {
            $response['msg'] = 'No se haran cambios sobre la imagen';
        }
        $response['status'] = TRUE; // se declara TRUE porque no quise tocar tu modelo
        $response['resultado'] = $this->catalogos->update($idCatalogo, $data);
        echo json_encode($response);
    }

    public function ajax_delete($id) {
        //delete file
        $catalogos = $this->catalogos->get_by_id($id);
        if (file_exists('upload/' . $catalogos->imagen_arte) && $catalogos->imagen_arte)
            unlink('upload/' . $catalogos->imagen_arte);

        $this->catalogos->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload() {
        $config['upload_path'] = 'upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100; //set max size allowed in Kilobyte
        $config['max_width'] = 1000; // set max width image allowed
        $config['max_height'] = 1000; // set max height allowed
        $config['file_name'] = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagen')) { //upload and validate
            $data['inputerror'][] = 'imagen';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('codigo') == '') {
            $data['inputerror'][] = 'codigo';
            $data['error_string'][] = 'codigo es requerido';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nombre') == '') {
            $data['inputerror'][] = 'nombre';
            $data['error_string'][] = 'nombre es requerido';
            $data['status'] = FALSE;
        }


        if ($this->input->post('descripcion') == '') {
            $data['inputerror'][] = 'descripcion';
            $data['error_string'][] = 'descripcion es requerido';
            $data['status'] = FALSE;
        }

        if ($this->input->post('precio') == '') {
            $data['inputerror'][] = 'precio';
            $data['error_string'][] = 'precio es requerido';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
