<?php 

namespace App\Models\LearningResources;

/**
 * A document describes learning resources that can be stored as files
 * 
 * Document is the base class for handling this type of files
 */
class Document extends LearningResource {
    /**
     * Path to where the document is stored
     */
    protected $path;

    //file system
    //s3://bucket_name/folder/file.pdf
    //gs://bucket_name/folder/file.pdf
    //storage of files should be cloud based

    //s3 - https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/s3-stream-wrapper.html
    //gs - https://github.com/googleapis/google-cloud-php-storage
}