<?php
/**
 * File containing the FileService interface
 *
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\SPI\FieldType;

interface FileService
{
    /**
     * Store the local file identified by $sourcePath in a location that corresponds
     * to $storageIdentifier. Returns a storage identifier used inside the
     * storage (might differ from the incoming $storageIdentifier).
     *
     * @param string $sourcePath
     * @param string $storageIdentifier
     *
     * @return string
     */
    public function storeFile( $sourcePath, $storageIdentifier );

    /**
     * Uses $metadataHandler to extract metadata from $storageIdentifier
     * @param MetadataHandler $metadataHandler
     * @param string $storageIdentifier
     * @return array
     */
    public function getMetadata( MetadataHandler $metadataHandler, $storageIdentifier );

    /**
     * Returns the file size of the file identified by $storageIdentifier
     *
     * @param string $storageIdentifier
     *
     * @return int
     */
    public function getFileSize( $storageIdentifier );

    /**
     * Removes the path identified by $storageIdentifier, potentially
     * $recursive.
     *
     * Attempts to removed the path identified by $storageIdentifier. If
     * $storageIdentifier is a directory which is not empty and $recursive is
     * set to false, an exception is thrown. Attempting to remove a non
     * existing $storageIdentifier is silently ignored.
     *
     * @param string $storageIdentifier
     * @param boolean $recursive
     *
     * @return void
     * @throws \RuntimeException if children of $storageIdentifier exist and
     *                           $recursive is false
     * @throws \RuntimeException if $storageIdentifier could not be removed (most
     *                           likely permission issues)
     */
    public function remove( $storageIdentifier, $recursive = false );

    /**
     * Returns a storage identifier for the given $path
     *
     * The storage identifier is used to identify $path inside the storage
     * encapsulated by the file service.
     *
     * @param string $path
     *
     * @return string
     */
    public function getStorageIdentifier( $path );

    /**
     * Returns is a file/directory with the given $storageIdentifier exists
     *
     * @param string $storageIdentifier
     *
     * @return boolean
     */
    public function exists( $storageIdentifier );
}
