<?php

namespace App\Http\Controllers;

use App\Breweries\ApiClient;
use App\Breweries\Brewery;
use Illuminate\Http\Request;

class BreweriesController extends Controller
{
    protected $breweryApiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->breweryApiClient = $apiClient;
    }

    public function index(Request $request)
    {
        $breweries = $this->breweryApiClient->getPaginated($request->query('page', 1));

        return $breweries;
    }


    public function show(Brewery $brewery)
    {
        return $brewery;
    }
}
