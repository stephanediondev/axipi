<?php
namespace Axipi\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class FileController extends AbstractController
{
    public function getPage(Request $request, ParameterBag $parameters)
    {
        if($parameters->get('page')->getAttribute('authentication_enabled')) {
            if(
               isset($_SERVER['PHP_AUTH_USER']) == 1 && $_SERVER['PHP_AUTH_USER'] == $parameters->get('page')->getAttribute('authentication_user')
               && isset($_SERVER['PHP_AUTH_PW']) == 1 && $_SERVER['PHP_AUTH_PW'] == $parameters->get('page')->getAttribute('authentication_password')) {
            } else {
                header('WWW-Authenticate: Basic realm="'.$parameters->get('page')->getTitle().'"');
                header('HTTP/1.0 401 Unauthorized');
                exit(0);
            }
        }

        $path = 'uploads/'.$parameters->get('page')->getAttribute('file');
        $filename = substr($path, strripos($path, '/') + 1);

        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: public');
        header('Content-Description: File Transfer');
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        header('Content-Length: '.filesize($path));
        readfile($path);
        session_write_close();
    }
}
