# PHP Rest API

Making a php based rest api for a testing purposes.
So far all methods work and API do what it is supposed to do.

## Getting Started

Clone this repository:

```
git clone https://github.com/nenadfilipovic/php-rest-api
```

### Prerequisites

Prepare your hosting server, edit config files and upload them to your host.
Run dbInstall.php to create your mySQL table.
After that you are ready to go.

### Installing

First you want to go to phpMyAdmin and create database and save somewhere username, password, database name.
After that edit all php files and change username, password, database name in each file and add auth key in post_data.php file.

```
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mydb";
```

Upload all php files to your hosting, run dbInstall.php file by navigating to it from your browser. Table should be created and message will show you if you successfully created table.

## Running the tests

If you want to post something into this api use Postman and using POST request send (`item_sku`, `item_name`, `item_price`, `item_quantity`) as JSON.
Keep in mind that sku, price and quantity must be int.
Request will fail if you attempt to send letters.

### Break down into end to end tests

-

### And coding style tests

-

## Deployment

Upload code via sftp or whatever.

## Built With

* [PHP](https://www.php.net/)

## Authors

* **Nenad Filipovic** - *Initial work* - [nenadfilipovic](https://github.com/nenadfilipovic)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

-
