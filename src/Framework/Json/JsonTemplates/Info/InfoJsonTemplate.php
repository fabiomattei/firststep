<?php

namespace Fabiom\UglyDuckling\Framework\Json\JsonTemplates\Info;

use Fabiom\UglyDuckling\Framework\Blocks\BaseHTMLInfo;
use Fabiom\UglyDuckling\Framework\Json\JsonTemplates\JsonTemplate;

/**
 * User: Fabio Mattei
 * Date: 13/07/18
 * Time: 18.15
 */
class InfoJsonTemplate extends JsonTemplate {

    const blocktype = 'info';

    public function createInfo() {
        $dbconnection = $this->pageStatus->getDbconnection();
        $htmlTemplateLoader = $this->applicationBuilder->getHtmlTemplateLoader();
        $queryExecutor = $this->pageStatus->getQueryExecutor();

        // If there are dummy data they take precedence in order to fill the info box
        if ( isset($this->resource->get->dummydata) ) {
            $entity = $this->resource->get->dummydata;
        } else {
            // If there is a query I look for data to fill the info box,
            // if there is not query I do not
            if ( isset($this->resource->get->query) AND isset($dbconnection) ) {
                $queryExecutor->setResourceName( $this->resource->name ?? 'undefined ');
                $queryExecutor->setQueryStructure( $this->resource->get->query );

                $result = $queryExecutor->executeSql();
                $entity = $result->fetch();
            } else {
                $entity = new \stdClass();
            }
        }

        $this->pageStatus->setLastEntity($entity);

		$infoBlock = new BaseHTMLInfo;
        $infoBlock->setHtmlTemplateLoader( $htmlTemplateLoader );
		$infoBlock->setTitle($this->resource->get->info->title ?? '');
		$fieldRows = array();
		
		foreach ($this->resource->get->info->fields as $field) {
			if( !array_key_exists(($field->row ?? 1), $fieldRows) ) $fieldRows[$field->row] = array();
			$fieldRows[($field->row ?? 1)][] = $field;
		}
		
        $rowcounter = 1;
		foreach ($fieldRows as $row) {
			$infoBlock->addRow();
			foreach ($row as $field) {
                $value = $this->pageStatus->getValue($field);
                if ($field->type === 'textfield') {
                    $infoBlock->addTextField($field->label, $value, $field->width ?? '', $field->cssclass ?? '');
                }
                if ($field->type === 'textarea') {
                    $infoBlock->addTextAreaField($field->label, $value, $field->width ?? '', $field->cssclass ?? '');
                }
                if ($field->type === 'currency') {
                    $infoBlock->addCurrencyField($field->label, $value, $field->width ?? '', $field->cssclass ?? '');
                }
                if ($field->type === 'date') {
                    $infoBlock->addDateField($field->label, $value, $field->width ?? '', $field->cssclass ?? '');
                }
			}
			$infoBlock->closeRow('row '.$rowcounter);
            $rowcounter++;
		}
        return $infoBlock;
    }

}
