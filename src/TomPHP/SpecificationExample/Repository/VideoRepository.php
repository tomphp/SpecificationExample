<?php

namespace TomPHP\SpecificationExample\Repository;

use TomPHP\SpecificationExample\Entity\Video;
use TomPHP\SpecificationExample\Specification\Specification;

interface VideoRepository
{
    public function save(Video $video);

    /** @returns Video[] */
    public function fetchAll();

    /** @returns Video[] */
    public function fetchBySpecifcation(Specification $specification);
}
