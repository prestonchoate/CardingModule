<?php
/**
 * @package     PrestonChoate/CardingPrevention
 * @author      Preston Choate <pchoate15@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);

namespace PrestonChoate\CardingPrevention\Plugin\Magento\Checkout\Model;
use PrestonChoate\CardingPrevention\Model\Config;
use Magento\Checkout\Exception as CheckoutException;
use Magento\Checkout\Model\GuestPaymentInformationManagement;
use Magento\Framework\App\CacheInterface;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\PaymentInterface;

class CardingPreventionPlugin
{
    /** @var CacheInterface  */
    protected $cache;

    /** @var Config  */
    protected $config;

    /**
     * CardingPreventionPlugin constructor.
     * @param CacheInterface $cache
     * @param Config $config
     */
    public function __construct(
        CacheInterface $cache,
        Config $config
    ) {
        $this->cache = $cache;
        $this->config = $config;
    }

    /**
     * @param GuestPaymentInformationManagement $subject
     * @param $cartId
     * @param $email
     * @param PaymentInterface $paymentMethod
     * @param AddressInterface|null $billingAddress
     */
    public function beforeSavePaymentInformationAndPlaceOrder(
        GuestPaymentInformationManagement $subject,
        $cartId,
        $email,
        PaymentInterface $paymentMethod,
        AddressInterface $billingAddress = null)
    {
        $this->checkCartId($cartId);
    }

    /**
     * Checks cart ID and throws exception if it has been used too frequently
     *
     * @param $cartId
     */
    protected function checkCartId($cartId)
    {
        $lifetime = $this->config->getThreshold();
        $lifetime = ctype_digit($lifetime) ? intval($lifetime) : 0;
        if ($this->config->getEnabled() && $lifetime > 0) {
            $data = 'cart id already used';
            $tags = ['carding_prevention'];

            // Check if cartId has been used to post a transaction in the last $threshold seconds
            // then save this instance of that cartId being used and if a value was previously found
            // then throw an exception to drop the connection
            $value = $this->cache->load($cartId);
            $this->cache->save($data, $cartId, $tags, $lifetime);
            if ($value) {
                throw new CheckoutException(__('Too many requests'));
            }

        }
    }
}
