<?php

namespace App\Classes;

use App\Classes\Functions;
use App\Classes\DataReturn;
use Illuminate\Support\Facades\DB;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */
class DataTables {

    public function mount_data_tables($request, $model = null) {

        $array_teste = array();
        $dados_select = $request;

        if (!is_null($model)) {
            $name_table = $model->getTable();
            $connect = $model->getConnection()->getName();
        }

        if (array_key_exists('table', $dados_select)) {
            $name_table = $dados_select['table'];
        }

        if (array_key_exists('connection', $dados_select)) {
            $connect = $dados_select['connection'];
        }


        $table_filtro = $dados_select['columns'];

        if (isset($dados_select['where']) && !empty($dados_select['where'])) {
            $clasula = ' WHERE ' . $dados_select['where'];
        } else {
            $clasula = '';
        }

        if (isset($dados_select['search_advanced']) && !empty($dados_select['search_advanced']) && $dados_select['search_advanced'] === true) {
            $column = explode(',', $table_filtro);
        } else {
            $column = false;
        }

        if (isset($dados_select['type_advanced']) && !empty($dados_select['type_advanced'])) {
            $type_advanced = $dados_select['type_advanced'];
        } else {
            $type_advanced = false;
        }

        //para show
        if (array_key_exists('route_show', $dados_select)) {
            $path_show = $dados_select['route_show'];
        } else {
            $path_show = false;
        }

        //para delete
        if (array_key_exists('route_delete', $dados_select)) {
            $path_delete = $dados_select['route_delete'];
        } else {
            $path_delete = false;
        }

        //para relatórios
        if (array_key_exists('route_report', $dados_select)) {
            $path_report = false;
        } else {
            $path_report = false;
        }


        $select = "SELECT $table_filtro FROM $name_table $clasula";

        $result = $this->run_query($select, $connect);

        if (count($result) === 0) {
            $qnt_linhas = 0;
            $totalFiltered = 0;
            $dados = $result;
        } else {

            //caso $type_advanced exista e tiver a palavra chave ajax
            if ($type_advanced !== false) {
                return $result;
            }
            //pega os nome das colunas automático
            $columns = array();
            $colum = array();
            foreach ($result as $keyA => $valueA) {
                if ($keyA === 0) {
                    foreach ($valueA as $keyB => $valueB) {
                        array_push($columns, $keyB);
                        array_push($colum, $keyB);
                    }
                }
            }
            //Obtendo registros de número total sem qualquer pesquisa
            $qnt_linhas = count($result);

            //Receber a requisão da pesquisa 
            //===================begin funções============================================

            function select_like($colum, $dados_select, $name_table, $clasula) {
                if ($clasula !== '') {
                    $ret = ' AND (';
                } else {
                    $ret = ' WHERE (';
                }

                foreach ($colum as $keyA => $valueA) {
                    if ($keyA === 0) {
                        $ret .= $valueA . " LIKE '" . $dados_select['search']['value'] . "%' ";
                    } else {
                        $ret .= " OR " . $valueA . " LIKE '" . $dados_select['search']['value'] . "%' ";
                    }
                }
                $ret .= ')';

                return $ret;
            }

            function select_order($columns, $dados_select, $totalFiltered, $connect) {

                if ($columns && $dados_select) {
                    $ret = ' ORDER BY ';
                    foreach ($columns as $keyA => $valueA) {
                        if (isset($dados_select['order'][$keyA])) {
                            if (isset($columns[$dados_select['order'][$keyA]['column']])) {
                                $ret .= $columns[$dados_select['order'][$keyA]['column']] . ' ';
                            }

                            if (isset($dados_select['order'][$keyA]['dir'])) {
                                $ret .= $dados_select['order'][$keyA]['dir'] . ' ';
                            } else {
                                
                            }
                        }
                    }
                    if ($connect === 'sqlsrv') {
                        if (isset($dados_select['start']) && $dados_select['length'] != -1) {
                            $ret .= " OFFSET " . intval($dados_select['start']) . " ROWS FETCH NEXT " . intval($dados_select['length']) . " ROWS ONLY";
                        }
                    } else {
                        $ret .= ' LIMIT ' . $dados_select['start'] . ',' . $dados_select['length'] . '   ';
                    }
                }

                return $ret;
            }

            $clasula_request = '';
            $clasula_req = '';

            if (!empty($dados_select['search']['value'])) {
                if ($column !== false) {
                    $col = $column;
                } else {
                    $col = $columns;
                }
                $clasula_request .= select_like($col, $dados_select, $name_table, $clasula);
            }

            $select .= $clasula_request;
            $totalFiltered = count($this->run_query($select, $connect));

            if ($dados_select) {
                $clasula_req = select_order($columns, $dados_select, $totalFiltered, $connect);
            }
            $select .= $clasula_req;
            $result_req = $this->run_query($select, $connect);
            $total_req = count($result_req);

            function reports_print($path_report, $id) {
                if ($path_report !== false) {
                    return '<a href="' . route($path_report, $id) . '">'
                            . '<img src="' . asset('images/layout/old-versions.png') . '" title="Cadastrar Novo">'
                            . '</a>';
                }
            }

            function mount_url_show($url) {
                if ($url !== false) {
                    $ico = asset('img/icons/Pencil3.ico');
                    return '<a href="' . $url . '">'
                            . '<link rel="preload" href="' . $ico . '" as="image">'
                            . '<img style="height:30px; width:30px;" class="img-fluid" src="' . $ico . '" '
                            . 'title="Editar">'
                            . '</a>';
                }
            }

            function mount_url_delete($url, $id) {
                if ($url !== false) {

                    return mount_form_modal_confirm($id, $url);

                    /* $ico = asset('img/icons/deletar.ico');
                      return '<a href="' . $url . '">'
                      . '<link rel="preload" href="' . $ico . '" as="image">'
                      . '<img style="height:30px; width:30px;" class="img-fluid" src="' . $ico . '" '
                      . 'title="Deletear">'
                      . '</a>'; */
                }
            }

            function mount_form_modal_confirm($id, $url) {
                $ico = asset('img/icons/deletar.ico');
                $html = '<form 
                    action="' . $url . '" 
                    method="POST" 
                    id="formid-' . Functions::generateRandomString(['specialChars' => false, 'qtyCaraceters' => 20]) . '" 
                    name="formname">';
                $html .= csrf_field();
                $html .= method_field('POST');
                $html .= '<link rel="preload" href="' . $ico . '" as="image">';
                $html .= '<button data-toggle="modal" 
                                        data-target="#modal-confirm-save' . $id . '"
                                        name="btn-click-destroy" 
                                        type="button" style="border: none; background: transparent;">
                                    <img style="height:30px; width:30px;" class="img-fluid" src="' . $ico . '" title="Deletar">
                                </button>';
                $html .= '<div class="modal fade" id="modal-confirm-save' . $id . '">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            ' . \Lang::get('modal.modal-confirm.title-confirm') . '
                                        </h4>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            ' . \Lang::get('modal.modal-confirm.question-confirm') . '
                                        </p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            ' . \Lang::get('modal.modal-confirm.close-confirm') . ' 
                                        </button>
                                        <label id="process-info" style="display: none;">
                                            ' . \Lang::get('modal.modal-confirm.process-confirm') . '
                                        </label>
                                        <button name="btn-click" type="submit" class="btn btn-primary" >
                                            ' . \Lang::get('modal.modal-confirm.btn-confirm') . '
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>';

                $html .= '</form>';
                return $html;
            }          

            $dados = array();

            for ($index = 0; $index < count($result_req); $index++) {
                $array_aux = [];

                $toarray = (array) $result_req[$index];
                $id = reset($toarray);
                $id_encrypt = @encrypt($id);
                foreach ($result_req[$index] as $key => $value) {

                    $value = Functions::convertDate($value);

                    array_push($array_aux, $value);
                }
                if ($path_report !== false) {

                    array_push($array_aux, reports_print($path_report, $id));
                }

                if ($path_show !== false) {
                    array_push($array_aux, mount_url_show(DataReturn::mount_route($path_show, $id)));
                }

                if ($path_delete !== false) {
                    array_push($array_aux, mount_url_delete(DataReturn::mount_route($path_delete, $id), $id_encrypt));
                }
                
                $dados[] = $array_aux;
            }
        }       


        $json_data = array(
            "draw" => intval($dados_select['draw']), //para cada requisição é enviado um número como parâmetro
            "recordsTotal" => intval($qnt_linhas), //Quantidade de registros que há no banco de dados
            "recordsFiltered" => intval($totalFiltered), //Total de registros quando houver pesquisa
            "data" => $dados   //Array de dados completo dos dados retornados da tabela 
        );
        return json_encode($json_data);
    }

    public function run_query($query, $connect) {
        return DB::connection($connect)->select($query);
    }

}
