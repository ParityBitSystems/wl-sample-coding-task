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

    public function index()
    {
        $breweries = $this->breweryApiClient->getPaginated(1);
    }


    public function show(Brewery $brewery)
    {
        return $brewery;
    }
}
