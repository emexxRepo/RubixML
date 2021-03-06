<?php

namespace Rubix\ML\Tests\CrossValidation\Metrics;

use Rubix\ML\CrossValidation\Metrics\Metric;
use Rubix\ML\CrossValidation\Metrics\RMSError;
use PHPUnit\Framework\TestCase;

class RMSErrorTest extends TestCase
{
    protected $metric;

    public function setUp()
    {
        $this->metric = new RMSError();
    }

    public function test_build_metric()
    {
        $this->assertInstanceOf(RMSError::class, $this->metric);
        $this->assertInstanceOf(Metric::class, $this->metric);
    }

    public function test_get_range()
    {
        $this->assertEquals([-INF, 0], $this->metric->range());
    }

    public function test_score_predictions()
    {
        $predictions = [9, 15, 9, 12, 8];

        $labels = [10, 10, 6, 14, 8];

        list($min, $max) = $this->metric->range();

        $score = $this->metric->score($predictions, $labels);

        $this->assertEquals(-2.792848008753788, $score);

        $this->assertThat($score, $this->logicalAnd(
            $this->greaterThanOrEqual($min), $this->lessThanOrEqual($max))
        );
    }
}
