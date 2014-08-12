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
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Sales\Service\V1;

/**
 * Class OrderAddressUpdateTest
 */
class OrderAddressUpdateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OrderAddressUpdate
     */
    protected $orderAddressUpdate;

    /**
     * @var \Magento\Sales\Model\Order\AddressConverter|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $addressConverterMock;

    protected function setUp()
    {
        $this->addressConverterMock = $this->getMock(
            'Magento\Sales\Model\Order\AddressConverter',
            ['getModel'],
            [],
            '',
            false
        );
        $this->orderAddressUpdate = new OrderAddressUpdate(
            $this->addressConverterMock
        );
    }

    /**
     * test Order Address Update service
     */
    public function testInvoke()
    {
        $dtoMock = $this->getMock(
            '\Magento\Sales\Service\V1\Data\OrderAddress',
            [],
            [],
            '',
            false
        );

        $orderAddressModel = $this->getMock(
            'Magento\Sales\Model\Order\Address',
            ['save', '__wakeup'],
            [],
            '',
            false
        );
        $this->addressConverterMock->expects($this->once())
            ->method('getModel')
            ->with($this->equalTo($dtoMock))
            ->will($this->returnValue($orderAddressModel));
        $orderAddressModel->expects($this->once())
            ->method('save')
            ->will($this->returnSelf());
        $this->orderAddressUpdate->invoke($dtoMock);

    }
}
