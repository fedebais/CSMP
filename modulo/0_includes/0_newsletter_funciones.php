<?php

function convertLatin1ToHtml($str) {
    $html_entities = array (
        "&" =>  "&amp;",        #ampersand   
        "�" =>  "&aacute;",     #latin small letter a
        "�" =>  "&Acirc;",      #latin capital letter A
        "�" =>  "&acirc;",      #latin small letter a
        "�" =>  "&AElig;",      #latin capital letter AE
        "�" =>  "&aelig;",      #latin small letter ae
        "�" =>  "&Agrave;",     #latin capital letter A
        "�" =>  "&agrave;",     #latin small letter a
        "�" =>  "&Aring;",      #latin capital letter A
        "�" =>  "&aring;",      #latin small letter a
        "�" =>  "&Atilde;",     #latin capital letter A
        "�" =>  "&atilde;",     #latin small letter a
        "�" =>  "&Auml;",       #latin capital letter A
        "�" =>  "&auml;",       #latin small letter a
        "�" =>  "&Ccedil;",     #latin capital letter C
        "�" =>  "&ccedil;",     #latin small letter c
        "�" =>  "&Eacute;",     #latin capital letter E
        "�" =>  "&eacute;",     #latin small letter e
        "�" =>  "&Ecirc;",      #latin capital letter E
        "�" =>  "&ecirc;",      #latin small letter e
        "�" =>  "&Egrave;",     #latin capital letter E
		"�" =>  "&Oacute;",
		"�" =>  "&oacute;",
		"�" =>  "&Ograve;",
		"�" =>  "&ograve;",
		"�" =>  "&Ocirc;",     
        "�" =>  "&ocirc;",
        "�" =>  "&ucirc;",      #latin small letter u
        "�" =>  "&Ugrave;",     #latin capital letter U
        "�" =>  "&ugrave;",     #latin small letter u
        "�" =>  "&Uuml;",       #latin capital letter U
        "�" =>  "&uuml;",       #latin small letter u
        "�" =>  "&Yacute;",     #latin capital letter Y
        "�" =>  "&yacute;",     #latin small letter y
        "�" =>  "&yuml;",       #latin small letter y
        "�" =>  "&Yuml;",       #latin capital letter Y
		"�" =>  "&bull;",       #latin capital letter Y
		"�" =>  "&raquo;",      #latin capital letter Y
		"�" =>  "&laquo;",
		"�" =>  "&middot;",
    );

    foreach ($html_entities as $key => $value) {
        $str = str_replace($key, $value, $str);
    }
    return $str;
} 


?>