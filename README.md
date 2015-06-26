GZIP PHP Serializer
=============
Provides a service that can be used as a drop-in replacement for the serializer.phpserialize.

Data is serialized and compressed with gzencode() using compression level 1 to be as fast as possible.

To use it for the expirable key value store, put the following in sites/default/services.yml:

      keyvalue.expirable.database:
        class: Drupal\Core\KeyValueStore\KeyValueDatabaseExpirableFactory
        arguments: ['@serialization.gzip_serialize', '@database']
        
 **Warning:**
 
Decompression is optional, the serializer can handle a non-compressed serialized
string. It is, however, not possible to stop using it without first decompressing the data.
