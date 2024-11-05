<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8085/', 
        ]);
    }

    public function addAvion($data)
    {
        try {
            $response = $this->client->post('addAvion', [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }
    public function getAvions()
{
    try {
        $response = $this->client->get('avions', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}
//deleteavion
public function deleteAvion($id)
{
    try {
        $response = $this->client->delete("avion/{$id}", [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

//bus
public function addBus($data)
    {
        try {
            $response = $this->client->post('addBus', [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }
    public function getBus()
{
    try {
        $response = $this->client->get('buses', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}
//bateau
public function addBateau($data)
    {
        try {
            $response = $this->client->post('addBateau', [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }
    public function getBateau()
{
    try {
        $response = $this->client->get('bateaux', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}
//Activite
public function addMuseeLouvre($data)
    {
        try {
            $response = $this->client->post('addMuseeLouvre', [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }
    public function getMuseeLouvre()
{
    try {
        $response = $this->client->get('museelouvre', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}
//yuga
public function addYuga($data)
    {
        try {
            $response = $this->client->post('addYuga', [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }
    public function getYuga()
{
    try {
        $response = $this->client->get('yuga', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}
//welovegreen
public function addWeLoveGreen($data)
{
    try {
        // Adjust the endpoint URL as necessary
        $response = $this->client->post('addWeLoveGreen', [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

    public function getWeLoveGreen()
{
    try {
        $response = $this->client->get('weLoveGreens', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

//
public function addEstc($data)
{
    try {
        // Adjust the endpoint URL for adding Estc records
        $response = $this->client->post('addEstc', [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

public function getEstcs()
{
    try {
        // Adjust the endpoint URL for retrieving Estc records
        $response = $this->client->get('estc', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}


public function getBookings()
    {
        try {
            $response = $this->client->get('booking', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }


    public function getFedexs()
    {
        try {
            $response = $this->client->get('fedex', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
            ];
        }
    }


    public function addFedex($data)
{
    try {
        $response = $this->client->post('addFedEx', [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

public function addBooking($data)
{
    try {
        $response = $this->client->post('addBooking', [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}


public function addPollution($data)
{
    try {
        $response = $this->client->post('addPollution', [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

public function getPollutions()
{
    try {
        $response = $this->client->get('pollution', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

public function deletePollution($id)
{
    try {
        $response = $this->client->delete("pollution/{$id}", [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

public function addSecurite($data)
{
    try {
        $response = $this->client->post('addSecurites', [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

public function getSecurites()
{
    try {
        $response = $this->client->get('securite', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}

public function deleteSecurite($id)
{
    try {
        $response = $this->client->delete("securite/{$id}", [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (RequestException $e) {
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'response' => $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null,
        ];
    }
}





}