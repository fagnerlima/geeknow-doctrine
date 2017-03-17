<?php
namespace AppBundle\Filters;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

/**
 * Class StatusFilter
 * @package AppBundle\Filters
 */
class StatusFilter extends SQLFilter
{
    const ACTIVE   = 1,
          INACTIVE = 0;

    /**
     * @var int
     */
    private $status = 1;

    /**
     * Gets the SQL query part to add to a query.
     *
     * @param ClassMetaData $targetEntity
     * @param string $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     * @throws \InvalidArgumentException
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        dump('addFilterConstraint');
//        dump($targetEntity, $targetTableAlias);

        if (!$targetEntity->hasField('status')) {
            throw new \InvalidArgumentException('Does not have the status field.');
        }

        return sprintf('%s.%s = %s', $targetTableAlias, 'status', $this->status);
    }

    /**
     * @param int $status One of the StatusFilter::* constants
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }
}
