<?php

use App\Commands\StartBatchCommand;
use App\Entities\Batch;
use App\Exceptions\DatabaseException;
use App\Services\BatchService;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartBatchCommandTest extends TestCase
{
    private BatchService $batchService;
    private InputInterface $inputInterface;
    private OutputInterface $outputInterface;

    protected function setUp(): void
    {
        $this->batchService = Mockery::mock(BatchService::class);

        $this->inputInterface = Mockery::mock(InputInterface::class);
        $this->outputInterface = Mockery::mock(OutputInterface::class);
    }

    protected function getStartBatchCommand(): StartBatchCommand
    {
        return new StartBatchCommand('batch:start', $this->batchService);
    }

    /**
     * @throws ReflectionException
     */
    private function makeExecutePublic(): ReflectionMethod
    {
        $class = new ReflectionClass(StartBatchCommand::class);
        $method = $class->getMethod('execute');
        $method->setAccessible(true);
        return $method;
    }

    private function mockBatch(): MockInterface
    {
        return Mockery::mock(Batch::class);
    }

    public function testStartCommandSuccess(): void
    {
        $execute = $this->makeExecutePublic();
        $mockBatch = $this->mockBatch();

        $this->outputInterface->shouldReceive('write');
        $this->batchService
            ->shouldReceive('startNewBatch')
            ->andReturn($mockBatch);
        $mockBatch
            ->shouldReceive('getId')
            ->andReturn(1);

        $value = $execute->invokeArgs($this->getStartBatchCommand(), [$this->inputInterface, $this->outputInterface]);
        $this->assertEquals(0, $value);
    }

    public function testStartCommandBatchAlreadyStart(): void
    {
        $execute = $this->makeExecutePublic();
        $mockBatch = $this->mockBatch();

        $this->outputInterface->shouldReceive('write');
        $this->batchService
            ->shouldReceive('startNewBatch')
            ->andThrow(DatabaseException::class);

        try {
            $value = $execute->invokeArgs($this->getStartBatchCommand(),
                [$this->inputInterface, $this->outputInterface]);
        } catch (DatabaseException $exception) {
            $this->assertInstanceOf(DatabaseException::class, get_class($exception));
        }

        $this->assertEquals(1, $value);
    }
}
