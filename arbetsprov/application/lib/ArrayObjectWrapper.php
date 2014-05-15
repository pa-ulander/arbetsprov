<?php
/**
 * ArrayObject wrapper to allow for paralel array maps in memory
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since  Nov 2010
 * @package arbetsprov
 */
class ArrayObjectWrapper implements IteratorAggregate {

    /**
     * The wrapped ArrayObject instance
     *
     * @var ArrayObject
     */
    private $oContainer;

    /**
     * Getter for the Container ArrayObject
     *
     * @return ArrayObject
     */
    private function getContainer () {
        return $this->oContainer;
    }

    /**
     * Setter for the Container ArrayObject
     *
     * @param ArrayObject $p_oContainer
     */
    private function setContainer (ArrayObject $p_oContainer) {
        $this->oContainer = $p_oContainer;
    }

    /**
     * Constructor which instantiates $this->oContainer
     *
     * @param array $p_aArray Optional
     * @param int $p_iFlags Optional
     */
    public function __construct ($p_aArray = array(), $p_iFlags = null) {
        $this->setContainer(new ArrayObject($p_aArray, $p_iFlags));
    }

    /**
     * Does an append() call on the wrapped ArrayObject instance
     *
     * @param mixed $p_mObjectToAppend
     */
    public function append ($p_mObjectToAppend) {
        $this->getContainer()->append($p_mObjectToAppend);
    }

    /**
     * Does a count() call on the wrapped ArrayObject instance
     *
     * @return int Number of elements in $this->oContainer
     */
    public function count () {
        return $this->getContainer()->count();
    }

    /**
     * Does a getIterator() call on the wrapped ArrayObject instance
     *
     * @return ArrayIterator The iterator of $this->oContainer
     */
    public function getIterator () {
        return $this->getContainer()->getIterator();
    }

    /**
     * Does an offsetExists() call on the wrapped ArrayObject instance
     *
     * @param mixed $p_mIndex
     * @param bool True if $p_mIndex is set, otherwise false
     */
    public function offsetExists ($p_mIndex) {
        return $this->getContainer()->offsetExists($p_mIndex);
    }

    /**
     * Does an offsetGet() call on the wrapped ArrayObject instance
     *
     * @param mixed $p_mIndex
     * @return mixed Stored object (variable) having index $p_mIndex
     */
    public function offsetGet ($p_mIndex) {
        return ($this->getContainer()->offsetExists($p_mIndex) ? $this->getContainer()->offsetGet($p_mIndex) : '');
    }

    /**
     * Does an offsetSet() call on the wrapped ArrayObject instance
     *
     * @param mixed $p_mIndex
     * @param mixed $p_mValue
     */
    public function offsetSet ($p_mIndex, $p_mValue) {
        $this->getContainer()->offsetSet($p_mIndex, $p_mValue);
    }

    /**
     * Does an offsetUnset() call on the wrapped ArrayObject instance
     *
     * @param mixed $p_mIndex
     */
    public function offsetUnset ($p_mIndex) {
        $this->getContainer()->offsetUnset($p_mIndex);
    }
}