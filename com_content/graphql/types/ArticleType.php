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
                $methodName = 'process'.ucfirst($info->fieldName);

                if( method_exists( $this, $methodName ) ) {
                    return $this->$methodName($val, $args, $context, $info);
                }

                return $val[$info->fieldName];
			},

		];
		parent::__construct($config);
	}

    /**
     * @return string
     */
/*	private function processTitle( $val, $args, $context, $info ) {
	    return utf8_decode( $val[$info->fieldName] );
    }
*/
}
