<?php

/**
 * File containing the UrlAlias Handler interface.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Publish\SPI\Persistence\Content\UrlAlias;

/**
 * The UrlAlias Handler interface provides nice urls management.
 *
 * Its methods operate on a representation of the url alias data structure held
 * inside a storage engine.
 */
interface Handler
{
    /**
     * This method creates or updates an urlalias from a new or changed content name in a language
     * (if published). It also can be used to create an alias for a new location of content.
     * On update the old alias is linked to the new one (i.e. a history alias is generated).
     *
     * $alwaysAvailable controls whether the url alias is accessible in all
     * languages.
     *
     * @param mixed $locationId
     * @param mixed $parentLocationId
     * @param string $name the new name computed by the name schema or url alias schema
     * @param string $languageCode
     * @param bool $alwaysAvailable
     */
    public function publishUrlAliasForLocation($locationId, $parentLocationId, $name, $languageCode, $alwaysAvailable = false);

    /**
     * Create a user chosen $alias pointing to $locationId in $languageCode.
     *
     * If $languageCode is null the $alias is created in the system's default
     * language. $alwaysAvailable makes the alias available in all languages.
     *
     * @param mixed $locationId
     * @param string $path
     * @param bool $forwarding
     * @param string|null $languageCode
     * @param bool $alwaysAvailable
     *
     * @return \eZ\Publish\SPI\Persistence\Content\UrlAlias
     */
    public function createCustomUrlAlias($locationId, $path, $forwarding = false, $languageCode = null, $alwaysAvailable = false);

    /**
     * Create a user chosen $alias pointing to a resource in $languageCode.
     * This method does not handle location resources - if a user enters a location target
     * the createCustomUrlAlias method has to be used.
     *
     * If $languageCode is null the $alias is created in the system's default
     * language. $alwaysAvailable makes the alias available in all languages.
     *
     * @param string $resource
     * @param string $path
     * @param bool $forwarding
     * @param string|null $languageCode
     * @param bool $alwaysAvailable
     *
     * @return \eZ\Publish\SPI\Persistence\Content\UrlAlias
     */
    public function createGlobalUrlAlias($resource, $path, $forwarding = false, $languageCode = null, $alwaysAvailable = false);

    /**
     * List global aliases.
     *
     * @param string|null $languageCode
     * @param int $offset
     * @param int $limit
     *
     * @return \eZ\Publish\SPI\Persistence\Content\UrlAlias[]
     */
    public function listGlobalURLAliases($languageCode = null, $offset = 0, $limit = -1);

    /**
     * List of url entries of $urlType, pointing to $locationId.
     *
     * @param mixed $locationId
     * @param bool $custom if true the user generated aliases are listed otherwise the autogenerated
     *
     * @return \eZ\Publish\SPI\Persistence\Content\UrlAlias[]
     */
    public function listURLAliasesForLocation($locationId, $custom = false);

    /**
     * Removes url aliases.
     *
     * Autogenerated aliases are not removed by this method.
     *
     * @param \eZ\Publish\SPI\Persistence\Content\UrlAlias[] $urlAliases
     *
     * @return bool
     */
    public function removeURLAliases(array $urlAliases);

    /**
     * Looks up a url alias for the given url.
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\NotFoundException
     *
     * @param string $url
     *
     * @return \eZ\Publish\SPI\Persistence\Content\UrlAlias
     */
    public function lookup($url);

    /**
     * Loads URL alias by given $id.
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\NotFoundException
     *
     * @param string $id
     *
     * @return \eZ\Publish\SPI\Persistence\Content\UrlAlias
     */
    public function loadUrlAlias($id);

    /**
     * Notifies the underlying engine that a location has moved.
     *
     * This method triggers the change of the autogenerated aliases
     *
     * @param mixed $locationId
     * @param mixed $oldParentId
     * @param mixed $newParentId
     */
    public function locationMoved($locationId, $oldParentId, $newParentId);

    /**
     * Notifies the underlying engine that a location has moved.
     *
     * This method triggers the creation of the autogenerated aliases for the copied locations
     *
     * @param mixed $locationId
     * @param mixed $newLocationId
     * @param mixed $newParentId
     */
    public function locationCopied($locationId, $newLocationId, $newParentId);

    /**
     * Notifies the underlying engine that a location was deleted or moved to trash.
     *
     * @param mixed $locationId
     */
    public function locationDeleted($locationId);
}
