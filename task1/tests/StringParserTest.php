<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class StringParserTest extends TestCase
{
    public function testShouldBeArray(): void
    {
        $this->assertIsArray(
            StringParser::parseTags(''),
            'should return an array'
        );
    }
}

?>