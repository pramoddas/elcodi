<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2016 Elcodi Networks S.L.
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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\StockUpdater;

use Elcodi\Bundle\TestCommonBundle\Functional\WebTestCase;

/**
 * Class PackStockUpdaterTest.
 */
class PackStockUpdaterTest extends WebTestCase
{
    /**
     * Load fixtures of these bundles.
     *
     * @return array Bundles name where fixtures should be found
     */
    protected static function loadFixturesBundles()
    {
        return [
            'ElcodiProductBundle',
        ];
    }

    /**
     * Test update stock.
     */
    public function atestUpdateStockNonInherit()
    {
        $pack = $this->find('product_pack', 1);
        $this->get('elcodi.stock_updater.product_pack')->updateStock(
            $pack,
            4
        );
        $this->getObjectManager('product_pack')->clear();
        $pack = $this->find('product_pack', 1);
        $this->assertEquals(
            6,
            $pack->getStock()
        );
    }

    /**
     * Test update stock.
     */
    public function testUpdateStockInherit()
    {
        $this->reloadScenario();

        $pack = $this->find('product_pack', 2);
        $this->get('elcodi.stock_updater.product_pack')->updateStock(
            $pack,
            3
        );
        $this->clear($pack);
        $pack = $this->find('product_pack', 2);
        $this->assertEquals(
            2,
            $pack->getStock()
        );
        $purchasables = $pack->getPurchasables()->toArray();

        $this->assertEquals(
            7,
            $purchasables[0]->getStock()
        );

        $this->assertEquals(
            2,
            $purchasables[1]->getStock()
        );

        $this->assertEquals(
            97,
            $purchasables[2]->getStock()
        );
    }

    /**
     * Test update stock.
     */
    public function testUpdateStockInheritWithStockFinish()
    {
        $this->reloadScenario();

        $pack = $this->find('product_pack', 2);
        $this->get('elcodi.stock_updater.product_pack')->updateStock(
            $pack,
            9
        );
        $this->clear($pack);
        $pack = $this->find('product_pack', 2);
        $this->assertEquals(
            0,
            $pack->getStock()
        );
        $purchasables = $pack->getPurchasables()->toArray();

        $this->assertEquals(
            1,
            $purchasables[0]->getStock()
        );

        $this->assertEquals(
            0,
            $purchasables[1]->getStock()
        );

        $this->assertEquals(
            91,
            $purchasables[2]->getStock()
        );
    }
}
