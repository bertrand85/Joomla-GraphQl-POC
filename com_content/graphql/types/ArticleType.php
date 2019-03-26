<?php
/**
 * @TODO processing content plugins for introtext field
 */
namespace JGraphQL\Content\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JGraphQL\Content\ComContentTypes;


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
					'catid' => Type::int(),
					'images' => Type::string(),
					'urls' => Type::string(),
					'author' => Type::string(),
					'author_email' => Type::string(),
					'featured' => Type::int(),
					'params' => Type::string(),
					'displayDate' => Type::string(),
					'modified' => Type::string(),
					'category_title' => Type::string(),
					'category_route' => Type::string(),
                    'tags' => ['type'=>ComContentTypes::listOf(ComContentTypes::tag()),
                                'args' => [
                                    'limit' => Type::int(),
                                    'defaultValue' => 5
                                ]
                    ],
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
	private function processTags( $val, $args, $context, $info ) {
	    $controller = $info->rootValue['controller'];

	    $db = \JFactory::getDbo();
	    $sql = 'select tags.id, tags.title, tags.alias
                from #__contentitem_tag_map contenttag 
                LEFT JOIN #__tags tags ON tags.id=contenttag.tag_id
                where contenttag.type_alias = "com_content.article" and contenttag.content_item_id='.$val['id'];

	    $db->setQuery( $sql );
	    $result = $db->loadAssocList();
	    return $result;
    }

}
