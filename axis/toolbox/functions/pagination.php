<?php

function paginate($data, $showPerPage){
  $return_data = [];

  define('MAX', $showPerPage);                           // show data per page  
  $data_count = count($data);                            // Total data
  $max_page = ceil($data_count / MAX);                   // Total templates
  $now = !isset($_GET['page_id'])? 1: $_GET['page_id'];  // What number?
  $start_no = ($now - 1) * MAX;                          // What number of the array should I get it from?
  $disp_data = array_slice($data, $start_no, MAX, true); // array_slice
  
  $return_data['data']     = $disp_data;
  $return_data['max_page'] = $max_page;

  return $return_data;
}

?>