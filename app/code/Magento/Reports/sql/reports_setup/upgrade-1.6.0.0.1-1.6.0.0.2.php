<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Reports
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/** @var $installer \Magento\Core\Model\Resource\Setup */
$installer = $this;
/*
 * Rename incorrectly named tables in early magento 2 development version
 */
$installer->startSetup();

$aggregationTablesToRename = array(
    'reports_viewed_aggregated_daily'   => \Magento\Reports\Model\Resource\Report\Product\Viewed::AGGREGATION_DAILY,
    'reports_viewed_aggregated_monthly' => \Magento\Reports\Model\Resource\Report\Product\Viewed::AGGREGATION_MONTHLY,
    'reports_viewed_aggregated_yearly'  => \Magento\Reports\Model\Resource\Report\Product\Viewed::AGGREGATION_YEARLY,
);

foreach ($aggregationTablesToRename as $wrongName => $rightName) {
    if ($installer->tableExists($wrongName)) {
        $installer->getConnection()->renameTable($installer->getTable($wrongName), $installer->getTable($rightName));
    }
}

$installer->endSetup();