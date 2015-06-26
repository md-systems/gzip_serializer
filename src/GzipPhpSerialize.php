<?php

/**
 * @file
 * Contains \Drupal\gzip_serializer\GzipPhpSerialize.
 */

namespace Drupal\gzip_serializer;

use Drupal\Component\Serialization\SerializationInterface;

/**
 * Serialized PHP with GZIP compression
 */
class GzipPhpSerialize implements SerializationInterface {

  /**
   * {@inheritdoc}
   */
  public static function encode($data) {
    // This should be as fast as possible, therefore using the fastest
    // compression level.
    return gzencode(serialize($data), 1);
  }

  /**
   * {@inheritdoc}
   */
  public static function decode($raw) {
    // Support uncompressed data as well, to be able to serve as a drop-in
    // replacement for a non-compressed PHP serializer. Check for the magic
    // header of a gzip compressed string.
    if (bin2hex($raw[0]) == '1f' && bin2hex($raw[1]) == '8b') {
      $raw = gzdecode($raw);
    }
    return unserialize($raw);
  }

  /**
   * {@inheritdoc}
   */
  public static function getFileExtension() {
    return 'serialized.gz';
  }

}
