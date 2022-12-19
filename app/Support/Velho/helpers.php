<?php

use Carbon\Carbon;

function to_json($response, $code = 200)
{
    return response()
        ->json($response, $code);
}

function nestable($nodes, $options = [])
{
    $route = $options['route'] ?? 'menu';

    $recursive = function ($items) use (&$recursive, $options, $route) {
        if (!$items->count()) {
            return;
        }

        $html = '<ol class="dd-list">';
        foreach ($items as $item) {
            $html .= '
            <li class="dd-item dd3-item" data-id="' . $item->id . '">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">' . $item->{$options['key'] ?? 'title'} . '</div>
                <div class="actions">
                    <a data-ajax class="btn btn-sm btn-default" href="' . route($route . '.edit', $item->id) . '">' . trans('actions.edit') . '</a>
                    <form action="' . route($route . '.destroy', $item->id) . '" class="dd-delete" method="POST">'.method_field('delete').csrf_field().'
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>';
            if ($item->children) {
                $html .= $recursive($item->children);
            }
            $html .= '</li>';
        }
        $html .= '</ol>';

        return $html;
    };

    $html = '<div class="dd" data-nestable data-update-url="' . route($route . '.reorder') . '">';
    $html .= $recursive($nodes);
    $html .= '</div>';

    return $html;
}

function locale_to_code($code)
{
    $countryList = array(
        'pt-BR' => 'br',
        'en' => 'us',
        'es' => 'es',
    );

    if (!isset($countryList[$code])) {
        return $code;
    } else {
        return $countryList[$code];
    }
}

function warning($message, $url = null, $ajax = false)
{
    if ($message instanceof \Exception) {
        $message = $message->getMessage();
    }

    \Flash::warning($message);

    if ($url) {
        if ($ajax && request()->ajax()) {
            return to_json([
                'success' => true,
                'url' => $url,
            ]);
        }

        return redirect($url)->withInput();
    }
}

function error($message, $url = null, $ajax = false)
{
    if ($message instanceof \Exception) {
        $message = $message->getMessage();
    }

    \Flash::error($message);

    if ($url) {
        if ($ajax && request()->ajax()) {
            return to_json([
                'success' => true,
                'url' => $url,
            ]);
        }

        return redirect($url)->withInput();
    }
}

function success($message, $url = null, $ajax = false)
{
    \Flash::success($message);

    if ($url) {
        if ($ajax && request()->ajax()) {
            return to_json([
                'success' => true,
                'url' => $url,
            ]);
        }

        return redirect($url);
    }
}

function to_float($money)
{
    if (!$money) {
        return null;
    }

    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);

    return (float) str_replace(',', '.', $removedThousandSeparator);
}

function whatsapp($number)
{
    $number = str_replace(['(', ')', ' ', '-'], '', $number);
    return 'https://api.whatsapp.com/send?phone=55' . $number;
}

function phone($number)
{
    $number = str_replace(['(', ')', ' ', '-'], '', $number);
    return 'tel:' . $number;
}

function email($email)
{
    return 'mailto:' . $email;
}

function currency($number)
{
    return 'R$ ' . number_format($number, 2, ',', '.');
}

function states()
{
    return \App\Models\State::orderBy('title')->get();
}

function parse_date($complete)
{
    $date = trim($complete);
    $hour = null;
    if (strpos($date, ' ') !== false) {
        list($date, $hour) = explode(' ', $date);
    }

    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
        return $date . ($hour !== null ? ' ' . $hour : '');
    }

    $parse = DateTime::createFromFormat(trans('admin.locale.' . ($hour !== null ? 'datetime' : 'date')), $complete);
    return $parse->format('Y-m-d') . ($hour !== null ? ' ' . $hour : '');
}

function month($month)
{
    return trans('web.months.' . ltrim($month, 0));
}

function pagseguro_statuses()
{
    return [
        1 => 'Aguardando pagamento',
        2 => 'Em análise',
        3 => 'Paga',
        4 => 'Disponível',
        5 => 'Em disputa',
        6 => 'Devolvida',
        7 => 'Cancelada',
    ];
}

function pagseguro_status($code)
{
    $statuses = pagseguro_statuses();

    if (isset($statuses[$code])) {
        return $statuses[$code];
    }

    return '';
}

function pageBlocksTypes($type = null)
{
    $types = [
        'default' => 'Bloco padrão',
        // 'blockList' => 'Bloco em lista',
        'mediaLeft' => 'Mídias sempre à esquerda',
        'mediaRight' => 'Mídias sempre à direita',
        'mediaFluid' => 'Mídias com largura total',
        // 'only_text' => 'Somente Texto',
    ];
    return $type ? $types[$type] : $types;
}

function generateRandomString($length = 8, $onlyNumbers = false, $onlyCapital = false, $specialChars = true)
{
    $smallLetters = $onlyCapital || $onlyNumbers ? '' : str_shuffle('abcdefghijklmnopqrstuvwxyz');
    $capitalLetters = $onlyNumbers ? '' : str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;
    $specialCharacters = $specialChars && !$onlyNumbers ? str_shuffle('!@#$%*-') : '';
    $characters = $capitalLetters . $smallLetters . $numbers . $specialCharacters;
    $randomString = substr(str_shuffle($characters), 0, $length);
    return $randomString;
}

