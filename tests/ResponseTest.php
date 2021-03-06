<?php

namespace Tasteful\TEST;

use PHPUnit\Framework\TestCase;
use Tasteful\Response;

/**
 * @covers \Tasteful\Response
 */
final class ResponseTest extends TestCase
{
    public function testHeaders()
    {
        $headers = [
            "Access-Control-Allow-Origin: *",
            "Access-Control-Allow-Methods: DELETE, GET, HEAD, OPTIONS, POST, PUT",
            "Access-Control-Allow-Headers: Authorization, Content-Type"
        ];

        $response = new Response\OK\JSON(array());
        $this->assertEquals($headers, array_slice($response->headers, 0, 3));

        $response = new Response\Conflict();
        $this->assertEquals($headers, array_slice($response->headers, 0, 3));

        $response = new Response\NotFound();
        $this->assertEquals($headers, array_slice($response->headers, 0, 3));

        $response = new Response\NoContent();
        $this->assertEquals($headers, array_slice($response->headers, 0, 3));

        $_SERVER["HTTP_HOST"] = "localhost";
        $response = new Response\Created("/examples/100");
        $this->assertEquals($headers, array_slice($response->headers, 0, 3));

        $response = new Response\NotImplemented();
        $this->assertEquals($headers, array_slice($response->headers, 0, 3));

        $response = new Response\UnprocessableEntity();
        $this->assertEquals($headers, array_slice($response->headers, 0, 3));
    }
}
