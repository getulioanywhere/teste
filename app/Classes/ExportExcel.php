<?php

namespace App\Lib\Classes;
use App\Http\Controllers\Api\ReportsController;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */

class ExportExcel {

    protected $configdefault = ' text-align: center; padding-bottom: 15px; ';

    public function exportExcelPrint($array = null, $client = null, $reportType = '', $dates = '') {

        $html = '';
        if ($client !== null) {
            for ($index = 0; $index < count($client); $index++) {
                $clientName = $client[$index]->nome;
                $dadoscliente = ''
                        . ' Cliente: ' . $client[$index]->nome
                        . ' - CNPJ: ' . $client[$index]->CNPJ
                        . ' - E-mail: ' . $client[$index]->email
                        . ' - Telefone: ' . $client[$index]->telefone;
            }
            $html .= '<b>' . $dadoscliente . '</b>';
        }

        $html .= '<table border="1">';

        $html .= '<tr>';
        //$html .= '<td><img src="'. url('public/images/digifile.png').'">></td>';
        $html .= '<td colspan="9" style="' . $this->configdefault . '">';
        $html .= '<h3><b>Relatório de movimentação ' . $reportType . $dates . '<br>Data e hora da impressão ' . date('d-m-Y') . ' às ' . date('H:i:s') . '</b></h3>';
        $html .= '</td>';
        $html .= '</tr>';

        $html .= '<tr>';

        $html .= '<th></th>';
        
        $thTable = $array[0];
        foreach ($thTable as $key => $value) {
            $html .= '<th>' . $key . '</th>';
        }

        $html .= '</tr>';

        $count = 1;
        for ($index = 0; $index < count($array); $index++) {
            $divisor = $index % 2;
            if ($divisor === 0) {
                $style = 'style="background-color: #D3D3D3; ' . $this->configdefault . '"';
            } else {
                $style = 'style="' . $this->configdefault . '"';
            }
            $html .= '<tr>';
            $html .= $this->mount_td($count, $style);

            $trTable = $array[$index];
            foreach ($trTable as $key => $value) {
                $html .= $this->mount_td($value, $style);
            }
            $html .= '</tr>';
            $count++;
        }

        $html .= '</table>';
        $html = utf8_decode($html);
        $this->export($clientName);
        return $html;
    }

    public function export($file) {
        date_default_timezone_set('America/Sao_Paulo');
        $file = $file . '_' . date('d-m-Y-H-i-s') . '.xls';
        //header('Content-Encoding: UTF-8');
        header("Content-type: application/vnd.ms-excel");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=" . $file . "");
        header("Pragma: no-cache");
    }

    protected function mount_td($value, $style) {

        return'<td ' . $style . '>' . ReportsController::convertDate($value) . '<br></td>';
    }

}
