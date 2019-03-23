<?php

namespace JGraphQL\Content;

use JGraphQL\Content\Types\ArticleType;
use JGraphQL\Content\Types\ArticlesType;
use JGraphQL\Content\QueryType;

/**
* Class Types
 *
 * Acts as a registry and factory for your types.
 *
 * As simplistic as possible for the sake of clarity of this example.
 * Your own may be more dynamic (or even code-generated).
 *
 * @package GraphQL\Examples\Blog
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

	/**
	 * @return ArticlesType
	 */
	public static function articles()
	{
		return self::$articles ?: (self::$articles = new ArticlesType());
	}
}