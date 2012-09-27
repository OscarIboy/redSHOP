<?php
/**
 * @package     redSHOP
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

class zipcodeViewzipcode extends JViewLegacy
{
    public function display($tpl = null)
    {
        global $context;

        $app = JFactory::getApplication();

        $context  = 'zipcode_id';
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_REDSHOP_ZIPCODE'));

        JToolBarHelper::title(JText::_('COM_REDSHOP_ZIPCODE_MANAGEMENT'), 'redshop_region_48');

        jimport('joomla.html.pagination');
        JToolbarHelper::addNewX();
        JToolbarHelper::EditListX();
        JToolbarHelper::deleteList();

        $uri = JFactory::getURI();

        $filter_order       = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'zipcode_id');
        $filter_order_Dir   = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');
        $lists['order']     = $filter_order;
        $lists['order_Dir'] = $filter_order_Dir;

        $fields     = $this->get('Data');
        $pagination = $this->get('Pagination');

        $this->user = JFactory::getUser();
        $this->assignRef('pagination', $pagination);
        $this->assignRef('fields', $fields);
        $this->assignRef('lists', $lists);
        $this->request_url = $uri->toString();

        parent::display($tpl);
    }
}

