<?php
namespace Unit;

use Devmobsters\Capo\Queue\QueueMessage;
use PHPUnit\Framework\TestCase;

class QueueMessageTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_the_message()
    {
        $message = new QueueMessage("A message");

        $this->assertEquals("A message", $message->getMessage());
    }
}
