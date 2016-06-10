<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class InfoController extends AbstractController
{
    public function dispatchAction(Request $request, $action)
    {
        if(!$this->isGranted('ROLE_INFO')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_search', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $info = [];
        $info['_server'] = $_SERVER;

        $info['function'] = [];
        $info['function']['phpversion'] = phpversion();
        $info['function']['php_sapi_name'] = php_sapi_name();
        $info['function']['get_current_user'] = get_current_user();
        $info['function']['session_name'] = session_name();
        $info['function']['session_id'] = session_id();
        $info['function']['session_save_path'] = session_save_path();

        $info['ini_get'] = [];
        $info['ini_get']['session_save_handler'] = ini_get('session.save_handler');
        $info['ini_get']['session_gc_maxlifetime'] = ini_get('session.gc_maxlifetime');
        $info['ini_get']['file_uploads'] = ini_get('file_uploads');
        $info['ini_get']['upload_tmp_dir'] = ini_get('upload_tmp_dir');
        $info['ini_get']['upload_max_filesize'] = ini_get('upload_max_filesize');
        $info['ini_get']['post_max_size'] = ini_get('post_max_size');
        $info['ini_get']['memory_limit'] = ini_get('memory_limit');
        $info['ini_get']['safe_mode'] = ini_get('safe_mode');
        $info['ini_get']['open_basedir'] = ini_get('open_basedir');

        $info['connection'] = $this->container->get('doctrine')->getConnection();

        $info['symfony'] = \Symfony\Component\HttpKernel\Kernel::VERSION;

        $parameters->set('info', $info);

        return $this->render('AxipiBackendBundle:MaterialDesignLite:info.html.twig', $parameters->all());
    }
}
