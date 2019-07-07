<?php

Route::get('/{any}', 'WebController@home')->where('any', '^(?!api).*$');
