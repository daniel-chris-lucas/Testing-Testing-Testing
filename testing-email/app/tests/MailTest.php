<?php

class MailTest extends TestCase {

    /**
     * @test
     */
    function it_sends_an_email()
    {
        $mock = Mockery::mock('Swift_Mailer');
        $this->app['mailer']->setSwiftMailer($mock);

        $mock->shouldReceive('send')->once()->andReturnUsing(function ($message) {
            $this->assertArrayHasKey('joe@example.com', $message->getTo());
        });

        $this->call('GET', 'emailtest');
    }

}
