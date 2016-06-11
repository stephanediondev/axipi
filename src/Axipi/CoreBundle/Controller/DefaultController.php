<?php
namespace Axipi\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Axipi\CoreBundle\Controller\AbstractController;
use Axipi\CoreBundle\Manager\DefaultManager;
use Axipi\CoreBundle\Manager\LanguageManager;
use Axipi\CoreBundle\Manager\ItemManager;

class DefaultController extends AbstractController
{
    protected $defaultManager;

    protected $languageManager;

    protected $itemManager;

    public function __construct(
        DefaultManager $defaultManager,
        LanguageManager $languageManager,
        ItemManager $itemManager
    ) {
        $this->defaultManager = $defaultManager;
        $this->languageManager = $languageManager;
        $this->itemManager = $itemManager;
    }

    public function indexAction(Request $request, $slug, $language = null)
    {
        $parameters = new ParameterBag();
        $parameters->set('request', $request);

        $languages = $this->languageManager->getList(['active' => true]);

        $this->defaultManager->setLanguages($languages);
        $parameters->set('languages', $languages);

        $language_filter = 'en';

        if(count($languages) > 1) {
            $codes = [];
            foreach($languages as $language) {
                $codes[] = $language->getCode();
            }
            $language = substr($slug, 0, 2);
            if(!in_array($language, $codes)) {
                //return $this->redirectToRoute('axipi_core_slug', ['slug' => 'en/'.$slug]);
            } else {
                $language_filter = $language;
            }
            $slug = substr($slug, 3);
        }

        if(substr($slug, -1) == '/') {
            $slug = substr($slug, 0, -1);
        }
        $page = $this->itemManager->getOne(['slug' => $slug, 'active' => true, 'language_code' => $language_filter]);
        if(!$page) {
            $page = $this->itemManager->getOne(['component_service' => 'axipi_content_controller_error404', 'category' => 'page', 'active' => true]);
        }

        $request->setLocale($page->getLanguage()->getCode());

        $this->defaultManager->setPage($page);
        $parameters->set('page', $page);

        if($this->has($page->getComponent()->getService())) {
            $response = $this->forward($page->getComponent()->getService().':getPage', ['parameters' => $parameters]);
            return $response;
        } else {
            throw new NotFoundHttpException();
        }
    }
}
