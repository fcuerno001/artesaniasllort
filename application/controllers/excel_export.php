<?php

class Excel_export extends My_Controller {

    function index() {
        $this->load->model("excel_export_model");
        $data["catalogo_data"] = $this->excel_export_model->fetch_data();
        $this->load->view("catalogo_view", $data);
    }

    function action() {
        $this->load->model("excel_export_model");
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("Codigo", "Nombre Arte", "Descripcion Arte", "Precio ", "Imagen");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }//Fin for_each

        $catalogo_data = $this->excel_export_model->fetch_data();
        $excel_row = 2;
        
        $fila = 2;
        foreach ($catalogo_data as $row) {
            $objDrawing = new PHPExcel_Worksheet_Drawing();  
            $objDrawing->setName('Customer Signature');
            $objDrawing->setPath('./upload/'.$row->imagen_arte);
            $objDrawing->setWidth(150);                 //set width, height
            $objDrawing->setHeight(150);
            $objDrawing->setOffsetX(5);                       //setOffsetX works properly
            $objDrawing->setOffsetY(5); 
            $objDrawing->setResizeProportional(TRUE);
            $objDrawing->setWorksheet($object->getActiveSheet());
            $objDrawing->setCoordinates('E'.$excel_row);
            
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->codigo_arte);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nombre_arte);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->descripcion_arte);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->precio_arte);
            //$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->imagen_arte);
            $object->getActiveSheet()->getRowDimension($fila)->setRowHeight(120);
            $excel_row++;
            $fila++;
            $objDrawing = NULL;
            
        }//Fin for_each

        
        foreach (range('A', 'D') as $col) {
            
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(TRUE);
        }//Fin foreach
        
        $style = array(
            'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        
        $object->getDefaultStyle()->applyFromArray($style);
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Reporte Artes.xlsx"');
        $object_writer->save('php://output');
   
    }//Fin Action

} //Fin Controller






