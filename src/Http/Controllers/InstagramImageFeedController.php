<?php

namespace Rvsitebuilder\InstagramImage\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Rvsitebuilder\Manage\Lib\SettingLib;

class InstagramImageFeedController extends Controller
{
    /**
     * Single page application catch-all route.
     */
    public function index(): View
    {
        $url_self = 'https://api.instagram.com/v1/users/self/?access_token=232944893.19bf4ba.ce9a0a87fde242b99a2bce60789c31af';
        $result_self = SettingLib::readJsonFile($url_self);

        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=232944893.19bf4ba.ce9a0a87fde242b99a2bce60789c31af';
        $result = SettingLib::readJsonFile($url);

        return view('rvsitebuilder/instagramimage::ig-feed')
            ->with('ig_info', $result_self)
            ->with('ig_img', $result);
    }
}
