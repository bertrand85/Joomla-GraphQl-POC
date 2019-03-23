<?php

namespace JGraphQL\Content\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;


class ArticleType extends ObjectType
{
	public function __construct()
	{
		$config = [
			'name'         => 'Article',
			'description'  => 'Joomla article',
			'fields'       => [
					'id' => Type::int(),
					'title' => [
						'type' => Type::string(),
						'description' => 'article title'
					],
					'alias' => [
						'type' => Type::string(),
						'description' => 'article alias'
					],
					'introtext' => Type::string(),
					'fulltext' => Type::string(),
					'params' => Type::string()
			],
			'resolveField' => function($val, $args, $context, ResolveInfo $info) {
				// for testing field transformation
				/*if ($info->fieldName=='id') {
					return '111';
				}
				else {
					return $val[$info->fieldName];
				}*/
				return $val[$info->fieldName];
				//return $this->{$info->fieldName}($val, $args, $context, $info); // with an internal method
			},

		];
		parent::__construct($config);
	}
}
