<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Boyonglab\Theresia\Core\Http\Request;

final class RequestTest extends TestCase
{
    private static $request;

    public static function setUpBeforeClass(): void
    {
        $_SERVER['REQUEST_URI'] = '/test-link?token=fgfd4543sdsdf#prodocts';
        $_SERVER['QUERY_STRING'] = 'token=fgfd4543sdsdf';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        self::$request = new Request();
    }

    public function testGetUri(): void
    {
        $this->assertEquals($_SERVER['REQUEST_URI'], self::$request->getUri());
    }

    public function testGetPath(): void
    {
        $this->assertEquals('/test-link', self::$request->getPath());
    }

    public function testGetQuery(): void
    {
        $this->assertEquals(['token' => 'fgfd4543sdsdf'], self::$request->getQuery());
        $this->assertEquals('fgfd4543sdsdf', self::$request->getQuery('token'));
    }

    public function testGetMethod(): void
    {
        $this->assertNotEquals($_SERVER['REQUEST_METHOD'], self::$request->getMethod());
        $this->assertEquals(strtolower($_SERVER['REQUEST_METHOD']), self::$request->getMethod());
    }

    public static function tearDownBAfterClass(): void
    {

         unset(self::$request);
         unset($_SERVER['REQUEST_URI']);
         unset($_SERVER['QUERY_STRING']);
         unset($_SERVER['REQUEST_METHOD']);
    }

}
