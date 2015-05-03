<?php namespace spec;

use Illuminate\Hashing\HasherInterface;
use Illuminate\Http\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HashingControllerSpec extends ObjectBehavior
{
    function let(HasherInterface $hasher, Request $request)
    {
        $this->beConstructedWith($hasher, $request);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('HashingController');
    }

    function it_hashes_a_provided_password(HasherInterface $hasher, Request $request)
    {
        $request->get('password')->shouldBeCalled();
        $hasher->make(Argument::any())->willReturn('foobar_hashed_password');

        $this->postIndex()->shouldReturn('Your hashed password is foobar_hashed_password.');
    }
}
