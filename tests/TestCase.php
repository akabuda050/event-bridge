<?php

namespace JsonBaby\EventBridge\Tests;

use JsonBaby\EventBridge\EventBridgeServiceProvider;
use \Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
      parent::setUp();
      // additional setup
    }
  
    protected function getPackageProviders($app)
    {
      return [];
    }
  
    protected function getEnvironmentSetUp($app)
    {
      // perform environment setup
    }
  }