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
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */

namespace WindowsAzure\Common\Internal;

use WindowsAzure\Common\Internal\Filters\SASFilter;

/**
 * Represents the settings used to sign and access a request against the service
 * bus.
 *
 * @category  Microsoft
 *
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 *
 * @version   Release: 0.5.0_2016-11
 *
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class ServiceBusSettings extends ServiceSettings {
    /**
     * @var string
     */
    private $_serviceBusEndpointUri;

    /**
     * @var string
     */
    private $_wrapEndpointUri;

    /**
     * @var string
     */
    private $_wrapName;

    /**
     * @var string
     */
    private $_wrapPassword;

    /**
     * @var string
     */
    private $_namespace;

    /**
     * Validator for the SharedSecretValue setting. It has to be provided.
     *
     * @var array
     */
    private static $_wrapPasswordSetting;

    /**
     * Validator for the SharedSecretIssuer setting. It has to be provided.
     *
     * @var array
     */
    private static $_wrapNameSetting;

    /**
     * Validator for the Endpoint setting. Must be a valid Uri.
     *
     * @var array
     */
    private static $_serviceBusEndpointSetting;

    /**
     * Validator for the StsEndpoint setting. Must be a valid Uri.
     *
     * @var array
     */
    private static $_wrapEndpointUriSetting;

    /**
     * @var string
     */
    private static $_sasKeyNameSetting;

    /**
     * @var string
     */
    private static $_sasKeySetting;

    /**
     * @var bool
     */
    protected static $isInitialized = false;

    /**
     * Holds the expected setting keys.
     *
     * @var array
     */
    protected static $validSettingKeys = [];

    /**
     * Initializes static members of the class.
     */
    protected static function init() {
        self::$_serviceBusEndpointSetting = self::settingWithFunc(
            Resources::SERVICE_BUS_ENDPOINT_NAME,
            Validate::getIsValidUri()
        );

        self::$_wrapNameSetting = self::setting(
            Resources::SHARED_SECRET_ISSUER_NAME
        );

        self::$_wrapPasswordSetting = self::setting(
            Resources::SHARED_SECRET_VALUE_NAME
        );

        self::$_sasKeyNameSetting = self::setting(
            Resources::SHARED_SHARED_ACCESS_KEY_NAME
        );

        self::$_sasKeySetting = self::setting(
            Resources::SHARED_SHARED_ACCESS_KEY
        );

        self::$_wrapEndpointUriSetting = self::settingWithFunc(
            Resources::STS_ENDPOINT_NAME,
            Validate::getIsValidUri()
        );

        self::$validSettingKeys[] = Resources::SERVICE_BUS_ENDPOINT_NAME;
        self::$validSettingKeys[] = Resources::SHARED_SECRET_ISSUER_NAME;
        self::$validSettingKeys[] = Resources::SHARED_SECRET_VALUE_NAME;
        self::$validSettingKeys[] = Resources::SHARED_SHARED_ACCESS_KEY_NAME;
        self::$validSettingKeys[] = Resources::SHARED_SHARED_ACCESS_KEY;
        self::$validSettingKeys[] = Resources::STS_ENDPOINT_NAME;
    }

    /**
     * Creates new Service Bus settings instance.
     * @param type $serviceBusEndpoint The Service Bus endpoint uri
     * @param type $filter
     */
    public function __construct(
        $serviceBusEndpoint,
        $filter
    ) {
        $this->_serviceBusEndpointUri = $serviceBusEndpoint;
        $this->_filter = $filter;

    }

    /**
     * @param array $tokenizedSettings
     * @param string $connectionString
     */
    private static function createServiceBusWithSasAuthentication(array $tokenizedSettings, $connectionString = '') {
        $required = [
            self::$_serviceBusEndpointSetting,
            self::$_sasKeyNameSetting,
            self::$_sasKeySetting,
        ];
        $optional = [
            self::$_wrapEndpointUriSetting,
        ];
        $matchedSpecs = self::getMatchedSpecs($tokenizedSettings, $required, $optional, $connectionString);

        $endpoint = Utilities::tryGetValueInsensitive(
            Resources::SERVICE_BUS_ENDPOINT_NAME,
            $tokenizedSettings
        );

        $sharedAccessKeyName = Utilities::tryGetValueInsensitive(
            Resources::SHARED_SHARED_ACCESS_KEY_NAME,
            $tokenizedSettings
        );
        $sharedAccessKey = Utilities::tryGetValueInsensitive(
            Resources::SHARED_SHARED_ACCESS_KEY,
            $tokenizedSettings
        );

        return new self($endpoint, new SASFilter(
            $sharedAccessKeyName,
            $sharedAccessKey
        ));
    }

    /**
     * @param $tokenizedSettings
     * @param $required
     * @param array $optional
     * @param string $connectionString
     * @return mixed
     */
    private static function getMatchedSpecs($tokenizedSettings, $required, $optional = [], $connectionString = '') {
        $matchedSpecs = self::matchedSpecification(
            $tokenizedSettings,
            self::allRequired(...$required),
            self::optional(...$optional)
        );

        if (!$matchedSpecs) {
            self::noMatch($connectionString);
        }

        return $matchedSpecs;
    }

    /**
     * Creates a ServiceBusSettings object from the given connection string.
     *
     * @param string $connectionString The storage settings connection string
     *
     * @return ServiceBusSettings|void
     */
    public static function createFromConnectionString($connectionString) {
        $tokenizedSettings = self::parseAndValidateKeys($connectionString);
        return self::createServiceBusWithSasAuthentication($tokenizedSettings, $connectionString);
    }

    /**
     * Gets the Service Bus endpoint URI.
     *
     * @return string
     */
    public function getServiceBusEndpointUri() {
        return $this->_serviceBusEndpointUri;
    }

    /**
     * Gets the filter.
     *
     * @return string
     */
    public function getFilter() {
        return $this->_filter;
    }

    /**
     * Depricated!
     * Namespace is now included in the uri.
     * @return string
     */
    public function getNamespace() {
        return $this->_namespace;
    }
}
