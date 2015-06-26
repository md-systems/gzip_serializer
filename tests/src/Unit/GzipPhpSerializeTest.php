<?php

/**
 * @file
 * Contains \Drupal\Tests\gzip_serializer\Unit\GzipPhpSerializeTest.
 */

namespace Drupal\Tests\gzip_serializer\Unit;

use Drupal\gzip_serializer\GzipPhpSerialize;
use Drupal\Tests\UnitTestCase;

/**
 * @coversDefaultClass Drupal\gzip_serializer\GzipPhpSerialize
 *
 * @group gzip_serialize
 */
class GzipPhpSerializeTest extends UnitTestCase {

  /**
   * @covers ::encode
   * @covers ::decode
   */
  public function testSerialize() {

    $serializer = new GzipPhpSerialize();

    $data = ['Example' => 'Structure'];

    $this->assertEquals($data, $serializer->decode($serializer->encode($data)));

    // Uncompressed data.
    $this->assertEquals($data, $serializer->decode(serialize($data)));
  }

}
