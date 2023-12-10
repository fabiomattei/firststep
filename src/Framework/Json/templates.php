<?php

use Fabiom\UglyDuckling\Common\Blocks\BaseHTMLDashboard;
use Fabiom\UglyDuckling\Common\Blocks\CardHTMLBlock;

$GLOBALS['myTemplateFunctions'] = [];

$GLOBALS['myTemplateFunctions']['dashboard'] = function ( $jsonResource, $jsonLoader ): BaseHTMLDashboard {
    $htmlTemplateLoader = $this->applicationBuilder->getHtmlTemplateLoader();

    // this first section of the code run trough all defined panels for the specific
    // dashboard and add each of them to the array $panelRows
    // I am separating panels by row
    $panelRows = array();

    foreach ($jsonResource->panels as $panel) {
        // if there is not array of panels defined for that specific row I am going to create one
        if( !array_key_exists($panel->row, $panelRows) ) $panelRows[$panel->row] = array();
        // adding the panel section, taken from the dashboard json file, to array
        $panelRows[$panel->row][] = $panel;
    }

    $htmlDashboard = new BaseHTMLDashboard;
    $htmlDashboard->setHtmlTemplateLoader( $htmlTemplateLoader );

    foreach ($panelRows as $row) {
        $htmlDashboard->createNewRow();
        foreach ($row as $panel) {
            $panelBlock = new CardHTMLBlock;

            $panelBlock->setTitle($panel->title ?? '');
            $panelBlock->setWidth($panel->width ?? '3');
            $panelBlock->setCssClass($panel->cssclass ?? '');
            $panelBlock->setHtmlTemplateLoader( $this->applicationBuilder->getHtmlTemplateLoader() );

            $panelBlock->setInternalBlockName( $panel->id ?? '' );
            $panelBlock->setBlock( $this->applicationBuilder->getBlock($panel->resource)  );

            $htmlDashboard->addBlockToCurrentRow( $panelBlock );
        }
    }

    return $htmlDashboard;
};


