<?php

namespace JGraphQL\Content;

use GraphQL\Type\Definition\ListOfType;
use JGraphQL\Content\Types\ArticleType;
use JGraphQL\Content\QueryType;
use JGraphQL\Content\Types\CategoryType;
use JGraphQL\Content\Types\TagType;

/**
 * Class ComContentTypes
 * @package JGraphQL\Content
 */
class ComContentTypes
{
	// Object types:
	private static $query;
	private static $article;
	private static $tag;
	private static $category;

    public static function listOf($type)
    {
        return new ListOfType($type);
    }

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

	/**
	 * @return TagType
	 */
	public static function tag()
	{
		return self::$tag ?: (self::$tag = new TagType());
	}

}