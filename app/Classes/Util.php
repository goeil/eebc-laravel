<?php

namespace App\Classes;
 
class Util
{
    public function sayHello(string $s)
    {
        echo "Hello $s, from Facade class.";
    }
    public function slugify(string $s)
    {
        $search =  array('Ê', 'É', 'È', 'Ë', 'ê', 'é', 'è', 'ë',
                         'Î', 'Ï', 'î', 'ï',
                         'Â', 'Ô', 'â', 'ô',
                         'Ù', 'Ç', 'ù', 'ç');
        $replace = array('e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
                         'i', 'i', 'i', 'i',
                         'a', 'o', 'a', 'o',
                         'u', 'c', 'u', 'c');
        $str = str_ireplace($search, $replace, strtolower($s));
        $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
        $str = str_replace(' ', '-', $str);
        $str = preg_replace('/\-{2,}/', '-', $str);
        return $str;
    }

    /*
     * https://www.pjgalbraith.com/truncating-text-html-with-php/
     */
    function truncate_words($text, $limit)
    {
        $words = preg_split("/[\n\r\t ]+/", $text, $limit + 1, PREG_SPLIT_NO_EMPTY);
        if ( count($words) > $limit )
        {
            array_pop($words);
            $text = implode(' ', $words);
            //$text = $text . $excerpt_more;
        }
        return $text;
    }

}
