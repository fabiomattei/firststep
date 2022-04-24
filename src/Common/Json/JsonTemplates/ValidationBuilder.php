<?php

/**
 * 
 * Date: 04/08/2018
 * Time: 20:59
 */

namespace Fabiom\UglyDuckling\Common\Json\JsonTemplates;

/**
 * @deprecated
 */
class ValidationBuilder {

    /**
     * @deprecated
     * @param $parameters
     * @return array
     */
	public function getValidationRoules( $parameters ) {
		$rules = array();
        if( is_array($parameters) ) {
            foreach ($parameters as $par) {
                $rules[$par->name] = $par->validation;
            }
        }
		return $rules;
	}

    /**
     * @deprecated
     * @param $parameters
     * @return array
     */
	public function getValidationFilters( array $parameters ) {
		$filters = array();
        if( is_array($parameters) ) {
            foreach ($parameters as $par) {
                $filters[$par->name] = 'trim';
            }
        }
		return $filters;
	}

}
