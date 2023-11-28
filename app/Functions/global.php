<?php
/**
 * Get the current path to the active coreui installation
 *
 * @author Manuel Schäfer <mschaefer1982@gmx.de>
 * @return string
 */
function get_core_ui_path() {
    return '/coreui/' . config('view.core_ui_version') . '/dist/';
}


/**
 * get the version for caching js/css in browser
 *
 * @author Manuel Schäfer <mschaefer1982@gmx.de>
 * @return string, when in dev mode, return current timestamp, so JS/CSS is not cached in browser, on live return version of ticketmine
 */
function get_version() {
    if (app()->isLocal()) {
        return time();
    }
    return config('app.version');
}


/**
 * Move array to defined number of array
 *
 * @author Manuel Schäfer <mschaefer1982@gmx.de>
 * @param array $list
 * @param int $elements
 * @return array $partition
 */
function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}



/**
 * Move an collection/array to an identifier
 *
 * @author Manuel Schäfer <mschaefer1982@gmx.de>
 * @param $data, array or colletion
 * @param $field, field to group the array/collection
 * @return array $arrResult, result of the grouping
 */
function index_by( $data, $field ) {
    $arrResult      = array();
    if( $data != null ) {
        $dataType = get_data_type($data);
        foreach ($data as $item) {
            if ($dataType != null) {
                if ($dataType == 'array') {
                    $arrResult[$item[$field]] = $item;
                } else {
                    $arrResult[$item->$field] = $item;
                }
            }
        }
    }

    return $arrResult;
}



/**
 * returns only the values of an field/key from an collection or an array
 * e.g. get all ids out of an array
 *
 * @author Manuel Schäfer <mschaefer1982@gmx.de>
 * @param $data, array or collection
 * @param $field, the field where to collect the values
 * @param $unique, unique the values, by default: yes
 * @return array $arrResult, array with the result
 */
function get_ids( $data, $field, $unique = true ) {

    $arrResult          = array();
    $dataType           = get_data_type( $data );
    foreach( $data as $item ) {
        if( $dataType   == 'array' && $unique == true ) {
            $arrResult[ $item[ $field ] ]       = $item[ $field ];
        }
        else if( $dataType   == 'array' && $unique == false ) {
            $arrResult[]                        = $item[ $field ];
        }
        else if( $dataType   == 'object' && $unique == true ) {
            $arrResult[ $item->$field ]       = $item->$field;
        }
        else {
            $arrResult[]                        = $item->$field;
        }
    }

    return $arrResult;
}


/**
 * Checks if the row is an object or an array
 *
 * @author Manuel Schäfer <mschaefer1982@gmx.de>
 * @param $data
 * @return string $dataType, array or object
 */
function get_data_type( $data ) {
    $dataType           = null;
    if( $data != null ) {
        foreach ($data as $item) {
            if ($dataType === null) {
                $dataType = 'array';
                if (is_object($item)) {
                    $dataType = 'object';
                }
                break;
            }
        }
    }
    return $dataType;
}
