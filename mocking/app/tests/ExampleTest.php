<?php

class Curl {
    public function post()
    {
        return 'post request was made';
    }
}

class Newsletter {
    protected $curl;

    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    public function addToList($listName)
    {
        $data = [
            'email' => 'foo@bar.com',
            'list'  => $listName
        ];

        return $this->curl->post($data);
    }
}

class ExampleTest extends TestCase {

    public function tearDown()
    {
        Mockery::close();
    }

	public function test_adds_user_to_newsletter_list()
	{
        // Arrange
        $curl = Mockery::mock('Curl');
        $curl->shouldReceive('post')->once()->andReturn('mocked');

        // Act
        $newsletter = new Newsletter($curl);
        $result = $newsletter->addToList('foo-list');

        // Assert
        $this->assertEquals('mocked', $result);
	}

}