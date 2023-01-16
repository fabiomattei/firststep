<?php

namespace Fabiom\UglyDuckling\Common\Setup;

class Setup {

    public $appNameForPageTitle;
    public $privateTemplateFileName;

    public $htmlTemplatePath;
    public $privateTemplateWithSidebarFileName;
    public $publicTemplateFileName;
    public $emptyTemplateFileName;
    public $basePath;
    public $pathtoapp;
    public $jsonPath;
    public /* string */ $sessionSetupPath; 

    public function __construct() {
        $this->appNameForPageTitle = '';
        $this->privateTemplateFileName = '';
        $this->privateTemplateWithSidebarFileName = '';
        $this->publicTemplateFileName = '';
        $this->basePath = '';
        $this->pathtoapp = '';
        $this->jsonPath = '';
        $this->htmlTemplatePath = '';
        $this->sessionSetupPath = '';
    }

    /**
     * @return string
     */


    public function getAppNameForPageTitle(): string {
        return $this->appNameForPageTitle;
    }

    /**
     * @param string $appNameForPageTitle
     */
    public function setAppNameForPageTitle(string $appNameForPageTitle) {
        $this->appNameForPageTitle = $appNameForPageTitle;
    }

    /**
     * @return string
     */
    public function getPrivateTemplateFileName(): string {
        return $this->privateTemplateFileName;
    }

    /**
     * @param string $privateTemplateFileName
     */
    public function setPrivateTemplateFileName(string $privateTemplateFileName) {
        $this->privateTemplateFileName = $privateTemplateFileName;
    }

    /**
     * @return string
     */
    public function getPrivateTemplateWithSidebarFileName(): string {
        return $this->privateTemplateWithSidebarFileName;
    }

    /**
     * @param string $privateTemplateWithSidebarFileName
     */
    public function setPrivateTemplateWithSidebarFileName(string $privateTemplateWithSidebarFileName) {
        $this->privateTemplateWithSidebarFileName = $privateTemplateWithSidebarFileName;
    }

    /**
     * @return string
     */
    public function getPublicTemplateFileName(): string {
        return $this->publicTemplateFileName;
    }

    /**
     * @param string $publicTemplateFileName
     */
    public function setPublicTemplateFileName(string $publicTemplateFileName) {
        $this->publicTemplateFileName = $publicTemplateFileName;
    }

    /**
     * @return string
     */
    public function getEmptyTemplateFileName(): string {
        return $this->emptyTemplateFileName;
    }

    /**
     * @param string $privateTemplateFileName
     */
    public function setEmptyTemplateFileName(string $emptyTemplateFileName) {
        $this->emptyTemplateFileName = $emptyTemplateFileName;
    }

    /**
     * @return string
     */
    public function getHTMLTemplatePath(): string {
        return $this->htmlTemplatePath;
    }

    /**
     * @param string $htmlTemplatePath
     */
    public function setHTMLTemplatePath( string $htmlTemplatePath ) {
        $this->htmlTemplatePath = $htmlTemplatePath;
    }

    /**
     * @return string
     */
    public function getBasePath(): string {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath(string $basePath) {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    public function getPathToApp(): string {
        return $this->pathtoapp;
    }

    /**
     * @param string $basePath
     */
    public function setPathToApp(string $pathtoapp) {
        $this->pathtoapp = $pathtoapp;
    }
    
    /**
     * @return string
     */
    public function getJsonPath(): string {
        return $this->jsonPath;
    }

    /**
     * @param string $yamlpath
     */
    public function setJsonPath(string $jsonPath) {
        $this->jsonPath = $jsonPath;
    }
    
    /**
     * Check if the session setup json file has been defined 
     *
     * @return boolean
     */
    public function isSessionSetupPathSet(): bool {
        return isset($this->sessionSetupPath);
    }
    
    /**
     * Get the path to session setup json file
     * @return string
     */
    public function getSessionSetupPath(): string {
        return $this->sessionSetupPath;
    }
    
    /**
     * Set the path to session setup json file
     * @param string $sessionSetupPath
     */
    public function setSessionSetupPath(string $sessionSetupPath) {
        $this->sessionSetupPath = $sessionSetupPath;
    }

}
