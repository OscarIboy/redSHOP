<?php
/**
 * @package     redSHOP
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class tax_groupController extends JController
{
    function cancel()
    {
        $option = JRequest::getVar('option');
        $this->setRedirect('index.php?option=' . $option . '&view=tax_group');
    }
}
