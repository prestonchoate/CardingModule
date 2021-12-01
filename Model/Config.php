<?php
/**
 * @package     PrestonChoate/CardingPrevention
 * @author      Preston Choate <pchoate15@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);

namespace PrestonChoate\CardingPrevention\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const CARDING_PREVENTION_ENABLED_CONFIG_PATH = 'carding_prevention/general/enabled';
    const CARDING_PREVENTION_THRESHOLD_CONFIG_PATH = 'carding_prevention/general/threshold';

    /** @var ScopeConfigInterface  */
    protected $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return bool
     */
    public function getEnabled($scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null): bool
    {
        return $this->scopeConfig->getValue(self::CARDING_PREVENTION_ENABLED_CONFIG_PATH, $scopeType, $scopeCode) ? true : false;
    }

    /**
     * @param string $scopeType
     * @param null $scopeCode
     * @return string
     */
    public function getThreshold($scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null): string
    {
        return $this->scopeConfig->getValue(self::CARDING_PREVENTION_THRESHOLD_CONFIG_PATH, $scopeType, $scopeCode);
    }
}
