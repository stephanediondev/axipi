<?php
namespace Axipi\BackendBundle\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Page;

class PageManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getById($id);
    }

    public function getRows($language)
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getRows($language);
    }

    public function getLanguages()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getLanguages();
    }

    public function getComponents()
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getComponents();
    }

    public function getPages(Page $page)
    {
        return $this->em->getRepository('AxipiCoreBundle:Page')->getPages($page);
    }

    public function persist($data)
    {
        $attributes = json_decode($data->getComponent()->getAttributesSchema(), true);
        if($attributes) {
            foreach($attributes as $key => $attribute) {
            }

            foreach($data->getAttributesChange() as $key => $attribute) {
                if(isset($attributes[$key]) == 1 && $attributes[$key]['type'] == 'Symfony\Component\Form\Extension\Core\Type\FileType') {
                    if(is_object($attribute) && $attribute instanceof UploadedFile) {
                        if($attribute->isValid()) {
                            if(file_exists('uploads/'.$data->getAttribute('image'))) {
                                @unlink('uploads/'.$data->getAttribute('image'));
                            }
                            $data->setAttribute($key, $attribute->getClientOriginalName());
                            $data->setAttribute($key.'_mime', $attribute->getMimeType());
                            $data->setAttribute($key.'_size', $attribute->getClientSize());
                            $attribute->move('uploads', $attribute->getClientOriginalName());
                        }
                    }
                } else {
                    $data->setAttribute($key, $attribute);
                }
            }
            $data->setAttributesChange([]);
        }

        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($type)
    {
        if(file_exists('uploads/'.$type->getAttribute('image'))) {
            @unlink('uploads/'.$type->getAttribute('image'));
        }

        $this->em->remove($type);
        $this->em->flush();
    }

    public function getEntityName()
    {
        return Page::class;
    }
}
