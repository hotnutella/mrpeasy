<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;



final class StringParserTest extends TestCase
{

    function __construct() {
        parent::__construct();

        // recreate a sample array by spec
        $this -> expected_single_array['TAG_NAME'] = array('description' => 'description', 'data' => 'data');

        $this -> expected_multiple_array = array();
        $this -> expected_multiple_array['CAT'] = array('description' => 'color', 'data' => 'white');
        $this -> expected_multiple_array['DOG'] = array('description' => 'breed', 'data' => 'Cavalier King Charles Spaniel');
        $this -> expected_multiple_array['FISH'] = array('description' => 'size', 'data' => 'Very big');
    }

    public function testShouldBeArray(): void
    {
        $this->assertIsArray(
            StringParser::parseTags(''),
            'should return an array'
        );

        $this->assertSame(
            $this -> expected_single_array,
            StringParser::parseTags('[TAG_NAME:description]data[/TAG_NAME]'),
            'should return an associative array by spec'
        );
    }

    public function testShouldParseMultipleTags() : void
    {
        $stringToParse = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. [CAT:color]white[/CAT]Donec eu magna eu augue placerat vehicula quis eu sapien. Etiam non volutpat urna. Suspendisse faucibus mollis placerat. Aliquam aliquet ac massa sit amet laoreet. [DOG:breed]Cavalier King Charles Spaniel[/DOG] Donec et vulputate lorem. Duis ante neque, ultricies eget hendrerit et, porta at nunc. Nam finibus eu mi eget vulputate. Nulla ornare, arcu a vestibulum tristique, massa velit feugiat felis, vitae interdum est urna eu odio. Pellentesque eget viverra orci. [FISH:size]Very big[/FISH] Quisque a viverra turpis, a interdum leo. Nunc vitae tellus nulla.';
        $this->assertSame(
            $this -> expected_multiple_array,
            StringParser::parseTags($stringToParse),
            'should return an array of multiple tags'
        );
    }

    public function testTagStartAndEndShouldMatch() : void
    {
        $stringToParse = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. [CAT:color]white[/CAT]Donec eu magna eu augue placerat vehicula quis eu sapien.[TURTLE:age]200 years old[/SNAKE] Etiam non volutpat urna. Suspendisse faucibus mollis placerat. Aliquam aliquet ac massa sit amet laoreet. [DOG:breed]Cavalier King Charles Spaniel[/DOG] Donec et vulputate lorem. Duis ante neque, ultricies eget hendrerit et, porta at nunc. Nam finibus eu mi eget vulputate. Nulla ornare, arcu a vestibulum tristique, massa velit feugiat felis, vitae interdum est urna eu odio. Pellentesque eget viverra orci. [FISH:size]Very big[/FISH] Quisque a viverra turpis, a interdum leo. Nunc vitae tellus nulla.';
        $this->assertSame(
            $this -> expected_multiple_array,
            StringParser::parseTags($stringToParse),
            'should return only the tags that match'
        );
    }
}

?>