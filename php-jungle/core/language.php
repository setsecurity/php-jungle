<?php
//ESTO AUN FALTA POR IMPLEMENTAR
core\utils\Language::start();//inizializo la sesión de idioma

//cargamos la librerias, streams.php y gettext

//obtengo la sesión que contiene el idioma
$lang = core\utils\Language::getLang();

//los nombres de los ficheros de traducción(.mo) que usaremos , y su clave para referenciarlo
$langFiles=array(//si esta vacio no se implementar el sistema multilenguaje
    'translations'=>LANG_PATH.$lang.DS.'translations.mo'
);


