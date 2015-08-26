# Market Trade Processor

Demo application that processes currency exchange transactions using [Laravel Lumen](http://lumen.laravel.com/).

## Requirements

- PHP >= 5.5.9 with OpenSSL, Mbstring, Tokenizer, PDO and SQLite extensions.
- [Composer](https://getcomposer.org) command available via your `$PATH` shell variable.

## Install

To install the application run these commands:

	git clone https://github.com/Stolz/MarketTradeProcessor.git --depth 1
	cd MarketTradeProcessor && composer install --no-dev

## Configure

**Note:** From now on all the suggested commands must be executed within the `MarketTradeProcessor` directory created in the previous step.

For the application to work first the database has to be populate with initial data by running:

	cp .env.example .env
	touch storage/database.sqlite
	php artisan migrate --seed

## Use

To be able to use the message consumer and the messages front-end run the next command:

	php artisan serve

This will start the application using PHP's built-in web server and it will give you access to <http://localhost:8000/>, the only endpoint of the application.

- Send a **GET** HTTP request to the [endpoint](http://localhost:8000/) to show the messages front-end. You may simply use your browser.
- Send a **POST** HTTP request to the [endpoint](http://localhost:8000/) to queue new messages for the message processor. You may use the form available in the front-end to send such request.

To execute the message processor run from another console the next command:

	php artisan queue:work --daemon

## Testing

	composer install
	./vendor/bin/phpunit

## Notes

- For demonstration purposes *debug/development* mode is intentionally enabled by default.
- For the sake of simplicity the [database](http://lumen.laravel.com/docs/database#configuration), [session](http://lumen.laravel.com/docs/session#introduction), [queue](http://lumen.laravel.com/docs/queues#configuration) and [cache](http://lumen.laravel.com/docs/cache#configuration) features are configured to use SQLite but other options such MySQL, Postgres, SQL Server, Memcached, Beanstalkd, Amazon SQS, IronMQ or Redis may be used by following the provided links.

## License

MIT License
© [Stolz](https://github.com/Stolz)

Read the provided `LICENSE` file for details.
