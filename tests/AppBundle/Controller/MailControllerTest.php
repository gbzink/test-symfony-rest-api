<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailControllerTest extends WebTestCase {

    public function testGetAll() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/mails');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('application/json', $client->getResponse()->headers->get('Content-Type'));
    }

    public function testGetOne() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/mails/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('application/json', $client->getResponse()->headers->get('Content-Type'));
    }

    public function testCreate() {
        $client = static::createClient();
        $data = array(
            'title' => 'Test mail',
            'body' => 'Test content',
            'sender' => 'test@example.com',
            'receivers' => array(
                'gbzink+test@gmail.com',
                'gbzink+test1@gmail.com',
                'gbzink+test2@gmail.com',
                'gbzink+test3@gmail.com',
            ),
//            'priority' => 5
        );

        $crawler = $client->request('POST', '/mails/', array(), array(), array('CONTENT_TYPE' => 'application/json'), json_encode($data));
        $response = $client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertSame('application/json', $client->getResponse()->headers->get('Content-Type'));
        $finishedData = json_decode($client->getRequest()->getContent(), true);
        $this->assertArrayHasKey('sender', $finishedData);
        $this->assertArrayHasKey('receivers', $finishedData);
        if (isset($finishedData['priority'])) {
            $this->assertGreaterThanOrEqual(1, $finishedData['priority']);
            $this->LessThanOrEqual(5, $finishedData['priority']);
        }
    }

    public function testSendAll() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/send-mails');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('application/json', $client->getResponse()->headers->get('Content-Type'));
    }

}
