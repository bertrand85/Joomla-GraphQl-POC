<?php

namespace JGraphQL\Content;

use JGraphQL\Content\Types\ArticleType;
use JGraphQL\Content\QueryType;

/**
 * Class ComContentTypes
 * @package JGraphQL\Content
 */
class ComContentTypes
{
	// Object types:
	private static $query;
	private static $article;
	private static $articles;

	/**
	 * @return queryType
	 */
	public static function query()
	{
		return self::$query ?: (self::$query = new QueryType());
	}

	/**
	 * @return ArticleType
	 */
	public static function article()
	{
		return self::$article ?: (self::$article = new ArticleType());
	}

}