<?php

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;

class MailTest extends TestCase {

    protected $mailcatcher;

    function __construct()
    {
        $this->mailcatcher = new Client(['base_url' => 'http://localhost:1080']);
    }

    public function getAllEmails()
    {
        $emails = $this->mailcatcher->get('/messages')->json();

        if (empty($emails)) {
            $this->fail('No messages returned.');
        }

        return $emails;
    }

    public function getLastEmail()
    {
        $emailId = $this->getAllEmails()[0]['id'];

        return $this->mailcatcher->get("/messages/{$emailId}.html");
    }

    public function assertEmailBodyContains($body, Response $email)
    {
        $this->assertContains($body, (string) $email->getBody());
    }

    /**
     * @test
     */
    function it_sends_an_email()
    {
        $this->call('GET', 'emailtest');

        $email = $this->getLastEmail();

        $this->assertEmailBodyContains('Welcome', $email);
    }

}
