<?php
namespace buildok\helpers\test;

use PHPUnit\Framework\TestCase;
use buildok\helpers\ArrayWrapper;


/**
 * ArrayWrapperTest class
 *
 * Test case for ArrayWrapper
 * @see buildok\betengine\helpers\ArrayWrapper
 */
class ArrayWrapperTest extends TestCase
{
    /**
     * Target object
     * @var ArrayWrapper
     */
    protected $ArrayWrapper;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->ArrayWrapper = new ArrayWrapper;
    }

    /**
     * ArrayWrapper::getData()
     */
    public function testGetData()
    {
        $ret = $this->ArrayWrapper->getData();
        $this->assertTrue(is_array($ret));
    }

    /**
     * ArrayWrapper::getObject()
     */
    public function testGetObject()
    {
        $ret = $this->ArrayWrapper->getObject();
        $this->assertTrue(is_object($ret));
    }

    /**
     * Access to undefined property
     */
    public function testUndefinedProperty()
    {
        $ret = $this->ArrayWrapper->undefined_property;
        $this->assertNull($ret);
    }

    /**
     * Set new property
     */
    public function testNewProperty()
    {
        $this->ArrayWrapper->new_property = 'not null value';
        $this->assertTrue(!is_null($this->ArrayWrapper->new_property));

        return $this->ArrayWrapper;
    }

    /**
     * Checking for exist new property
     *
     * @depends testNewProperty
     */
    public function testExistNewKeyInArray(ArrayWrapper $dw)
    {
        $ret = $dw->getData();
        $this->assertArrayHasKey('new_property', $ret);

        return $dw;
    }

    /**
     * Unsetting property
     *
     * @depends testExistNewKeyInArray
     */
    public function testUnsetProperty(ArrayWrapper $dw)
    {
        $dw->new_property = null;
        $ret = $dw->getData();
        $this->assertFalse(array_key_exists('new_property', $ret));
    }

    /**
     * ArrayWrapper::set()
     *
     * @depends testExistNewKeyInArray
     */
    public function testResetData(ArrayWrapper $dw)
    {
        $newData = ['key' => 'value'];
        $dw->set($newData);
        $ret = $dw->getData();
        $this->assertEquals($newData, $ret);
    }
}