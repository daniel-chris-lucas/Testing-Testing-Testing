<?php

class MailTest extends MailTestCase {

    /**
     * @test
     */
    function it_sends_an_email()
    {
        $this->call('GET', 'emailtest');

        $email = $this->getLastEmail();

        $this->assertEmailBodyContains('Welcome', $email);
        $this->assertEmailWasSentTo('joe@example.com', $email);
    }

}
