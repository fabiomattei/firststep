<?php

/**
 * Created by Fabio Mattei
 * Date: 02/11/2018
 * Time: 04:56
 */

namespace Firststep\Common\Json\Builders;

use Firststep\Common\Blocks\CardHTMLBlock;
use Firststep\Common\Json\Builders\Chartjs\ChartjsBuilder;
use Firststep\Common\Json\Builders\Form\FormBuilder;
use Firststep\Common\Json\Builders\Info\InfoBuilder;
use Firststep\Common\Json\Builders\Table\TableBuilder;
use Firststep\Common\Router\Router;

class PanelBuilder extends BaseBuilder {

    private $tableBuilder;
    private $chartjsBuilder;
    private $infoBuilder;
    private $formBuilder;

    /**
     * PanelBuilder constructor.
     * @param $tableBuilder
     */
    public function __construct() {
        $this->tableBuilder = new TableBuilder;
        $this->chartjsBuilder = new ChartjsBuilder;
        $this->infoBuilder = new InfoBuilder;
        $this->formBuilder = new FormBuilder;
        $this->action = '';
    }

    function getPanel($panel) {
        $panelBlock = new CardHTMLBlock;
        $panelBlock->setTitle($panel->title ?? '');
        $panelBlock->setWidth($panel->width ?? '3');
        $panelBlock->setHtmlTemplateLoader( $this->htmlTemplateLoader );

        $resource = $this->jsonloader->loadResource( $panel->resource );

        $panelBlock->setBlock($this->getHTMLBlock($resource));

        return $panelBlock;
    }

    /**
     * Return a panel containing an HTML Block built with data in the resource field
     *
     * The HTML block type depends from the resource->metadata->type field in the json strcture
     *
     * @param $resource
     * @return CardHTMLBlock
     */
    function getWidePanel( $resource ) {
        $panelBlock = new CardHTMLBlock;
        $panelBlock->setTitle('');
        $panelBlock->setWidth( '12');
        $panelBlock->setHtmlTemplateLoader( $this->htmlTemplateLoader );
        $panelBlock->setBlock($this->getHTMLBlock($resource));
        return $panelBlock;
    }

    /**
     * Return an HTML Block
     *
     * The HTML block type depends from the resource->metadata->type field in the json strcture
     *
     * @param $resource json strcture
     * @param CardHTMLBlock $panelBlock
     */
    public function getHTMLBlock( $resource ) {
        if ($resource->metadata->type == TableBuilder::blocktype) {
            $this->tableBuilder->setHtmlTemplateLoader($this->htmlTemplateLoader);
            $this->tableBuilder->setJsonloader($this->jsonloader);
            $this->tableBuilder->setRouter($this->router);
            $this->tableBuilder->setResource($resource);
            $this->tableBuilder->setParameters($this->parameters);
            $this->tableBuilder->setDbconnection($this->dbconnection);
            return $this->tableBuilder->createTable();
        }

        if ($resource->metadata->type == ChartjsBuilder::blocktype) {
            $this->chartjsBuilder->setHtmlTemplateLoader($this->htmlTemplateLoader);
            $this->chartjsBuilder->setJsonloader($this->jsonloader);
            $this->chartjsBuilder->setRouter($this->router);
            $this->chartjsBuilder->setResource($resource);
            $this->chartjsBuilder->setParameters($this->parameters);
            $this->chartjsBuilder->setDbconnection($this->dbconnection);
            return $this->chartjsBuilder->createChart();
        }

        if ($resource->metadata->type == InfoBuilder::blocktype) {
            $this->infoBuilder->setHtmlTemplateLoader($this->htmlTemplateLoader);
            $this->infoBuilder->setJsonloader($this->jsonloader);
            $this->infoBuilder->setRouter($this->router);
            $this->infoBuilder->setResource($resource);
            $this->infoBuilder->setParameters($this->parameters);
            $this->infoBuilder->setDbconnection($this->dbconnection);
            return $this->infoBuilder->createInfo();
        }

        if ($resource->metadata->type == FormBuilder::blocktype) {
            $this->formBuilder->setHtmlTemplateLoader($this->htmlTemplateLoader);
            $this->formBuilder->setJsonloader($this->jsonloader);
            $this->formBuilder->setRouter($this->router);
            $this->formBuilder->setResource($resource);
            $this->formBuilder->setParameters($this->parameters);
            $this->formBuilder->setDbconnection($this->dbconnection);
            $this->formBuilder->setAction($this->action . '&postres=' . $resource->name);
            return $this->formBuilder->createForm();
        }

        if ($resource->metadata->type == 'search') {
            $this->formBuilder->setHtmlTemplateLoader($this->htmlTemplateLoader);
            $this->formBuilder->setJsonloader($this->jsonloader);
            $this->formBuilder->setRouter($this->router);
            $this->formBuilder->setResource($resource);
            $this->formBuilder->setParameters($this->parameters);
            $this->formBuilder->setDbconnection($this->dbconnection);
            $this->formBuilder->setAction($this->router->make_url(Router::ROUTE_OFFICE_ENTITY_SEARCH, 'res=' . $resource->name));
            return $this->formBuilder->createForm();
        }

        if ($resource->metadata->type == 'export') {
            $this->formBuilder->setHtmlTemplateLoader($this->htmlTemplateLoader);
            $this->formBuilder->setJsonloader($this->jsonloader);
            $this->formBuilder->setRouter($this->router);
            $this->formBuilder->setResource($resource);
            $this->formBuilder->setParameters($this->parameters);
            $this->formBuilder->setDbconnection($this->dbconnection);
            $this->formBuilder->setAction($this->router->make_url(Router::ROUTE_OFFICE_ENTITY_EXPORT, 'res=' . $resource->name));
            return $this->formBuilder->createForm();
        }
    }

}
