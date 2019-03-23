<?php

namespace JGraphQL\Hikashop;   // <- namespace

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

// use for component namespace
use JGraphQL\Hikashop\ComHikashopTypes;
use JGraphQL\Hikashop\Helpers\ProductsHelper;

/**
 * Do not change class name?
 * Class QueryType
 * @package JGraphQL\Hikashop
 */
class QueryType extends ObjectType
{
	public function __construct()
	{
		$config = [
			'name'   => 'query',
			'fields' => [
				'product' => [
					'type'    => ComHikashopTypes::product(),
					'args'    => [
						'id' => ['type' => Type::int()],
					]
				],
				'products' => [
					'type'    => Type::listOf(ComHikashopTypes::product()),
					'args'    => [
						'category' => ['type' => Type::int()]
					]
				],
				'fieldWithException' => [
					'type' => Type::string(),
					'resolve' => function() {
						throw new \Exception("Exception message thrown in field resolver");
					}
				],
			],
			'resolveField' => function($val, $args, $context, ResolveInfo $info) {
				return $this->{$info->fieldName}($val, $args, $context, $info);
			},
		];
		parent::__construct($config);
	}

	/**
	 * @param $rootValue
	 * @param $args
	 *
	 * @return array|null
	 */
	public function product($rootValue, $args) {
		$controller =  $rootValue['controller'];
		$app =  $rootValue['app'];

		$categoryClass = hikashop_get('class.category');
		$cat = $categoryClass->get($args['id']);

		$product = ProductsHelper::getProduct($args['id']);

		return $product;
	}

	/**
	 * @param $rootValue
	 * @param $args
	 *
	 * @return array|null
	 */
	public function products($rootValue, $args) {
		$controller =  $rootValue['controller'];
		$app =  $rootValue['app'];

		$products = ProductsHelper::getCategoryProducts($args['category']);

		return $products;
	}


}
