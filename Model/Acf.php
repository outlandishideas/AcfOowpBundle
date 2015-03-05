<?php

namespace Outlandish\AcfOowpBundle\Model;

/**
 * Contract to ensure that a model that is stored as an Acf can be converted to an array
 *
 * Interface Acf
 * @package Outlandish\AcfOowpBundle\Model
 */
interface Acf
{
    public function toArray();
}