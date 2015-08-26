<?php

// Frontend endpoint
$app->get('/', 'TradeController@showMessages');

// Consumer endpoint
$app->post('/', 'TradeController@queueMessage');
