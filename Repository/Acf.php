<?php

namespace Outlandish\AcfOowpBundle\Repository;

use Outlandish\AcfOowpBundle\Exception\InvalidRepeaterFieldNameException;
use Outlandish\AcfOowpBundle\Exception\NotRepeaterException;
use Outlandish\AcfOowpBundle\Wrapper\Acf as AcfWrapper;
use Outlandish\AcfOowpBundle\Model\Acf as AcfModel;

/**
 * The Acf Repository creates, updates, deletes and fetches arrays from acf repeater or flexible field
 *
 * Interface Acf
 * @package Outlandish\AcfOowpBundle\Repository
 */
class Acf
{
    /**
     * @var AcfWrapper
     */
    private $acf;

    public function __construct(AcfWrapper $acf)
    {
        $this->acf = $acf;
    }

    public function getField($fieldKey, $postId = 'options', $format = true)
    {
        $field = $this->acf->getField($fieldKey, $postId, $format);

        $this->validateRepeaterField($field);

        return $field;
    }

    /**
     * @param string $fieldKey
     * @param string $idKey
     * @param mixed  $id
     * @param string $postId
     * @param bool   $format
     *
     * @return null
     */
    public function fetch($fieldKey, $idKey, $id, $postId = 'options', $format = true)
    {
        $field = $this->getField($fieldKey, $postId, $format);

        return $this->fetchRow($idKey, $id, $field);
    }

    /**
     * @param mixed $field
     *
     * @return bool
     */
    protected function isRepeaterField($field)
    {
        return is_array($field);
    }

    /**
     * @param array $field
     *
     * @return bool
     */
    protected function hasRows(array $field)
    {
        return !empty($field);
    }

    /**
     * @param string $idKey
     * @param array  $field
     *
     * @throws InvalidRepeaterFieldNameException
     */
    protected function idKeyExists($idKey, array $field)
    {
        if (!array_key_exists($idKey, $field[0])) {
            throw new InvalidRepeaterFieldNameException();
        }
    }

    /**
     * @param string $field
     *
     * @throws NotRepeaterException
     */
    protected function validateRepeaterField($field)
    {
        if (!$this->isRepeaterField($field)) {
            throw new NotRepeaterException();
        }
    }

    /**
     * @param string     $fieldKey
     * @param string     $idKey
     * @param mixed      $id
     * @param string|int $postID
     *
     * @throws InvalidRepeaterFieldNameException
     * @throws NotRepeaterException
     */
    public function delete($fieldKey, $idKey, $id, $postID = 'options')
    {
        $field = $this->acf->getField($fieldKey, $postID);

        $this->validateRepeaterField($field);

        if ($this->hasRows($field)) {
            $this->idKeyExists($idKey, $field);

            $newValue = $this->filterFieldRows($idKey, $id, $field);

            $this->acf->updateField($fieldKey, $newValue, $postID);
        }


    }

    /**
     * @param string     $fieldKey
     * @param AcfModel   $model
     * @param int|string $postId
     *
     * @return bool
     */
    public function create($fieldKey, AcfModel $model, $postId)
    {
        $field = $this->acf->getField($fieldKey, $postId);

        $field[] = $model->toArray();

        return $this->acf->updateField($fieldKey, $field, $postId);
    }

    /**
     * @param string   $fieldKey
     * @param string   $idKey
     * @param AcfModel $model
     * @param string   $postID
     *
     * @throws InvalidRepeaterFieldNameException
     * @throws NotRepeaterException
     */
    public function update($fieldKey, $idKey, AcfModel $model, $postID = 'options')
    {
        $field = $this->getField($fieldKey, $postID);

        if ($this->hasRows($field)) {
            $this->idKeyExists($idKey, $field);
            $newRow = $model->toArray();

            foreach ($field as &$row) {
                if ($row[$idKey] == $newRow[$idKey]) {
                    $row = $newRow;
                    break;
                }
            }
        }

        $this->acf->updateField($fieldKey, $field, $postID);
    }

    /**
     * @param $idKey
     * @param $id
     * @param $field
     * @return array
     */
    protected function filterFieldRows($idKey, $id, $field)
    {
        return array_filter($field, function ($row) use ($idKey, $id) {
            return $row[$idKey] != $id;
        });
    }

    /**
     * @param $idKey
     * @param $id
     * @param $field
     *
     * @return null|array
     */
    protected function fetchRow($idKey, $id, $field)
    {
        if ($this->hasRows($field)) {
            $this->idKeyExists($idKey, $field);

            foreach ($field as $row) {
                if ($row[$idKey] == $id) {
                    return $row;
                }
            }
        }

        return null;
    }
}
