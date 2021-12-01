<?php
/**
 * @package     PrestonChoate/CardingPrevention
 * @author      Preston Choate <pchoate15@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'PrestonChoate_CardingPrevention',
    __DIR__
);
