<?php
/**
 * Backend
 *
 * PHP Version 7
 *
 * @link      http://scm.monitorlinq.com/backend
 * @copyright Copyright (c) 2016 Monitorlinq Limited
 * @license   http://www.monitorlinq.com/license Proprietary License
 */

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}