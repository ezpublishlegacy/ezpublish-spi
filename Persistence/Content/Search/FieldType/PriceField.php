<?php
/**
 * File containing the eZ\Publish\SPI\Persistence\Content\Search\FieldType\PriceField class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */
namespace eZ\Publish\SPI\Persistence\Content\Search\FieldType;

use eZ\Publish\SPI\Persistence\Content\Search\FieldType;

/**
 * Price document field
 */
class PriceField extends FieldType
{
    /**
     * The type name of the facet. Has to be handled by the solr schema.
     *
     * @var string
     */
    protected $type = 'ez_currency';
}

