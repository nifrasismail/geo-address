# Geo Address - Importer
This package is help you to import the master data about the geo address for the following fields. 

- Country Code
- Place Name
- Postal Code
- State Code
- State Name
- Province Code
- Province Name
- Community Code
- Community Name
- Latitude
- Longitude

This approach is to import data to database in any supported for Laravel/Lumen

# Installation

```
composer require nertlab/geo-address
```

# Usage

After the installation if you are going to use in Lumen project follow the steps:
## Lumen Usage
Copy the migration file ``0000_00_00_000000_create_nertlab_addresses_table`` from `vendor/nertlab/geo-address/migrations` folder and put into your applications database/migrations folder

There after run the `php artisan migrate` command to create the tables.

There after in your `app/Kernel.php` add the line as follow or update if exist

```php
protected $commands = [
        Nertlab\GeoAddress\commands\AddressImportCommand::class
    ];
``` 

Therafter run the command 
`php artisan nertlab:address-import` and choose the country to import the data

# Currently available countries and country codes
1. LK : Sri Lanka

Other countries available soon.
