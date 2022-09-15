<?php

function active_class($path, $active = 'active') {
    $path = array_map(
        function ($value) { return preg_replace('/^\//', '', $value); },
        $path
    );

  return call_user_func_array('Request::is', $path) ? $active : '';
}

function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

function show_class($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}
