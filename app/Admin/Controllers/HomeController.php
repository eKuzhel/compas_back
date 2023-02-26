<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Layout\Content;

/**
 * Class HomeController
 * @package App\Admin\Controllers
 */
final class HomeController extends Controller
{
    /**
     * @param \Encore\Admin\Layout\Content $content
     *
     * @return \Illuminate\Http\RedirectResponse|\Encore\Admin\Layout\Content
     */
    public function index(Content $content)
    {


        return \redirect(\admin_url('regions'));
    }
}
