<?php

namespace App\Breweries;

use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $perPage = 20;

        $breweryIndexData = $this->httpClient->get(
            $this->baseUrl . '/breweries',
            [
               'query' => [
                   'page' => $page,
                   'per_page' => $perPage
               ]
            ]
        )->getBody()->getContents();


        // Sadly, the regular paginator won't give a next link unless it is given the entire collection.
        // The LengthAwarePagination requires the total length of the dataset, which we don't know programatically.
        // However, the data source for this indicates the length is 8027 so we will use that to illustrate the feature
        return (new Collection(json_decode($breweryIndexData, true)))
            ->map(function (array $breweryData) {
                return $this->populateBrewery($breweryData);
            })->pipe(function (Collection $collection) use ($page, $perPage) {
                return new LengthAwarePaginator($collection, 8027, $perPage, $page, ['path' => '/api/breweries']);
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