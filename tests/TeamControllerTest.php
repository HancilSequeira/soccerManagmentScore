<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    protected function getBaseURL() {
        return 'http://soccerManagement.local';
    }

    public function testCreateTeam()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $data = array(
            "name"=>"test",
            "logoURI=">"http:://abc.jpeg"
        );

        $response = $client->get('/api/team',['body' => json_encode($data)]);

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testPutTeam()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $data = array(
            "name"=>"test",
            "logoURI=">"http:://abc.jpeg"
        );

        $response = $client->get('/api/team?id=3', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testAddPlayerToTeam()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $data = array(
            "teamId"=>1,
            "playerId"=>3
        );

        $response = $client->get('/api/team-players', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testTeamListAction()
    {
        $client = new \GuzzleHttp\Client([
            'base_url' => $this->getBaseURL(),
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $response = $client->get('/api/players');

        $this->assertEquals(200, $response->getStatusCode());
        $finishedData = json_decode($response->getBody(true), true);
    }

    public function testPlayerListBasedOnTeamAction()
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