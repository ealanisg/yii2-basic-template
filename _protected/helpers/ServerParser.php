<?php
/**
 * Server Parser Helper Class.
 * No puede ser un Helper ya que se usa desde fuera de Yii también
 * Se incluye const
 * require(__DIR__ . '/_protected/helpers/ServerParserHelper.php');
 */
class ServerParser
{
    /**
     * Returns an array with parsed parts of the server.
     */
    public static function parse()
    {
        $parts = explode('.', $_SERVER['SERVER_NAME']);
        if(count($parts) > 2) { // has subdomain
            $server = array_combine(['subdomain', 'hostname', 'suffix'], $parts);
        } else {
            $server = array_combine(['hostname', 'suffix'], $parts);
        }
        $server['protocol'] = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true
            ? 'https://' : 'http://';
        $server['isIP'] = ip2long($_SERVER['HTTP_HOST']) !== false;

        return $server;
    }
}
