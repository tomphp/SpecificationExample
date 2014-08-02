<?php

namespace TomPHPTest\SpecificationExample\SQLiteRepository;

use TomPHPTest\SpecificationExample\Application\Repository\VideoRepositoryTest;
use TomPHP\SpecificationExample\SQLiteRepository\SQLiteVideoRepository;

final class SQLiteVideoRepositoryTest extends VideoRepositoryTest
{
    protected function setUp()
    {
        $this->repository = new SQLiteVideoRepository();
        $this->repository->clear();

        parent::setUp();
    }
}
