<?php
Route::delete('/game', 'GameController@delete');
Route::post('/game/generate-map', 'GameController@generateMap');
Route::post('/game/join', 'GameController@join');
