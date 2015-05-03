<?php

require 'vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

class ExampleTest extends TestCase {

    /**
     * @test
     */
	function it_hashes_a_provided_password()
    {
        Hash::shouldReceive('make')->once()->andReturn('foobar_hashed_password');
        $response = $this->action('POST', 'HashingController@postIndex', ['password' => 'foobar_password']);

        assertEquals('Your hashed password is foobar_hashed_password.', $response->getContent());
    }

}
