<?php
/**
 * File containing the eZ\Publish\SPI\FieldType\FieldStorage class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package FieldTypeProviderInterface
 */

namespace eZ\Publish\SPI\FieldType;
use eZ\Publish\SPI\Persistence\Content\Field;
use eZ\Publish\SPI\Persistence\Content\VersionInfo;

/**
 * Interface for setting field type data.
 *
 * Methods in this interface are called by storage engine.
 *
 * $context array passed to most methods provides some context for the field handler about the
 * currently used storage engine.
 * The array should at least define 2 keys :
 *   - identifier (connection identifier)
 *   - connection (the connection handler)
 * For example, using Legacy storage engine, $context will be:
 *   - identifier = 'LegacyStorage'
 *   - connection = {@link \eZ\Publish\Core\Persistence\Legacy\EzcDbHandler} object handler (for DB connection),
 *                  to be used accordingly to
 *                  {@link http://incubator.apache.org/zetacomponents/documentation/trunk/Database/tutorial.html ezcDatabase} usage
 *
 * @package FieldTypeProviderInterface
 */
interface FieldStorage
{
    /**
     *
     * Allows custom field types to store data in an external source (e.g. another DB table).
     *
     * Stores value for $field in an external data source.
     * The whole {@link eZ\Publish\SPI\Persistence\Content\Field} object is passed and its value
     * is accessible through the {@link eZ\Publish\SPI\Persistence\Content\FieldValue} 'value' property.
     * This value holds the data filled by the user as a {@link eZ\Publish\Core\FieldType\Value} based object,
     * according to the field type (e.g. for TextLine, it will be a {@link eZ\Publish\Core\FieldType\TextLine\Value} object).
     *
     * $field->id = unique ID from the attribute tables (needs to be generated by
     * database back end on create, before the external data source may be
     * called from storing).
     *
     * The context array provides some context for the field handler about the
     * currently used storage engine.
     * The array should at least define 2 keys :
     *   - identifier (connection identifier)
     *   - connection (the connection handler)
     * For example, using Legacy storage engine, $context will be:
     *   - identifier = 'LegacyStorage'
     *   - connection = {@link \eZ\Publish\Core\Persistence\Legacy\EzcDbHandler} object handler (for DB connection),
     *                  to be used accordingly to
     * The context array provides some context for the field handler about the
     * currently used storage engine.
     * The array should at least define 2 keys :
     *   - identifier (connection identifier)
     *   - connection (the connection handler)
     * For example, using Legacy storage engine, $context will be:
     *   - identifier = 'LegacyStorage'
     *   - connection = {@link \eZ\Publish\Core\Persistence\Legacy\EzcDbHandler} object handler (for DB connection),
     *                  to be used accordingly to
     *                  {@link http://incubator.apache.org/zetacomponents/documentation/trunk/Database/tutorial.html ezcDatabase} usage
     *
     * This method might return true if $field needs to be updated after storage done here (to store a PK for instance).
     * In any other case, this method must not return anything (null).
     *
     * @param \eZ\Publish\SPI\Persistence\Content\VersionInfo $versionInfo
     * @param \eZ\Publish\SPI\Persistence\Content\Field $field
     * @param array $context
     * @return null|true
     */
    public function storeFieldData( VersionInfo $versionInfo, Field $field, array $context );

    /**
     * Populates $field value property based on the external data.
     * $field->value is a {@link eZ\Publish\SPI\Persistence\Content\FieldValue} object.
     * This value holds the data as a {@link eZ\Publish\Core\FieldType\Value} based object,
     * according to the field type (e.g. for TextLine, it will be a {@link eZ\Publish\Core\FieldType\TextLine\Value} object).
     *
     * @param \eZ\Publish\SPI\Persistence\Content\VersionInfo $versionInfo
     * @param \eZ\Publish\SPI\Persistence\Content\Field $field
     * @param array $context
     * @return void
     */
    public function getFieldData( VersionInfo $versionInfo, Field $field, array $context );

    /**
     * @param array $fieldId Array of field Ids
     * @param array $context
     * @return boolean
     */
    public function deleteFieldData( array $fieldId, array $context );

    /**
     * Checks if field type has external data to deal with
     *
     * @return boolean
     */
    public function hasFieldData();

    /**
     * Get index data for external data for search backend
     *
     * @param \eZ\Publish\SPI\Persistence\Content\Field $field
     * @param array $context
     * @return \eZ\Publish\SPI\Persistence\Content\Search\Field[]
     */
    public function getIndexData( VersionInfo $versionInfo, Field $field, array $context );
}