/**
 * Retorna o tempo passado de uma data até agora de maneira user friendly.
 * Automaticamente alterna entre anos, meses, dias, hora, minutos e segundos.
 *
 * @param string $date Data inicial
 * @param bool $usePrefix Flag para retornar já com prefixo ou não (<Há> tanto tempo)
 * @param string $prefix Prefixo a ser usado. Por padrão: "Há".
 * @return string Tempo passado
 */
function timePassedSince($date, $usePrefix = false, $prefix = 'Há')
{
    $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    $endDate = Carbon::now();
    $time = null;

    if ($diff = $startDate->diffInYears($endDate)) {
        $time = $diff . ' ano' . ($diff > 1 ? 's' : '');
    } else if ($diff = $startDate->diffInMonths($endDate)) {
        $time = $diff . ($diff <= 1 ? ' mês' : ' meses');
    } else if ($diff = $startDate->diffInDays($endDate)) {
        $time = $diff . ' dia' . ($diff > 1 ? 's' : '');
    } else if ($diff = $startDate->diffInHours($endDate)) {
        $time = $diff . ' hora' . ($diff > 1 ? 's' : '');
    } else if ($diff = $startDate->diffInMinutes($endDate)) {
        $time = $diff . ' minuto' . ($diff > 1 ? 's' : '');
    } else if ($diff = $startDate->diffInSeconds($endDate)) {
        $time = $diff . ' segundo' . ($diff > 1 ? 's' : '');
    } else {
        $usePrefix = false;
        $time = 'agora';
    }
    return $time ? ($usePrefix ? "$prefix " : '') . $time : '';
}

/**
 * Retorna o tempo passado de uma data até agora formatada da seguinte forma:
 * X anos, X meses, X dias, X minutos e X segundos.
 * 
 * Ignora automaticamente zeros à esquerda.
 *
 * @param string $date Data inicial
 */
function timePassedSinceComplete($date)
{
    $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    $endDate = Carbon::now();
    $startedToMount = false;
    $time = '';

    $d_y = $startDate->diffInYears($endDate);
    $d_m = $startDate->copy()->addYears($d_y)->diffInMonths($endDate);
    $d_d = $startDate->copy()->addYears($d_y)->addMonths($d_m)->diffInDays($endDate);
    $d_h = $startDate->copy()->addYears($d_y)->addMonths($d_m)->addDays($d_d)->diffInHours($endDate);
    $d_i = $startDate->copy()->addYears($d_y)->addMonths($d_m)->addDays($d_d)->addHours($d_h)->diffInMinutes($endDate);
    $d_s = $startDate->copy()->addYears($d_y)->addMonths($d_m)->addDays($d_d)->addHours($d_h)->addMinutes($d_i)->diffInSeconds($endDate);

    $diff = [
        ['value' => $d_y, 'singular' => 'ano', 'plural' => 'anos'],
        ['value' => $d_m, 'singular' => 'mês', 'plural' => 'meses'],
        ['value' => $d_d, 'singular' => 'dia', 'plural' => 'dias'],
        ['value' => $d_h, 'singular' => 'hora', 'plural' => 'horas'],
        ['value' => $d_i, 'singular' => 'minuto', 'plural' => 'minutos'],
        ['value' => $d_s, 'singular' => 'segundo', 'plural' => 'segundos'],
    ];
    foreach ($diff as $key => $item) {
        $last = $key === count($diff)-1;
        $pre_last = $key === count($diff)-2;

        if (!$startedToMount && $item['value'] === 0) {
            continue;
        } else {
            $and = $last && $startedToMount ? ' e' : '';
            $comma = !$last && !$pre_last ? ', ' : '';
            $label = $item['value'] > 1 || $item['value'] === 0 ? $item['plural'] : $item['singular'];
            $time .= sprintf('%s %d %s%s', $and, $item['value'], $label, $comma);
            $startedToMount = true;
        }
    }
    return trim($time) ?: '-';
}

/**
 * Shorthand para exibir uma system message
 */
function message($key)
{
    return config('message.' . $key);
}

/**
 * Shorthand para gravar um log de debug
 */
function log_bobagem(string $message)
{
    \Log::build([
        'driver' => 'single',
        'path' => storage_path('logs/bobagem.log'),
    ])->info($message);
}

/**
 * Coloca todas as palavras necessárias com primeira letra em maiúsculo
 */
function toTitleCase(string $str)
{
    $lowerThis = ['Do', 'Dos', 'Da', 'Das', 'De', 'Com', 'A', 'O', 'E'];
    $strTitleCase = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    $exploded = explode(' ', $strTitleCase);
    $output = '';
    foreach ($exploded as $key => $word) {
        if ($key > 0 && in_array($word, $lowerThis)) {
            $word = mb_strtolower($word);
        }
        $output .= $word.' ';
    }
    return trim($output);
}

function statusCheck($item)
{
    $state = (object) $item['state'];
    
    $value = 0;
    collect($state)->each(function ($item) use (&$value) {
        if($item == 1) $value += $item;
    });

    return $value;
}