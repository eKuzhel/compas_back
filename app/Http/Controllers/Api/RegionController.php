<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Routing\Controller;

class RegionController extends Controller
{
    public function index(): array
    {
        return [
            'list'=> Region::query()->select('id', 'name')->orderBy('order_number')->get()->all()
        ];
    }
}
