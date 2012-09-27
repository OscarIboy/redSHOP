<?php
/**
 * @package     redSHOP
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die ('Restricted access');

$context = 'ddd';
;
require_once(JPATH_COMPONENT . DS . 'helpers' . DS . 'category.php');

class stockroom_listingViewstockroom_listing extends JViewLegacy
{
    public function display($tpl = null)
    {
        global $context2;

        $app = JFactory::getApplication();

        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_REDSHOP_STOCKROOM_LISTING'));
        JToolBarHelper::title(JText::_('COM_REDSHOP_STOCKROOM_LISTING_MANAGEMENT'), 'redshop_stockroom48');

        JToolBarHelper::custom('export_data', 'save.png', 'save_f2.png', 'Export Data', false);
        JToolBarHelper::custom('print_data', 'save.png', 'save_f2.png', 'Print Data', false);

        $stockroom_type = $app->getUserStateFromRequest($context2 . 'stockroom_type', 'stockroom_type', 'product');

        $uri              = JFactory::getURI();
        $filter_order     = $app->getUserStateFromRequest($context2 . 'filter_order', 'filter_order', 'p.product_id');
        $filter_order_Dir = $app->getUserStateFromRequest($context2 . 'filter_order_Dir', 'filter_order_Dir', '');
        $search_field     = $app->getUserStateFromRequest($context2 . 'search_field', 'search_field', '');
        $keyword          = $app->getUserStateFromRequest($context2 . 'keyword', 'keyword', '');
        $category_id      = $app->getUserStateFromRequest($context2 . 'category_id', 'category_id', '');

        //stockroom type and attribute type
        $optiontype = array();

        $optiontype[] = JHTML::_('select.option', 'product', JText::_('COM_REDSHOP_PRODUCT'));
        $optiontype[] = JHTML::_('select.option', 'property', JText::_('COM_REDSHOP_PROPERTY'));
        $optiontype[] = JHTML::_('select.option', 'subproperty', JText::_('COM_REDSHOP_SUBPROPERTY'));

        $lists['stockroom_type'] = JHTML::_('select.genericlist', $optiontype, 'stockroom_type', 'class="inputbox" size="1" onchange="document.adminForm.submit();" ', 'value', 'text', $stockroom_type);

        $product_category = new product_category();
        $categories       = $product_category->getCategoryListArray();

        $temps                   = array();
        $temps[0]->category_id   = "0";
        $temps[0]->category_name = JText::_('COM_REDSHOP_SELECT');
        $categories              = @array_merge($temps, $categories);
        $lists['category']       = JHTML::_('select.genericlist', $categories, 'category_id', 'class="inputbox" onchange="getTaskChange();document.adminForm.submit();" ', 'category_id', 'category_name', $category_id);

        $lists ['order']     = $filter_order;
        $lists ['order_Dir'] = $filter_order_Dir;
        $resultlisting       = $this->get('Data');
        $stockroom           = $this->get('Stockroom');

        $pagination = $this->get('Pagination');

        $this->assignRef('lists', $lists);
        $this->assignRef('keyword', $keyword);
        $this->assignRef('search_field', $search_field);
        $this->assignRef('resultlisting', $resultlisting);
        $this->assignRef('stockroom', $stockroom);
        $this->assignRef('stockroom_type', $stockroom_type);
        $this->assignRef('pagination', $pagination);
        $this->request_url = $uri->toString();

        parent::display($tpl);
    }
}
