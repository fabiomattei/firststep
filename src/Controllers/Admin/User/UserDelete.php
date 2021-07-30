<?php

/**
 * Created by Fabio Mattei
 * Date: 28/10/2018
 * Time: 15:46
 */

namespace Fabiom\UglyDuckling\Controllers\Admin\User;

use Fabiom\UglyDuckling\BusinessLogic\Group\Daos\UserGroupDao;
use Fabiom\UglyDuckling\BusinessLogic\User\Daos\UserDao;
use Fabiom\UglyDuckling\Common\Controllers\AdminController;
use Fabiom\UglyDuckling\Common\Router\AdminRouter;

/**
 * This class gives a list of all entities loaded in to the system
 */
class UserDelete extends AdminController {

    private $userDao;
    private $userGroupDao;

    public function __construct() {
        $this->userDao = new UserDao;
        $this->userGroupDao = New UserGroupDao();
    }

    public $post_validation_rules = array( 'usrid' => 'required|numeric' );
    public $post_filter_rules     = array( 'usrid' => 'trim' );

    /**
     * @throws GeneralException
     *
     * $this->getParameters['id'] resource key index
     */
    public function postRequest() {
        $this->userDao->setDBH( $this->pageStatus->getDbconnection()->getDBH() );
		$this->userDao->setLogger( $this->applicationBuilder->getLogger() );
        $this->userGroupDao->setDBH( $this->pageStatus->getDbconnection()->getDBH() );
		$this->userGroupDao->setLogger( $this->applicationBuilder->getLogger() );

        $this->userGroupDao->deleteByFields( array( 'ug_userid' => $this->postParameters['usrid'] ) );
        $this->userDao->delete( $this->postParameters['usrid'] );

        $this->setSuccess( 'User successfully deleted' );

        $this->redirectToPage( $this->applicationBuilder->getRouterContainer()->makeRelativeUrl( AdminRouter::ROUTE_ADMIN_USER_LIST ) );

        $this->templateFile = $this->applicationBuilder->getSetup()->getPrivateTemplateWithSidebarFileName();
    }

}
