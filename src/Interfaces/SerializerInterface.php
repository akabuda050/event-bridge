<?php

namespace JsonBaby\EventBridge\Interfaces;

interface SerializerInterface
{
    public function serialize(mixed $data, string $format, array $context = []): string;
    public function deserialize(mixed $data, string $class, string $format, array $context = []): mixed;
}
