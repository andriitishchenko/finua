<?php

function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}


$xml_raw = "";
if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, 'http://tables.finance.ua/ru/currency/order');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "xajax=load&xajaxr=".date()."&xajaxargs[]=%3Cxjxobj%3E%3Ce%3E%3Ck%3Eevent%3C%2Fk%3E%3Cv%3Einit%3C%2Fv%3E%3C%2Fe%3E%3Ce%3E%3Ck%3Elocation%3C%2Fk%3E%3Cv%3Eua%3C%2Fv%3E%3C%2Fe%3E%3Ce%3E%3Ck%3Ecurrency%3C%2Fk%3E%3Cv%3E*%3C%2Fv%3E%3C%2Fe%3E%3Ce%3E%3Ck%3Etype%3C%2Fk%3E%3Cv%3E*%3C%2Fv%3E%3C%2Fe%3E%3Ce%3E%3Ck%3Epresent%3C%2Fk%3E%3Cv%3E%3C%2Fv%3E%3C%2Fe%3E%3C%2Fxjxobj%3E");
     $xml_raw = curl_exec($curl);
     //echo $xml_raw;
    curl_close($curl);
  }
  // header('Content-type: application/xml');

//$xml_raw = '<foo><content t="111"><![CDATA[Hello, world!]]></content><content t="222">pizda</content></foo>';

  if (isset($xml_raw)) {
      //$xml_raw = iconv("windows-1251", "utf-8", $xml_raw);

      // var_dump( $xml_raw );
      // die();
  		$parser = simplexml_load_string($xml_raw ,'SimpleXMLElement',LIBXML_NOCDATA);

	  // foreach($parser->cmd as $cmd) { 
  	// 	var_dump($parser->cmd);
	  // }
  		 $table = $parser->xpath('//cmd[@t="order-store"]');
     // $table = $parser->xpath('//content[@t="111"]');
  		 var_dump( $table[0] );
       die();
      // echo $table[0];
       $raw_html = br2nl($table[0]);

       $content_xml = simplexml_load_string($raw_html ,'SimpleXMLElement',LIBXML_NOCDATA);

       // $doc = new DOMDocument();
       // $doc->loadHTML();

// http://htmlparsing.com/php.html
// http://sitear.ru/material/php-parsing-html-simple-html-dom

print_r($content_xml);
       // print_r($items);

    // foreach ($rs as $k => $v)
    // {
    //   echo "Xpath:" . $k . " |Value:" . $v . " ";
    //   var_dump($xml->xpath($k));
    //   echo "<br>";
    // }


  }
?>