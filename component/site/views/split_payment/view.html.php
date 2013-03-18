<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die ('restricted access');

jimport('joomla.application.component.view');

class split_paymentViewsplit_payment extends JView
{
	public function display($tpl = null)
	{
		global $mainframe;

		$params = & $mainframe->getParams('com_redshop');

		$pathway  = & $mainframe->getPathway();
		$document = & JFactory::getDocument();

		$pathway->addItem(JText::_('COM_REDSHOP_SPLIT_PAYMENT'), '');

		$userdata = JRequest::getVar('userdata');
		$user     = JFactory::getUser();

		// preform security checks
		if ($user->id == 0)
		{
			echo JText::_('COM_REDSHOP_ALERTNOTAUTH_ACCOUNT');

			return;
		}

		$this->assignRef('user', $user);
		$this->assignRef('userdata', $userdata);
		$this->assignRef('params', $params);
		$payment_method_id = JRequest::getVar('payment_method_id');
		$this->assignRef('payment_method_id', $payment_method_id);

		parent::display($tpl);
	}
}
