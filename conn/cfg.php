<?php

if($_SERVER['HTTP_HOST'] == 'localhost:82' || $_SERVER['HTTP_HOST'] == 'localhost' )
{
    define("DBSERVERNAME", "localhost");
	define("DBUSERNAME", "cristianb");
	define("DBPASSWORD", "511xpWgxUR4icML4");
	define("DBNAME", "kahlo_web_2");
	define("DEPURAR", 0);
	define("BASEURL", "http://localhost/kahlo_web_2025");
}
else
{
    define("DBSERVERNAME", "localhost");
	define("DBUSERNAME", "c2110196_sk");
	define("DBPASSWORD", "poGEve59wi");
	define("DBNAME", "c2110196_sk");
	define("DEPURAR", 0);
	define("BASEURL", "https://somoskahlo.com");
}
