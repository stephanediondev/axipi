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
                            if(strstr($attribute->getClientOriginalName(), '.php')) {
                                continue;
                            }
                            if(file_exists('uploads/'.$data->getAttribute($key))) {
                                @unlink('uploads/'.$data->getAttribute($key));
                            }
                            $year = date('Y');
                            if(!is_dir('uploads/'.$year)) {
                                mkdir('uploads/'.$year);
                            }
                            $month = date('m');
                            if(!is_dir('uploads/'.$year.'/'.$month)) {
                                mkdir('uploads/'.$year.'/'.$month);
                            }
                            $dir = $year.'/'.$month;
                            $filename = $this->cleanString($attribute->getClientOriginalName());
                            $data->setAttribute($key, $dir.'/'.$filename);
                            $data->setAttribute($key.'_mime', $attribute->getMimeType());
                            $data->setAttribute($key.'_size', $attribute->getClientSize());
                            $attribute->move('uploads/'.$dir, $filename);
                        }
                    }
                } else {
                    $data->setAttribute($key, $attribute);
                }
            }
            $data->setAttributesChange([]);
        }

        if($data->getComponent()->getCategory() == 'page') {
            if($data->getSlug() == null && !$data->getIsHome()) {
                if($data->getParent()) {
                    $slug = $data->getParent()->getSlug().'/'.$this->cleanString($data->getTitle());
                } else {
                    $slug = $this->cleanString($data->getTitle());
                }
                $data->setSlug($slug);

            } if($data->getSlug() != null && $data->getIsHome()) {
                $data->setSlug(null);
            }
        }

        if($this->testSlug($data)) {
            $slug = $data->getSlug().'-'.uniqid('');
            $data->setSlug($slug);
        }

        if($data->getCode() == null) {
            $data->setCode(uniqid($data->getLanguage()->getCode().'-', false));
        }

        if($this->testCode($data)) {
            $code = $data->getCode().'-'.uniqid('');
            $data->setCode($code);
        }

        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();

        $event = new ItemEvent($data);
        $this->eventDispatcher->dispatch('item.after_persist', $event);

        $this->removeCache();

        return $data->getId();
    }

    public function remove($data)
    {
        $event = new ItemEvent($data);
        $this->eventDispatcher->dispatch('item.before_remove', $event);

        $attributes = json_decode($data->getComponent()->getAttributesSchema(), true);

        if(is_array($attributes)) {
            foreach($attributes as $key => $attribute) {
                if($attribute['type'] == 'Symfony\Component\Form\Extension\Core\Type\FileType') {
                    if(file_exists('uploads/'.$data->getAttribute($key))) {
                        @unlink('uploads/'.$data->getAttribute($key));
                    }
                }
            }
        }

        $this->em->remove($data);
        $this->em->flush();

        $this->removeCache();
    }

    public function removeCache()
    {
        if(function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
        }
    }

    public function testSlug($data)
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->testSlug($data);
    }

    public function testCode($data)
    {
        return $this->em->getRepository('AxipiCoreBundle:Item')->testCode($data);
    }

    function cleanString($str) {
        $allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_.';

        $from = explode(',', 'À,Á,Â,Ã,Ä,Å,à,á,â,ã,ä,å,Ò,Ó,Ô,Õ,Ö,Ø,ò,ó,ô,õ,ö,ø,È,É,Ê,Ë,è,é,ê,ë,Ç,ç,Ì,Í,Î,Ï,ì,í,î,ï,Ù,Ú,Û,Ü,ù,ú,û,ü,ÿ,Ñ,ñ');
        $to = explode(',', 'A,A,A,A,A,A,a,a,a,a,a,a,O,O,O,O,O,O,o,o,o,o,o,o,E,E,E,E,e,e,e,e,C,c,I,I,I,I,i,i,i,i,U,U,U,U,u,u,u,u,y,N,n');
        $str = str_replace($from, $to, $str);

        $str = strtolower($str);

        $str = str_replace('&#039;', '-', $str);
        $str = str_replace('&quot;', '', $str);
        $str = str_replace('&amp;', '-', $str);
        $str = str_replace('&lt;', '', $str);
        $str = str_replace('&gt;', '', $str);
        $str = str_replace('\'', '-', $str);
        $str = str_replace('@', '-', $str);
        $str = str_replace('(', '-', $str);
        $str = str_replace(')', '-', $str);
        $str = str_replace('#', '-', $str);
        $str = str_replace('&', '-', $str);
        $str = str_replace(' ', '-', $str);
        $str = str_replace('_', '-', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('?', '-', $str);
        $str = str_replace(':', '-', $str);
        $str = str_replace('*', '-', $str);
        $str = str_replace('|', '-', $str);
        $str = str_replace('<', '-', $str);
        $str = str_replace('>', '-', $str);
        $str = str_replace('°', '-', $str);
        $str = str_replace(',', '-', $str);

        $strlen = strlen($allowed);
        for($i=0;$i<$strlen;$i++) {
            $accepted[] = substr($allowed, $i, 1);
        }
        $newstr = '';
        $strlen = strlen($str);
        for($i=0;$i<$strlen;$i++) {
            $asc = substr($str, $i, 1);
            if(in_array($asc, $accepted)) {
                $newstr .= $asc;
            }
        }
        while(strstr($newstr, '--')) {
            $newstr = str_replace('--', '-', $newstr);
        }
        if(substr($newstr, -1) == '-') {
            $newstr = substr($newstr, 0, -1);
        }
        return $newstr;
    }
}
