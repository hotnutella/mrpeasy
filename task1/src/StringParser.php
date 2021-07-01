<?php declare(strict_types=1);

final class StringParser
{
    public static function parseTags(string $inputString): array 
    {
        // tag example - [TAG_NAME:description]data[/TAG_NAME]
        $pattern = '/\[[a-zA-Z_]*:[a-zA-Z0-9.,\-_ ]*\][a-zA-Z0-9öüõä.,\-_ ]*\[\/[a-zA-Z_]*\]/m';
        $result = array();
        preg_match_all($pattern, $inputString, $matches);
    
        foreach ($matches[0] as $match) {
            preg_match('/\[(.*?):/m', $match, $tagNameMatch);
            $tagName = $tagNameMatch[1];
    
            preg_match('/:(.*?)\]/m', $match, $descriptionMatch);
            $description = $descriptionMatch[1];
    
            preg_match('/\](.*?)\[/m', $match, $dataMatch);
            $data = $dataMatch[1];
    
            preg_match('/\[\/(.*?)\]/m', $match, $endingTagNameMatch);
            $endingTagName = $endingTagNameMatch[1];
    
            if ($tagName === $endingTagName) {
                $tag = array();                                                                                                                                              
                $tag[$tagName] = array('description' => $description, 'data' => $data);
                array_push($result, $tag);
            }        
        }
    
        return $result;
    }
}

?>