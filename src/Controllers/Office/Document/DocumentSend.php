<?php

namespace Firststep\Controllers\Office\Document;

use Firststep\Common\Controllers\ManagerDocumentSenderController;
use Firststep\Common\Database\QueryExecuter;
use Firststep\Common\Builders\QueryBuilder;
use Firststep\Common\Database\DocumentDao;

/**
 * 
 */
class DocumentSend extends ManagerDocumentSenderController {

    private $documentDao;

    function __construct() {
        $this->queryExecuter = new QueryExecuter;
        $this->queryBuilder = new QueryBuilder;
        $this->documentDao = new DocumentDao;
    }

    /**
     * @throws GeneralException
     */
    public function getRequest() {
        // updating the document table
        $this->documentDao->setDBH( $this->dbconnection->getDBH() );
        $this->documentDao->setTableName( $this->resource->name );

        // deleting from database
        $this->documentDao->updateSend( $this->getParameters['id'] );

        // applying the possible logics
        $this->queryExecuter->setDBH( $this->dbconnection->getDBH() );

        // if there are logics to implement
        if ( isset($this->resource->onsend->logics) ) {
            foreach ($this->resource->onsend->logics as $logic) {
                $this->queryExecuter->setQueryBuilder($this->queryBuilder);
                $this->queryExecuter->setQueryStructure($logic);
                $this->queryExecuter->setParameters($this->getParameters);

                $this->queryExecuter->executeQuery();
            }
        }

        $this->redirectToPreviousPage();
    }

}
