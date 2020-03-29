<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayerControllerTest extends WebTestCase
{
    protected function getBaseURL() {
        return 'http://soccerManagement.local';
    }

    public function testPlayer()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $data = array(
            "firstName"=> "Hancil q",
            "lastName" => "Sequeira",
            "playerImageURI"=>"http:://abc.jpeg"
        );

        $response = $client->get('/api/player', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testPutPlayer()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $data = array(
            "firstName"=> "Hancil q",
            "lastName" => "Sequeira",
            "playerImageURI"=>"http:://abc.jpeg"
        );

        $response = $client->get('/api/player?id=3', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testDeletePlayer()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);


        $response = $client->get('/api/player?playerId=3');

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testPlayerById()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $response = $client->get('/api/player/3');

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testPlayerListBasedOnIdOrNameAction()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $response = $client->get('/api/players/2');

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }
}