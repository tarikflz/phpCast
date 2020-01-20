<?php
declare(strict_types=1);


use PhpCast\TCast;
use PHPUnit\Framework\TestCase;

final class TCastTest extends TestCase{

    public $destination;
    public $source;
    public $mappingSource;

    protected function setUp():void
    {
        $this->destination = new class{use TCast;public $id;};
        $this->source = new class{use TCast;public $id;};
        $this->mappingSource = new class{use TCast;const MAPPING=['id'=>'managerId'];public $managerId;};
        $this->source->id = 12345;
    }

    protected function tearDown() : void
    {
        $this->destination = null;
        $this->source = null;
    }


    public function testCastCopyTheValues(){
        $dest = $this->destination->cast($this->source);
        $this->assertEquals($dest->id,$this->source->id);
    }

    public function testCastMappingWorks(){
        $dest = $this->destination->cast($this->mappingSource);
        $this->assertEquals($dest->id,$this->mappingSource->managerId);
    }

}