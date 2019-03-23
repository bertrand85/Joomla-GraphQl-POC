<?php

namespace JGraphQL\Hikashop;

use JGraphQL\Hikashop\Types\ProductType;

/**
 * Class ComHikashopTypes
 * @package JGraphQL\Hikashop
 */
class ComHikashopTypes
{
	// Object types:
	private static $query;
	private static $product;

	/**
	 * @return queryType
	 */
	public static function query()
	{
		return self::$query ?: (self::$query = new QueryType());
	}

	/**
	 * @return ProductType
	 */
	public static function product()
	{
		return self::$product ?: (self::$product = new ProductType());
	}

}