<?php

use Rvsitebuilder\InstagramImage\Http\Controllers\InstagramImageFeedController;

Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'web',
], function () {
        Route::view('social.rvsitebuilder/igimages', 'rvsitebuilder/instagramimage::ig-images');
        Route::group([
                'prefix' => 'instagramimage',
                'as' => 'instagramimage.',
                'middleware' => 'admin',
        ], function () {
                Route::group([
                        'prefix' => 'instagramfeed',
                        'as' => 'instragramfeed.',
                ], function () {
                        //  'admin.instagramimage.instragramfeed.'
                        Route::get('/', [InstagramImageFeedController::class, 'index'])->name('index');
                });
        });
});
