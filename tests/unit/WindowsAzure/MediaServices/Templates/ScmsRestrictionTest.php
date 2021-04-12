<?php


/**
 * PHP version 7.4
 *
 * @author    Michael Bunker <michaelb@ocp.org>
 * @copyright Oregon Catholic Press 2021
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/oregoncatholicpress/azure-sdk-for-php
 * @version   1.0.0
 */

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP version 5
 *
 * @category  Microsoft
 *
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 *
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */

namespace Tests\unit\WindowsAzure\MediaServices\Templates;

use WindowsAzure\MediaServices\Templates\ScmsRestriction;
use WindowsAzure\MediaServices\Templates\ErrorMessages;
use PHPUnit\Framework\TestCase;

/**
 * Unit Tests for ScmsRestriction.
 *
 * @category  Microsoft
 *
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 *
 * @version   Release: 0.5.0_2016-11
 *
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class ScmsRestrictionTest extends TestCase
{
    /**
     * @covers \WindowsAzure\MediaServices\Templates\ScmsRestriction::__construct
     * @covers \WindowsAzure\MediaServices\Templates\ScmsRestriction::getConfigurationData
     */
    public function testCreateScmsRestriction()
    {
        // Setup
        $payload = 1;
        $entity = new ScmsRestriction($payload);

        // Test
        $result = $entity->getConfigurationData();

        // Assert
        $this->assertEquals($payload, $result);
    }

    /**
     * @covers \WindowsAzure\MediaServices\Templates\ScmsRestriction::__construct
     */
    public function testCreateScmsRestrictionWithBadConfDataShouldThrown()
    {
        // Setup
        $payload = 5;
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage(ErrorMessages::INVALID_TWO_BIT_CONFIGURATION_DATA);
        new ScmsRestriction($payload);
    }

    /**
     * @covers \WindowsAzure\MediaServices\Templates\ScmsRestriction::getConfigurationData
     * @covers \WindowsAzure\MediaServices\Templates\ScmsRestriction::setConfigurationData
     */
    public function testGetSetConfigurationData()
    {
        // Setup
        $payload = 1;
        $entity = new ScmsRestriction($payload);
        $payload2 = 2;

        // Test
        $entity->setConfigurationData($payload2);
        $result = $entity->getConfigurationData();

        // Assert
        $this->assertEquals($payload2, $result);
    }
}
