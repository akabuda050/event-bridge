<?php

namespace JsonBaby\EventBridge\Entities;

use JsonBaby\EventBridge\Interfaces\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SymfonySerializer implements SerializerInterface
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new XmlEncoder(), new JsonEncoder()], [new ObjectNormalizer()]);
    }
    
    public function serialize(mixed $data, string $format, array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize(mixed $data, string $class, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $class, $format, $context);
    }
}
