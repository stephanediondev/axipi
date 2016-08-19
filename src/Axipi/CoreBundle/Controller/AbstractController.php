<?php
namespace Axipi\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{
    public function displayError($code) {
        return $this->forward('axipi_backend_controller_error:indexAction', ['code' => $code]);
    }
}
