<?php
namespace App\Helpers;
class Filter
{


    protected $uniqueGridId					= null;

    protected $saveFiltersToSession			= false;

    protected $filtersToStore				= array();




    public function setUniqueGridId( $gridId ) {
        $this->uniqueGridId				= $gridId;
        $this->saveFiltersToSession		= true;
    }

    /**
     * Sortierung ändern
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param $sorting
     * @param $fallback
     *@since
     */
    public function getOrderBy( $sorting, $fallback ) {
        if( is_array( $sorting ) == true && empty( $sorting ) == false ) {
            $fallback			= ' ORDER BY ' . $sorting['table'] . '.' . $sorting['field'] . ' ' . $sorting['direction'];
            if( $this->saveFiltersToSession == true ) {
                Grid::addSort( $sorting['table'], $sorting['field'], $sorting['direction'] );
            }
        }



        return $fallback;
    }



    /**
     * Create SQL for grid
     *
     * @author manuel.schaefer

     * @param $sql, initial query
     * @param array $arrFilters, filters
     * @param $order, order of the query
     * @return array $arrReturn
     */
    public function getStatement( $sql, $arrFilters, $order ):array {
        $where			= ' WHERE 1';
        $arrBindings	= array();
        if ( is_array( $arrFilters ) == true ) {
            $counter 	= 1;
            foreach( $arrFilters as $filter ) {
                if ( $filter->value != '') {
                    $binding = ':filter' . $counter;
                    $where .= ' AND `' . $filter->table . '`.`' . $filter->field . '`';

                    if( $this->saveFiltersToSession == true ) {
                        $key		= Grid::getFilterKey( $filter->table, $filter->field );
                        $this->filtersToStore[ $key ]		= $filter->value;
                    }


                    if ($filter->operator == 'equalsorlike') {
                        if (strstr($filter->value, '%') !== false) {
                            $where .= ' LIKE ' . $binding;
                        }
                        else {
                            $where .= ' = ' . $binding;
                        }


                    }

                    $arrBindings[$binding] = $filter->value;

                    $counter++;
                }
            }
        }

        if( $this->saveFiltersToSession == true ) {
            Grid::addFilters( $this->filtersToStore );
        }

        if( empty( $this->systemIds ) == false ) {
            $where		.= ' AND ' . $this->systemTable . '.`'.$this->systemField.'` IN('.implode(',', $this->systemIds).')';
        }

        $arrReturn		= array();
        $arrReturn['bindings']		= $arrBindings;
        $arrReturn['where']			= $where;
        $arrReturn['sql']			= $sql . $where . $order;;
        return $arrReturn;
    }




    /**
     * Create values for paging
     *
     * @author Manuel Schäfer <mschaefer1982@gmx.de>
     * @param array $records ,all records
     * @param $currentPage , current page
     * @param $itemsPerPage , elements per page
     * @return array,resultset
      */
    public function slice( array $records, $currentPage, $itemsPerPage):array
    {
        if ($currentPage == 1 || $currentPage == 0) {
            $start = 0;
        } else {
            $start = ($currentPage - 1) * $itemsPerPage;
        }

        $arrIds = array_slice($records, $start, $itemsPerPage);


        return $arrIds;
    }


    /**
     * obsolet
     */
    public static function getSortFilter($arrParams, $field, $direction)
    {
        if (isset($arrParams['field']) == true) {
            unset($arrParams['field']);
        }

        if (isset($arrParams['sort']) == true) {
            unset($arrParams['sort']);
        }

        if ($field != '' && $direction != '') {
            $arrParams['field'] = $field;
            $arrParams['sort'] = $direction;
        }


        $categoryUrl = self::getCategoryUrl($arrParams);
        unset($arrParams[$categoryUrl]);
        $append = http_build_query($arrParams);
        if ($append != '') {
            $categoryUrl .= '?' . $append;
        }
        return $categoryUrl;


    }

    /**
     * obsolet
     */
    public static function removeFilteritem($arrParams, $filter)
    {
        $categoryUrl = self::getCategoryUrl($arrParams);
        unset($arrParams[$categoryUrl]);
        unset($arrParams[$filter['attribute_code']]);
        $append = http_build_query($arrParams);

        if ($append != '') {
            $categoryUrl .= '?' . $append;
        }


        return $categoryUrl;
    }


}
