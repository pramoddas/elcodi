<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2015 Elcodi Networks S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Component\CartCoupon\Tests\UnitTest\Entity;

use Elcodi\Component\Core\Tests\UnitTest\Entity\AbstractEntityTest;

/**
 * Class OrderCouponTest.
 */
class OrderCouponTest extends AbstractEntityTest
{
    /**
     * Return the entity namespace.
     *
     * @return string Entity namespace
     */
    public function getEntityNamespace()
    {
        return 'Elcodi\Component\CartCoupon\Entity\OrderCoupon';
    }

    /**
     * Return the fields to test in entities.
     *
     * [
     *      [[
     *          "type" => $this::GETTER_SETTER,
     *          "getter" => "getValue",
     *          "setter" => "setValue",
     *          "value" => "Elcodi\Component\...\Interfaces\AnInterface"
     *          "nullable" => true
     *      ]],
     *      [[
     *          "type" => $this::ADDER_REMOVER|$this::ADDER_REMOVER,
     *          "getter" => "getValue",
     *          "setter" => "setValue",
     *          "adder" => "addValue",
     *          "removed" => "removeValue",
     *          "bag" => "collection", // can be array
     *          "value" => "Elcodi\Component\...\Interfaces\AnInterface"
     *      ]]
     * ]
     *
     * @return array Fields
     */
    public function getTestableFields()
    {
        $money = $this->getMock('Elcodi\Component\Currency\Entity\Interfaces\MoneyInterface');
        $amount = rand();
        $currency = $this->getMock('Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface');

        $currency
            ->method('getIso')
            ->willReturn('EUR');

        $money
            ->method('getAmount')
            ->willReturn($amount);
        $money
            ->method('getCurrency')
            ->willReturn($currency);

        return [
            [[
                'type' => $this::GETTER_SETTER,
                'getter' => 'getOrder',
                'setter' => 'setOrder',
                'value' => $this->getMock('Elcodi\Component\Cart\Entity\Interfaces\OrderInterface'),
                'nullable' => false,
            ]],
            [[
                'type' => $this::GETTER_SETTER,
                'getter' => 'getCoupon',
                'setter' => 'setCoupon',
                'value' => $this->getMock('Elcodi\Component\Coupon\Entity\Interfaces\CouponInterface'),
                'nullable' => false,
            ]],
            [[
                'type' => $this::GETTER_SETTER,
                'getter' => 'getCode',
                'setter' => 'setCode',
                'value' => 'value',
                'nullable' => false,
            ]],
            [[
                'type' => $this::GETTER_SETTER,
                'getter' => 'getName',
                'setter' => 'setName',
                'value' => 'value',
                'nullable' => false,
            ]],
            [[
                'type' => $this::GETTER_SETTER,
                'getter' => 'getAmount',
                'setter' => 'setAmount',
                'value' => $money,
                'nullable' => false,
            ]],
        ];
    }
}
