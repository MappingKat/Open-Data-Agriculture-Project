<?php
/**
 * The parse component includes the functions utilized in the the API to parse HTTP requests and any data required from the DB
 */
class ParserComponent extends Object {
    /*
     * Description: Takes the table and the HTTP URL posted and returns the 
     * parameters in an array
     */
    function queryString($table, $urlParams) {
//        print_r($urlParams);
        $query = "";
        $arrCount = 2;
        if (count($urlParams) > 2) {
            foreach ( $urlParams as $column=>$param) { 
                if ($column != 'ext' && $column != 'url') {
                    $arrCount++;
                    $query .= (($arrCount < count($urlParams) ? ("$table.$column='$param' AND ") :  ("$table.$column='$param'") ));
                }
            }
        }
        return $query;
    }
}

?>
