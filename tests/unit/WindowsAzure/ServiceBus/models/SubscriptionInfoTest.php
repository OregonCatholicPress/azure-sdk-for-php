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
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 *
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */

namespace Tests\unit\WindowsAzure\ServiceBus\models;

use GuzzleHttp\Psr7\Utils;
use Tests\framework\TestResources;
use WindowsAzure\Common\Internal\Atom\Entry;
use WindowsAzure\Common\Internal\Resources;
use WindowsAzure\ServiceBus\Models\SubscriptionDescription;
use WindowsAzure\ServiceBus\Models\SubscriptionInfo;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for class WrapAccessTokenResult.
 *
 * @category  Microsoft
 *
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 *
 * @version   Release: 0.5.0_2016-11
 *
 * @link      https://github.com/WindowsAzure/azure-sdk-for-php
 */
class SubscriptionInfoTest extends TestCase
{
    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::__construct
     */
    public function testSubscriptionInfoConstructor()
    {
        // Setup
        $expected = 'testSubscriptionInfoName';

        // Test
        $SubscriptionInfo = new SubscriptionInfo($expected);
        $actual = $SubscriptionInfo->getTitle();

        // Assert
        $this->assertNotNull($SubscriptionInfo);
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getSubscriptionDescription
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setSubscriptionDescription
     */
    public function testGetSetSubscriptionDescription()
    {
        // Setup
        $expected = new SubscriptionDescription('testSubscriptionDescription');
        $SubscriptionInfo = new SubscriptionInfo();

        // Test
        $SubscriptionInfo->setSubscriptionDescription($expected);
        $actual = $SubscriptionInfo->getSubscriptionDescription();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getLockDuration
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setLockDuration
     */
    public function testGetSetLockDuration()
    {
        // Setup
        $expected = 'testLockDuration';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setLockDuration($expected);
        $actual = $subscriptionInfo->getLockDuration();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getRequiresSession
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setRequiresSession
     */
    public function testGetSetRequiresSession()
    {
        // Setup
        $expected = 'testRequiresSession';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setRequiresSession($expected);
        $actual = $subscriptionInfo->getRequiresSession();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getTitle
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setTitle
     */
    public function testGetSetTitle()
    {
        // Setup
        $expected = 'CoolTitle';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setTitle($expected);
        $actual = $subscriptionInfo->getTitle();

        // Assert
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getEntry
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setEntry
     */
    public function testGetSetEntry()
    {
        // Setup
        $expected = new Entry();
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setEntry($expected);
        $actual = $subscriptionInfo->getEntry();

        // Assert
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::parseXml
     */
    public function testParseXml()
    {
        // Setup
        $subscriptionRoute = sprintf('%sfake/subscriptions/fake', TestResources::getServiceBusEndpoint());
        $deadLetterCount = 99;
        $xml = <<<XML
<entry xmlns="http://www.w3.org/2005/Atom">
    <id>{$subscriptionRoute}</id>
    <title type="text">fake</title>
    <published>2021-04-13T18:18:16Z</published>
    <updated>2021-04-13T18:18:16Z</updated>
    <link rel="self"
          href="{$subscriptionRoute}"/>
    <content type="application/xml">
        <SubscriptionDescription xmlns="http://schemas.microsoft.com/netservices/2010/10/servicebus/connect"
                                 xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
            <LockDuration>PT30S</LockDuration>
            <RequiresSession>false</RequiresSession>
            <DefaultMessageTimeToLive>P14D</DefaultMessageTimeToLive>
            <DeadLetteringOnMessageExpiration>false</DeadLetteringOnMessageExpiration>
            <DeadLetteringOnFilterEvaluationExceptions>false</DeadLetteringOnFilterEvaluationExceptions>
            <MessageCount>2</MessageCount>
            <MaxDeliveryCount>10</MaxDeliveryCount>
            <EnableBatchedOperations>true</EnableBatchedOperations>
            <Status>Active</Status>
            <CreatedAt>2021-04-13T18:18:16.7868721Z</CreatedAt>
            <UpdatedAt>2021-04-13T18:18:16.7868721Z</UpdatedAt>
            <AccessedAt>2021-04-13T19:32:36.9737921Z</AccessedAt>
            <CountDetails xmlns:d3p1="http://schemas.microsoft.com/netservices/2011/06/servicebus">
                <d3p1:ActiveMessageCount>2</d3p1:ActiveMessageCount>
                <d3p1:DeadLetterMessageCount>{$deadLetterCount}</d3p1:DeadLetterMessageCount>
                <d3p1:ScheduledMessageCount>0</d3p1:ScheduledMessageCount>
                <d3p1:TransferMessageCount>0</d3p1:TransferMessageCount>
                <d3p1:TransferDeadLetterMessageCount>0</d3p1:TransferDeadLetterMessageCount>
            </CountDetails>
            <AutoDeleteOnIdle>P14D</AutoDeleteOnIdle>
            <EntityAvailabilityStatus>Available</EntityAvailabilityStatus>
        </SubscriptionDescription>
    </content>
</entry>
XML;

        $stream = Utils::streamFor($xml);
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->parseXml($stream);
        $actual = $subscriptionInfo->getSubscriptionDescription();
        //Make sure parsing works for random field.
        $data = $subscriptionInfo->getDeadLetterMessageCount();

        // Assert
        $this->assertInstanceOf(SubscriptionDescription::class, $actual);
        $this->assertEquals($deadLetterCount, $data);
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::parseXml
     */
    public function testParseXmlNullContent()
    {
        // Setup
        $xml = '<entry></entry>';

        $stream = Utils::streamFor($xml);
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->parseXml($stream);
        $actual = $subscriptionInfo->getSubscriptionDescription();

        // Assert
        $this->assertNull($actual);
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getDefaultMessageTimeToLive
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setDefaultMessageTimeToLive
     */
    public function testGetSetDefaultMessageTimeToLive()
    {
        // Setup
        $expected = 'testDefaultMessageTimeToLive';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setDefaultMessageTimeToLive($expected);
        $actual = $subscriptionInfo->getDefaultMessageTimeToLive();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getActiveMessageCount
     */
    public function testGetActiveMessageCount()
    {
        // Setup
        $expected = 10;
        $description = new SubscriptionDescription();
        $description->setActiveMessageCount($expected);
        $subscriptionInfo = new SubscriptionInfo(Resources::EMPTY_STRING, $description);

        // Test
        $actual = $subscriptionInfo->getActiveMessageCount();

        // Assert
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getDeadLetterMessageCount
     */
    public function testGetDeadLetterMessageCount()
    {
        // Setup
        $expected = 3;
        $description = new SubscriptionDescription();
        $description->setDeadLetterMessageCount($expected);
        $subscriptionInfo = new SubscriptionInfo(Resources::EMPTY_STRING, $description);

        // Test
        $actual = $subscriptionInfo->getDeadLetterMessageCount();

        // Assert
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getScheduledMessageCount
     */
    public function testGetScheduledMessageCount()
    {
        // Setup
        $expected = 11;
        $description = new SubscriptionDescription();
        $description->setScheduledMessageCount($expected);
        $subscriptionInfo = new SubscriptionInfo(Resources::EMPTY_STRING, $description);

        // Test
        $actual = $subscriptionInfo->getScheduledMessageCount();

        // Assert
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getTransferMessageCount
     */
    public function testGetTransferMessageCount()
    {
        // Setup
        $expected = 15;
        $description = new SubscriptionDescription();
        $description->setTransferMessageCount($expected);
        $subscriptionInfo = new SubscriptionInfo(Resources::EMPTY_STRING, $description);

        // Test
        $actual = $subscriptionInfo->getTransferMessageCount();

        // Assert
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getTransferDeadLetterMessageCount
     */
    public function testGetTransferDeadLetterMessageCount()
    {
        // Setup
        $expected = 20;
        $description = new SubscriptionDescription();
        $description->setTransferDeadLetterMessageCount($expected);
        $subscriptionInfo = new SubscriptionInfo(Resources::EMPTY_STRING, $description);

        // Test
        $actual = $subscriptionInfo->getTransferDeadLetterMessageCount();

        // Assert
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getDeadLetteringOnMessageExpiration
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setDeadLetteringOnMessageExpiration
     */
    public function testGetSetDeadLetteringOnMessageExpiration()
    {
        // Setup
        $expected = 'testDeadLetteringOnMessageExpiration';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setDeadLetteringOnMessageExpiration($expected);
        $actual = $subscriptionInfo->getDeadLetteringOnMessageExpiration();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getDeadLetteringOnFilterEvaluationExceptions
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setDeadLetteringOnFilterEvaluationExceptions
     */
    public function testGetSetDeadLetteringOnFilterEvaluationExceptions()
    {
        // Setup
        $expected = 'testDeadLetteringOnFilterEvaluationExceptions';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setDeadLetteringOnFilterEvaluationExceptions($expected);
        $actual = $subscriptionInfo->getDeadLetteringOnFilterEvaluationExceptions();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getDefaultRuleDescription
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setDefaultRuleDescription
     */
    public function testGetSetDefaultRuleDescription()
    {
        // Setup
        $expected = 'testDefaultRuleDescription';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setDefaultRuleDescription($expected);
        $actual = $subscriptionInfo->getDefaultRuleDescription();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getMessageCount
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setMessageCount
     */
    public function testGetSetMessageCount()
    {
        // Setup
        $expected = 'testMessageCount';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setMessageCount($expected);
        $actual = $subscriptionInfo->getMessageCount();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getMaxDeliveryCount
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setMaxDeliveryCount
     */
    public function testGetSetMaxDeliveryCount()
    {
        // Setup
        $expected = 'testMaxDeliveryCount';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setMaxDeliveryCount($expected);
        $actual = $subscriptionInfo->getMaxDeliveryCount();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }

    /** 
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::getEnableBatchedOperations
     * @covers \WindowsAzure\ServiceBus\Models\SubscriptionInfo::setEnableBatchedOperations
     */
    public function testGetSetEnableBatchedOperations()
    {
        // Setup
        $expected = 'testEnableBatchedOperations';
        $subscriptionInfo = new SubscriptionInfo();

        // Test
        $subscriptionInfo->setEnableBatchedOperations($expected);
        $actual = $subscriptionInfo->getEnableBatchedOperations();

        // Assert 
        $this->assertEquals(
            $expected,
            $actual
        );
    }
}
