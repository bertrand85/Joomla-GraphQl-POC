<?php

namespace JGraphQL\Hikashop\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * Class ProductType
 * @package JGraphQL\Hikashop\Types
 */
class ProductType extends ObjectType
{
	/**
	 * ProductType constructor.
	 */
	public function __construct()
	{
		$config = [
			'name'         => 'Product',
			'description'  => 'Hikashop Product',
			'fields'       => [
					'product_id' => Type::int(),
					'product_parent_id' => Type::int(),
					'product_name' => [
						'type' => Type::string(),
						'description' => 'Product Name'
					]
			]

		];
		parent::__construct($config);
	}
}
