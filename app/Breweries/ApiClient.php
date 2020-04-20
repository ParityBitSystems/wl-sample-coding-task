<?php

namespace App\Breweries;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class ApiClient
{
    protected $httpClient;
    protected $baseUrl = 'https://api.openbrewerydb.org';

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getPaginated(int $page = 1)
    {
        $breweryIndexData = $this->httpClient->get(
            $this->baseUrl . '/breweries',
            [
               'query' => ['page' => $page]
            ]
        )->getBody()->getContents();

        $breweryIndexData = new Collection(json_decode($breweryIndexData, true));

        return $breweryIndexData->map(function (array $breweryData) {
            return $this->populateBrewery($breweryData);
        });
    }

    public function getBrewery(int $breweryId)
    {
        $breweryData = $this->httpClient->get(
            $this->baseUrl . '/breweries/' . $breweryId
        )->getBody()->getContents();

        $breweryData = json_decode($breweryData, true);

        return $this->populateBrewery($breweryData);
    }

    public function populateBrewery(array $data): Brewery
    {
        $brewery = new Brewery();
        $brewery->fill($data);

        return $brewery;
    }
}