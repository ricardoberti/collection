<?php

/**
 * Class Collection
 * A simple PHP collection class, built over SplFixedArray.
 *
 * @author Ricardo Berti <ricardo.berti@gmail.com>
 */
class Collection implements Iterator, ArrayAccess, Countable, JsonSerializable
{
    /**
     * @var SplFixedArray
     */
    private $items;

    /**
     * Collection constructor.
     */
    public function __construct()
    {
        $this->items = new SplFixedArray(0);
    }

    /**
     * Insert data from array. All keys will be ignored.
     * @param array $array Array to be inserted.
     * @return Collection
     */
    public function addFromArray(array $array)
    {
        foreach ($array as $value) {
            $this->add($value);
        }
        return $this;
    }

    /**
     * Add an item to end of array.
     * @param mixed $item Item to be inserted
     * @return Collection
     */
    public function push($item)
    {
        $this->items->setSize($this->items->count() + 1);
        $this->items[$this->items->count() - 1] = $item;
        return $this;
    }

    /**
     * Add an item to end of array.
     * Alias for push()
     * @param mixed $item Item to be inserted
     * @return Collection
     */
    public function add($item)
    {
        return $this->push($item);
    }

    /**
     * Remove and returns the last item of array.
     * @return mixed
     * @throws UnderflowException
     */
    public function pop()
    {
        if ($this->items->count() == 0)
            throw new UnderflowException('No itens to pop.');
        $item = $this->items[$this->items->count() - 1];
        $this->items->setSize($this->items->count() - 1);
        return $item;
    }

    /**
     * Get item from position of array.
     * @param int $index
     * @return mixed
     * @throws OutOfRangeException
     */
    public function get($index)
    {
        if (!$this->items->offsetExists($index))
            throw new OutOfRangeException("Index $index is out of range.");
        return $this->items[$index];
    }

    //---------- Implemented methods ----------//

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->items->current();
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->items->next();
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->items->key();
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->items->valid();
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->items->rewind();
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->items->offsetExists($offset);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->items->offsetGet($offset);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->add($value);
        //$this->items->offsetSet($offset, $value);
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        $this->items->offsetUnset($offset);
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return $this->items->count();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->items;
    }
}