<?php
namespace Project29k\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoryRepository extends EntityRepository {
 	public function countPublishedTotal($flt) {
		$data = array();
		$em = $this->getEntityManager();

		$query = $em->createQueryBuilder();
		$query->addSelect('COUNT(prj.prjId)');
		$query->from('AzakozoCoreBundle:Projects', 'prj');
		$query->innerJoin('AzakozoCoreBundle:Organizations', 'org', 'WITH', 'prj.orgId = org.orgId');
		foreach($flt as $filter) {
			$query->where($filter['condition']);
			foreach($filter['parameters'] as $k => $v) {
				$query->setParameter($k, $v);
			}
		}
		$data['rows'] = $query->getQuery()->getResult();

		return $data['rows'][0][1];
	}
 	public function getRows($flt, $total, $per_page, $reference, $request, $session_order) {
		$data = array();
		$em = $this->getEntityManager();

		$pages = ceil($total / $per_page);

		$start = ($request->query->get($reference, 1) -1 ) * $per_page;
		if($start < 0 || $request->query->get($reference, 1) > $pages) {
			$start = 0;
			$request->query->set('page', 1);
		}

		$query = $em->createQueryBuilder();
		$query->addSelect('stu.stuIsclosed', 'prj.prjName', 'prj.prjId', 'prj.orgId', 'prj.prjDateStart', 'prj.prjDateDue', 'prj.prjStatus', 'prj.prjPriority', 'org.orgName', 'stu.stuName');
		$query->from('AzakozoCoreBundle:Projects', 'prj');
		$query->innerJoin('AzakozoCoreBundle:Organizations', 'org', 'WITH', 'prj.orgId = org.orgId');
		$query->innerJoin('AzakozoCoreBundle:Statuses', 'stu', 'WITH', 'prj.prjStatus = stu.stuId');
		foreach($flt as $filter) {
			$query->where($filter['condition']);
			foreach($filter['parameters'] as $k => $v) {
				$query->setParameter($k, $v);
			}
		}
		$query->add('orderBy', $session_order);
		$query->setFirstResult($start);
		$query->setMaxResults($per_page);
		$query->addGroupBy('prj.prjId');

		$data['rows'] = $query->getQuery()->getResult();

		return $data;
	}
 	public function findOne($prjId) {
		$em = $this->getEntityManager();

		$query = $em->createQueryBuilder();
		$query->addSelect('stu.stuIsclosed', 'mbr.mbrName', 'prj.prjOwner', 'prj.prjPublished', 'prj.prjDescription', 'prj.prjName', 'prj.prjId', 'prj.orgId', 'prj.prjDateStart', 'prj.prjDateDue', 'prj.prjStatus', 'prj.prjPriority', 'org.orgName', 'stu.stuName');
		$query->from('AzakozoCoreBundle:Projects', 'prj');
		$query->leftJoin('AzakozoCoreBundle:Members', 'mbr', 'WITH', 'prj.prjOwner = mbr.mbrId');
		$query->leftJoin('AzakozoCoreBundle:Organizations', 'org', 'WITH', 'prj.orgId = org.orgId');
		$query->leftJoin('AzakozoCoreBundle:Statuses', 'stu', 'WITH', 'prj.prjStatus = stu.stuId');
		$query->where('prj.prjId = :project');
		$query->setParameter(':project', $prjId);

		return $query->getQuery()->getSingleResult();
	}
 	public function getCategories() {
		$choices = array();
		$em = $this->getEntityManager();
		$connection = $em->getConnection();
		$statement = $connection->prepare('SELECT * FROM category');
		$statement->execute();
		$organizations = $statement->fetchAll();
		$choices = array('' => '-');
		foreach($organizations as $org) {
			$choices[$org['id']] = $org['id'];
		}
		return $choices;
	}
 	public function getStatusesChoices() {
		$choices = array();
		$em = $this->getEntityManager();
		$connection = $em->getConnection();
		$statement = $connection->prepare('SELECT * FROM statuses');
		$statement->execute();
		$statuses = $statement->fetchAll();
		$choices = array('empty' => array('' => '-'));
		foreach($statuses as $stu) {
			$letter = $stu['stu_isclosed'];
			//$letter = $container->get('translator')->trans('Symfony is great');
			if(!array_key_exists($letter, $choices)) {
				$choices[$letter] = array();
			}
			
			$choices[$letter][$stu['stu_id']] = $stu['stu_name'];
		}
		return $choices;
	}
}
