<?php
function LoadCSV($file_path)
{
    $handle = fopen($file_path , 'r');
    if ($handle === false) {
        return NULL;
    }

    $headers = fgetcsv($handle);
    $start_index = array_search("[", $headers);
    $end_index = array_search("]", $headers);

    array_splice($headers , 0 , $start_index + 1  );
    array_splice($headers , $end_index );

    $headers =  array_map('trim' , $headers);

    $data_list = [];
    $index = array_search("id" , $headers);

    while($row = fgetcsv($handle)) {
        array_splice($row , 0 , $start_index + 1);
        array_splice($row , $end_index);
        $row = array_map('trim' , $row);

        $current = array_combine($headers, $row);
        $data_list[] = $current;
    }

    return $data_list;
}
?>
