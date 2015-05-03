<?php

class MailTest extends TestCase {

    /**
     * @test
     */
    function it_sends_an_email()
    {
        Mail::should
        $this->call('GET', 'emailtest');
    }

}
