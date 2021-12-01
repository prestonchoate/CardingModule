# PrestonChoate CardingPrevention

```#bash
PrestonChoate/module-carding-prevention
```

- [Main Functionalities](#markdown-header-main-functionalities)
- [Installation](#markdown-header-installation)
- [Configuration](#markdown-header-configuration)
- [Specifications](#markdown-header-specifications)

## Main Functionalities

This module adds a plugin before `\Magento\Checkout\Model\GuestPaymentInformationManagement::savePaymentInformationAndPlaceOrder` that will log the used cart ID to the configured caching service (most likely redis). If that cart ID is used again within the configured threshold the transaction will be canceled.

## Installation

To install via Composer you need to add this repository to your Magneto project.

`composer config repositories.prestonchoate '{"type": "vcs","url": "git@github.com:prestonchoate/CardingModule.git"}'`

Then require the module with:

`composer require PrestonChoate/module-carding-prevention`

Finally run the following commands to fully install the module:

```#bash
bin/magento module:enable PrestonChoate_CardingModule
bin/magento setup:upgrade
bin/magento cache:flush
```

## Configuration

There are two configurations for this module. They both are located at Stores -> Configuration -> Security -> Carding Prevention

- General
  - Enabled - This controls enabling and disabling the module as a whole
- Threshold
  - This will set the number of seconds between requests that a user must wait to post another transaction with the same Cart ID

## Specifications

A model is supplied for retrieving configurations at `\PrestonChoate/CardingPrevention/Model/Config.php`.
The main plugin exists at `\PrestonChoate\CardingPrevention\Plugin\Magento\Checkout\Model\CardingPreventionPlugin`
