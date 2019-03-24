<?php

namespace JGraphQL\Content;

use JGraphQL\Content\Types\ArticleType;
use JGraphQL\Content\QueryType;
use JGraphQL\Content\Types\CategoryType;

/**
 * Class ComContentTypes
 * @package JGraphQL\Content
 */
class ComContentTypes
{
	// Object types:
	private static $query;
	private static $article;
	private static $category;

	/**
	 * @return queryType
	 */
	public static function query()
	{
		return self::$query ?: (self::$query = new QueryType());
	}

	/**
	 * @return CategoryType
	 */
	public static function category()
	{
		return self::$category ?: (self::$category = new CategoryType());
	}

	/**
	 * @return ArticleType
	 */
	public static function article()
	{
		return self::$article ?: (self::$article = new ArticleType());
	}

}