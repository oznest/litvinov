<?php
declare(strict_types=1);

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
class Condition
{
    private string $text;

    public function getText(): string
    {
        return $this->text;
    }
}
