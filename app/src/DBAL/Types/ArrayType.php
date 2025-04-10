<?php
declare(strict_types=1);

namespace App\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class ArrayType extends Type
{
    const ARRAY = 'array'; // Имя для нового типа

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        if (is_string($value)) {
            return json_decode($value, true); // Преобразуем строку в массив
        }
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if (is_array($value)) {
            return json_encode($value); // Преобразуем массив в строку
        }
        return $value;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return "TEXT"; // Используем тип TEXT, так как Doctrine не имеет родного типа array
    }

    public function getName()
    {
        return self::ARRAY; // Название типа
    }
}