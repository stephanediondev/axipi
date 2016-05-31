<?php
namespace Axipi\BackendBundle\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Item;

class WidgetManager extends AbstractManager
{
    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getById($id);
    }

    public function getRows()
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getRows();
    }

    public function getLanguages()
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getLanguages();
    }

    public function getComponents($category)
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getComponents($category);
    }

    public function getZones()
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getZones();
    }

    public function getPagesWidgetRelated($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getPagesWidgetRelated($id);
    }

    public function getPagesParent(Item $item)
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getPagesParent($item);
    }

    public function getLanguageByCode($code)
    {
        return $this->em->getRepository('AxipiCoreBundle:Language')->getByCode($code);
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
        return $data->getId();
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
        return Widget::class;
    }
}
