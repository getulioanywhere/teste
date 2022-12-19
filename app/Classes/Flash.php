<?php

function flash_success($message = null) {
    $message = $message ?: 'Sucesso!';
    session()->flash('flash', [
        'type' => 'success',
        'message' => $message,
    ]);
}

function flash_warning($message = null) {
    $message = $message ?: 'Algo necessita de atenção.';
    session()->flash('flash', [
        'type' => 'warning',
        'message' => $message,
    ]);
}

function flash_info($message = null) {
    $message = $message ?: '...';
    session()->flash('flash', [
        'type' => 'info',
        'message' => $message,
    ]);
}

function flash_error($message = null) {
    $message = $message ?: 'Ocorreu um erro.';
    session()->flash('flash', [
        'type' => 'error',
        'message' => $message,
    ]);
}

function flash_question($message = null) {
    $message = $message ?: '...?';
    session()->flash('flash', [
        'type' => 'question',
        'message' => $message,
    ]);
}