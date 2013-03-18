<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class fieldsViewfields extends JView
{
	public function display($tpl = null)
	{
		global $mainframe, $context;
		$context = 'field_id';
		$redtemplate = new Redtemplate;
		$document = & JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSHOP_FIELDS'));

		JToolBarHelper::title(JText::_('COM_REDSHOP_FIELDS_MANAGEMENT'), 'redshop_fields48');
		JToolBarHelper::addNewX();
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();

		$uri =& JFactory::getURI();
		$fields = & $this->get('Data');
		$total = & $this->get('Total');
		$pagination = & $this->get('Pagination');
		$optiontype = $redtemplate->getFieldTypeSections();
		$optionsection = $redtemplate->getFieldSections();

		$filter_order = $mainframe->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'field_id');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');
		$filtertypes = $mainframe->getUserStateFromRequest($context . 'filtertypes', 'filtertypes', 0);
		$filtersection = $mainframe->getUserStateFromRequest($context . 'filtertypes', 'filtersection', 0);

		$lists['order'] = $filter_order;
		$lists['order_Dir'] = $filter_order_Dir;

		$lists['type'] = JHTML::_('select.genericlist', $optiontype, 'filtertypes',
			'class="inputbox" size="1" onchange="document.adminForm.submit();" ',
			'value', 'text', $filtertypes
		);
		$lists['section'] = JHTML::_('select.genericlist', $optionsection, 'filtersection',
			'class="inputbox" size="1" onchange="document.adminForm.submit();"',
			'value', 'text', $filtersection
		);

		$this->assignRef('user', JFactory::getUser());
		$this->assignRef('lists', $lists);
		$this->assignRef('fields', $fields);
		$this->assignRef('pagination', $pagination);
		$this->assignRef('request_url', $uri->toString());

		parent::display($tpl);
	}
}
