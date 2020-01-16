<?php
declare(strict_types=1);


use PhpCast\TCast;
use PHPUnit\Framework\TestCase;

final class TCastTest extends TestCase{

    public $destination;
    public $source;

    protected function setUp():void
    {
        $this->destination = new class{use TCast;public $id;};
        $this->source = new class{use TCast;public $id;};
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

}