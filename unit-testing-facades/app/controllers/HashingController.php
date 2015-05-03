<?php

use Illuminate\Hashing\HasherInterface;
use Illuminate\Http\Request;

class HashingController extends BaseController {

    /**
     * @var Illuminate\Hashing\HasherInterface
     */
    private $hasher;

    /**
     * @var Illuminate\Http\Request
     */
    private $request;

    /**
     * @param HasherInterface $hasher
     * @param Request $request
     */
    function __construct(HasherInterface $hasher, Request $request)
    {
        $this->hasher = $hasher;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return View::make('hash.index');
    }

    /**
     * @return string
     */
    public function postIndex()
    {
        $hashedPassword = $this->hasher->make($this->request->get('password'));

        return "Your hashed password is {$hashedPassword}.";
    }

}
