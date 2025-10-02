<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('pdf_create'))
{
    function pdf_create($html, $config = array())
    {
        $defaults = array('output_type' => 'stream', 'filename' => microtime(TRUE) . '.pdf', 'upload_dir' => FCPATH.'uploads\pdf\\', 'load_html' => TRUE, 'html_encoding' => '', 'load_html_file' => FALSE, 'output_compression' => 1, 'set_base_path' => FALSE, 'set_paper' => FALSE, 'paper_size' => 'letter', 'paper_orientation' => 'portrait', 'stream_compression' => 1, 'stream_attachment' => 1);
        /*Set options from defaults and incoming config array*/
        $options = array_merge($defaults, $config);
        /*Remove any previously created headers*/
        if (is_php('5.3.0') && $options['output_type'] == 'stream') {
            header_remove();
        }
        /*Load dompdf*/
      require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
        /*Create a dompdf object*/
        $dompdf = new DOMPDF();
        /*Set supplied base path*/
        if ($options['set_base_path'] !== FALSE) {
            $dompdf->set_base_path($options['set_base_path']);
        }
        /*Set supplied paper*/
        if ($options['set_paper'] !== FALSE) {
            $dompdf->set_paper($options['paper_size'], $options['paper_orientation']);
        }
        /*Load the HTML that will be turned into a PDF*/
        if ($options['load_html_file'] !== FALSE) {
            /*Loads an HTML file*/
            $dompdf->load_html_file($html);
        } else {
            /*Loads an HTML string*/
            $dompdf->load_html($html, $options['html_encoding']);
        }
        /*Create the PDF*/
        $dompdf->render();
        /*If destination is the browser*/
        if ($options['output_type'] == 'stream') {
              $CI =& get_instance();
                /*Create upload directories if they don't exist*/
                if (!is_dir($options['upload_path'])) {
                    mkdir($options['upload_path'], 0777, TRUE);
                }
                /*Load the CI file helper*/
                $CI->load->helper('file');
                /*Save the file*/
                write_file($options['upload_path'] . $options['filename'], $dompdf->output());
            /*$dompdf->stream($options['filename'], array('compress' => $options['stream_compression'], 'Attachment' => $options['stream_attachment']));*/
        } else {
            if ($options['output_type'] == 'string') {
                return $dompdf->output($options['output_compression']);
            } else {
                /*Get an instance of CI*/
                $CI =& get_instance();
                /*Create upload directories if they don't exist*/
                if (!is_dir($options['upload_path'])) {
                    mkdir($options['upload_path'], 0777, TRUE);
                }
                /*Load the CI file helper*/
                $CI->load->helper('file');
                /*Save the file*/
                write_file($options['upload_path'] . $options['filename'], $dompdf->output());
            }
        }
    }
}
?>