<?php

namespace App\Classes;

use App\Models\Message;
use App\Models\Article;
use App\Models\Evenement;
 
class Util
{
    public function sayHello(string $s)
    {
        echo "Hello $s, from Facade class.";
    }
    public function sansAccent(string $s)
    {
        $search =  array('Ê', 'É', 'È', 'Ë', 'ê', 'é', 'è', 'ë',
                         'Î', 'Ï', 'î', 'ï',
                         'Â', 'Ô', 'â', 'ô',
                         'Ù', 'Ç', 'ù', 'ç');
        $replace = array('e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
                         'i', 'i', 'i', 'i',
                         'a', 'o', 'a', 'o',
                         'u', 'c', 'u', 'c');
        return str_ireplace($search, $replace, $s);
    }
    public function slugify(string $s)
    {
        $str = Util::sansAccent(strtolower($s));
        $str = str_replace(' !', '', $str);
        $str = str_replace(' ?', '', $str);
        $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
        $str = str_replace(' ', '-', $str);
        $str = str_replace('!', '', $str);
        $str = str_replace('?', '', $str);
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

    function transformMarkdown($texte)
    {
        $parsedown = new \Parsedown();
        // Conversion Markdown avec l'outil Parsedown
        $texte = $parsedown->text($texte);

        // Code maison ajouté ensuite
        $texte = preg_replace('/((@carte-[^-]*-\d-?.*@[[:space:]]*){2,})/',
            '<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 align-items-center">$1</div>', $texte);
        $texte = preg_replace_callback('|@(carte-[^-]*-\d-?.*)@|',
            function ($matches)
            {
                foreach ($matches as $match)
                {
                    $string = explode("-", substr($match, 0, -1));
                    $objectClass = $string[1];
                    $objectId = $string[2];
                    $params = (isset ($string[3])) ? $string[3] : '';
                    $object = null;

                    $s = "<div class='card m-2' style=''>";
                    switch($objectClass)
                    {
                    case "message":
                        $object = Message::find($objectId);
                        if (!is_null($object))
                            $s .= view('components.message-card', 
                                  ['message' => $object]);
                        break;
                        
                    case "evenement":
                        $object = Evenement::find($objectId);
                        if (!is_null($object))
                            $s .= view('components.evenement-card', 
                                  ['evenement' => $object]);
                        break;

                    case "article":
                        $object = Article::find($objectId);
                        if (!is_null($object))
                            $s .= view('components.article-card', 
                                  ['article' => $object]);
                        break;
                    }
                    $s .= "</div>";
                    return $s;
                }
            }, $texte);

        return $texte;

    }
}
