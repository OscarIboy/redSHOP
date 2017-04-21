<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2008 - 2017 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

/**
 * View Categories
 *
 * @package     RedSHOP.Backend
 * @subpackage  View
 * @since       __DEPLOY_VERSION__
 */
class RedshopViewCategories extends RedshopViewList
{
	/**
	 * Method for add toolbar.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	protected function addToolbar()
	{
		// Add common button
		if ($this->canCreate)
		{
			JToolbarHelper::addNew($this->getInstanceName() . '.add');
			JToolBarHelper::custom('category.copy', 'copy.png', 'copy_f2.png', JText::_('COM_REDSHOP_TOOLBAR_COPY'), true);
		}

		if ($this->canDelete)
		{
			JToolbarHelper::deleteList('', $this->getInstancesName() . '.delete');
		}

		if ($this->canEdit)
		{
			JToolbarHelper::publish($this->getInstancesName() . '.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish($this->getInstancesName() . '.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::checkin($this->getInstancesName() . '.publish', 'JTOOLBAR_CHECKIN', true);
		}
	}

	/**
	 * Method for prepare table.
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	protected function prepareTable()
	{
		parent::prepareTable();

		$this->columns[] = array(
				// This column is sortable?
				'sortable'  => false,
				// Text for column
				'text'      => JText::_('COM_REDSHOP_PRODUCTS'),
				// Name of property for get data.
				'dataCol'   => 'product',
				// Width of column
				'width'     => 'auto',
				// Enable edit inline?
				'inline'    => false,
				// Display with edit link or not?
				'edit_link' => false,
				// Type of column
				'type'      => 'text',
			);
	}

	/**
	 * Method for render 'Published' column
	 *
	 * @param   array   $config  Row config.
	 * @param   int     $index   Row index.
	 * @param   object  $row     Row data.
	 *
	 * @return  string
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function onRenderColumn($config, $index, $row)
	{
		$isCheckedOut = $row->checked_out && JFactory::getUser()->id != $row->checked_out;
		$inlineEditEnable = Redshop::getConfig()->getBool('INLINE_EDITING');

		if ($config['dataCol'] == 'name')
		{
			if ($config['inline'] === true && !$isCheckedOut && $inlineEditEnable && $this->canEdit)
			{
				$value   = $row->{$config['dataCol']};
				$display = $value;

				if ($config['edit_link'])
				{
					$display = str_repeat('<span class="gi">|&nbsp;&mdash;&nbsp;</span>', $row->level - 1) . '<a href="index.php?option=com_redshop&task=' . $this->getInstanceName() . '.edit&id=' . $row->id . '">' . $value . '</a>';
				}

				return JHtml::_('redshopgrid.inline', $config['dataCol'], $value, $display, $row->id, $config['type']);
			}
			else
			{
				if ($this->canEdit)
				{
					return str_repeat('<span class="gi">|&nbsp;&mdash;&nbsp;</span>', $row->level - 1) . '<a href="index.php?option=com_redshop&task=' . $this->getInstanceName() . '.edit&id=' . $row->id . '">' . $row->{$config['dataCol']} . '</a>';
				}
				else
				{
					return str_repeat('<span class="gi">|&nbsp;&mdash;&nbsp;</span>', $row->level - 1) . $row->{$config['dataCol']};
				}
			}
		}
		elseif ($config['dataCol'] == 'description')
		{
			return JHtml::_('redshopgrid.slidetext', strip_tags($row->description));
		}

		$row->product = $this->model->getProducts($row->id);
		return parent::onRenderColumn($config, $index, $row);
	}
}