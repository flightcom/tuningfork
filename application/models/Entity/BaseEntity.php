<?php

namespace Entity;

class BaseEntity
{
    const RELATION_ONE = 0;
    const RELATION_MANY = 1;

    public function canAccess($identity)
    {
        return true;
    }

    public function __set($attribute, $value)
    {
        $setter = 'set' . ucfirst($attribute);

        $this->$setter($value);
    }

    /**
     * @param $function
     * @param $args
     * @return mixed
     */
    public function __call($function, $args)
    {
        $attribute = null;

        // For Getters
        if (substr($function, 0, 3) === 'get') {
            $attribute = lcfirst(substr($function, 3));

            if (property_exists($this, $attribute)) {
                return $this->$attribute;
            }


        }

        // For Setters
        if (substr($function, 0, 3) === 'set') {
            $attribute = lcfirst(substr($function, 3));

            if (property_exists($this, $attribute)) {
                $this->$attribute = $args[0];

                return $this;
            }
        }

        return $this;
    }


    /* IMPORTANT - For the usage of the below definition of the toArray()
    method to easily generate an array out of the object (will be inherited by
    classes extending BaseEntity) the class extending base Entity will need
    to have a $attributes array created and properly filled to serve as its
    input. In order to also consider relationships between objects, the class
    extending base Entity will need to have a $relations array created and
    properly filled (this will serve as input to the utility method
    buildNestedRelationsArray() which enables the usage of toArray() to
    easily generate an array out of the object, inherited from BaseEntity,
    also considering relationships as mentioned) */

    /*

    /**
     * @param array $with
     * @return array
     */
    public function toArray(array $with = [])
    {
        $result = [];

        foreach ($this->attributes as $attr) {
            $getter = 'get' . ucfirst($attr);
            $result[$attr] = $this->$getter();
        }

        $relations = $this->buildNestedRelationsArray($with);

        foreach ($relations as $attr => $nestedRelations) {
            $this->addRelationArray($result, $attr, $nestedRelations);
        }

        $relations = $this->buildNestedRelationsArray(array_keys($this->getRelations()));

        foreach ($relations as $attr => $nestedRelations) {
            $this->addRelationArray($result, $attr, $nestedRelations);
        }

        return $result;
    }

    public function toCascadedArray()
    {
        $allRelations = array_keys($this->getRelations());

        return $this->toArray($allRelations);
    }

    /**
     * Combines all nested relationships for a given key.
     * Example:
     *
     * array('user.friend', 'user.family')
     *
     * returns array('user' => array('friend', 'family'))
     *
     * @param $relations
     * @return array
     */
    protected function buildNestedRelationsArray($relations)
    {
        $response = [];

        foreach($relations as $relation) {
            $nestedRelations = explode('.', $relation);
            $attr = array_shift($nestedRelations);

            if ( ! isset($response[$attr])) {
                $response[$attr] = array_values($nestedRelations);
            } else {
                $response[$attr] = array_merge($response[$attr], array_values($nestedRelations));
            }
        }

        return $response;
    }

    /**
     * @param $relation
     * @param $nestedRelations
     * @return array
     */
    protected function addRelationArray(&$result, $attr, $nestedRelations)
    {
        if ( ! isset($this->relations[$attr])) {
            throw new \InvalidArgumentException($attr . ' is not marked as a relation on ' . get_class($this));
        };

        if ($this->relations[$attr] === self::RELATION_MANY){
            $result[$attr] = $this->getHasManyRelation($attr, $nestedRelations);
        }

        if ($this->relations[$attr] === self::RELATION_ONE) {
            $result[$attr] = $this->getHasOneRelation($attr, $nestedRelations);

            $idAttr = $attr . '_id';

            $result[$idAttr] = isset($result[$attr]['id']) ? $result[$attr]['id'] : null;
        }
    }

    /**
     * @param $relation
     * @param $nestedRelations
     * @return array
     */
    protected function getHasManyRelation($relation, $nestedRelations)
    {
        $hasManyRelations = $this->$relation ? $this->$relation->toArray($nestedRelations) : [];

        return array_map(function ($item) use ($nestedRelations) {
            return $item->toArray($nestedRelations);
        }, $hasManyRelations);
    }

    /**
     * @param $relation
     * @param $nestedRelations
     * @return mixed
     */
    protected function getHasOneRelation($relation, $nestedRelations)
    {
        return $this->$relation ? $this->$relation->toArray($nestedRelations) : false;
    }

    /**
     * @param $date
     * @return \DateTime
     */
    protected function safeDateSet($date)
    {
        if ($date instanceof \DateTime) {
            return $date;
        } else if ($date) {
            $dt = new \DateTime();
            return $dt->createFromFormat('Y-m-d', $date);
        } else {
            return $date;
        }
    }

    /**
     * @param $date
     * @return mixed
     */
    protected function safeDateGet($date)
    {
        return isset($date) ? $date->format('Y-m-d') : $date;
    }

    /**
     * @param $value
     * @return array
     */
    protected function setMultiArrayVariable($value)
    {
        $array = [];

        for ($i = 0; $i < count($value); $i++) {
            if ($value[$i]['selected'] === true) {
                $array[] = $i;
            }
        }
        return $array;
    }

    /**
     * @return array
     */
    protected function getMultiArrayAttribute($attribute, $attributeList)
    {
        $out = [];
        $experienceArray = $attribute;

        if (!is_array($attribute)) {
            $experienceArray = [];
        }

        for ($i = 0; $i < count($attributeList); $i++) {
            $out[] = [
                'name' => $attributeList[$i],
                'selected' => in_array($i, $experienceArray)
            ];
        }

        return $out;
    }

    public function fill($attributes)
    {
        $attributes = (array)$attributes;

        foreach ($attributes as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $this->$setter($value);
        }

        return $this;
    }

    public static function create($attributes)
    {
        $entity = new static;

        return $entity->fill($attributes);
    }

    public function update($attributes)
    {
        return $this->fill($attributes);
    }

}
