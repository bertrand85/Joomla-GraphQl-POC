<?php

namespace JGraphQL\Content\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JGraphQL\Content\ComContentTypes;


class CategoryType extends ObjectType
{
	public function __construct()
	{
		$config = [
			'name'         => 'Category',
			'description'  => 'Joomla Category',
			'fields'       => [
					'id' => Type::int(),
					'parent_id' => Type::string(),
					'title' => [
						'type' => Type::string(),
						'description' => 'Category title'
					],
					'alias' => [
						'type' => Type::string(),
						'description' => 'Category alias'
					],
					'description' => Type::string()
			]
		];
		parent::__construct($config);
	}
}
