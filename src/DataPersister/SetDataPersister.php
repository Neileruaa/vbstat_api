<?php


namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Set;
use App\Repository\SetRepository;
use Doctrine\ORM\EntityManagerInterface;

class SetDataPersister implements DataPersisterInterface
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Set;
    }

    /**
     * @inheritDoc
     */
    public function persist($data)
    {
        $matchId = $data->getMatchs()->getId();
        $num = $this->em->getRepository(Set::class)->findNumberSetByMatch($matchId);
        $data->setNumero($num + 1);
        $this->em->persist($data);
        $this->em->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}
