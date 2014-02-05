<?php
/**
 * @package     RedSHOP
 * @subpackage  Plugin
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_COMPONENT . '/helpers/helper.php';
require_once JPATH_SITE . '/administrator/components/com_redshop/helpers/redshop.cfg.php';

$objOrder         = new order_functions;
$objconfiguration = new Redconfiguration;
$user             = JFactory::getUser();
$shipping_address = $objOrder->getOrderShippingUserInfo($data['order_id']);
$redhelper        = new redhelper;
$db               = JFactory::getDbo();
$user             = JFActory::getUser();
$task             = JRequest::getVar('task');
$app              = JFactory::getApplication();

$sql = "SELECT op.*,o.order_total,o.user_id,o.order_tax,o.order_subtotal,o.order_shipping,o.order_number,o.payment_discount FROM #__redshop_order_payment AS op LEFT JOIN #__redshop_orders AS o ON op.order_id = o.order_id  WHERE o.order_id='" . $data['order_id'] . "'";
$db->setQuery($sql);
$order_details = $db->loadObjectList();

$buyeremail     = $data['billinginfo']->user_email;
$buyerfirstname = $data['billinginfo']->firstname;
$buyerlastname  = $data['billinginfo']->lastname;
$CN             = $buyerfirstname . "&nbsp;" . $buyerlastname;
$ownerZIP       = $data['billinginfo']->zipcode;
$owneraddress   = $data['billinginfo']->address;
$ownercty       = $data['billinginfo']->city;

if ($this->params->get("is_test") == '1')
{
	$postfinanceurl = "https://e-payment.postfinance.ch/ncol/test/orderstandard.asp";
}
else
{
	$postfinanceurl = "https://e-payment.postfinance.ch/ncol/prod/orderstandard.asp";
}

$currencyClass = new CurrencyHelper;
$order->order_subtotal = round($currencyClass->convert($order_details[0]->order_total, '', 'USD'), 2) * 100;

$post_variables = Array(
	"orderID"      => $data['order_id'],
	"currency"     => "USD",
	"PSPID"        => $this->params->get("postpayment_shopid"),
	"amount"       => $order->order_subtotal,
	"language"     => "en_US",
	"CN"           => $CN,
	"EMAIL"        => $buyeremail,
	"ownerZIP"     => $ownerZIP,
	"owneraddress" => $owneraddress,
	"ownercty"     => $ownercty,
	"accepturl"    => JURI::base() . "index.php?option=com_redshop&view=order_detail&controller=order_detail&task=notify_payment&payment_plugin=rs_payment_postfinance",
	"declineurl"   => JURI::base() . "index.php?option=com_redshop&view=order_detail&controller=order_detail&task=notify_payment&payment_plugin=rs_payment_postfinance",
	"exceptionurl" => "http://www.google.com",
	"cancelurl"    => JURI::base() . "index.php"
);

echo "<form action='$postfinanceurl' method='post' name='postfinanacefrm' id='postfinanacefrm'>";
echo "<input type='submit' name='submit'  value='submit' />";

foreach ($post_variables as $name => $value)
{
	echo "<input type='hidden' name='$name' value='$value' />";
}

echo "</form>";
?>
<script type='text/javascript'>document.postfinanacefrm.submit();</script>
