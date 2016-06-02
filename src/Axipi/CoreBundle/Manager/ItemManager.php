<?php
namespace Axipi\CoreBundle\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Item;
use Axipi\CoreBundle\Event\ItemEvent;

class ItemManager extends AbstractManager
{
    public function getOne($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getOne($parameters);
    }

    public function getList($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->getList($parameters);
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
                            if(file_exists('uploads/'.$data->getAttribute($key))) {
                                @unlink('uploads/'.$data->getAttribute($key));
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

        if($data->getCode() == null) {
            $data->setCode(uniqid($data->getLanguage()->getCode().'-', false));
        }

        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();

        $event = new ItemEvent($data);
        $this->eventDispatcher->dispatch('item.after_persist', $event);

        return $data->getId();
    }

    public function remove($data)
    {
        $event = new ItemEvent($data);
        $this->eventDispatcher->dispatch('item.before_remove', $event);

        if(file_exists('uploads/'.$data->getAttribute('image'))) {
            @unlink('uploads/'.$data->getAttribute('image'));
        }

        $this->em->remove($data);
        $this->em->flush();
    }
}
