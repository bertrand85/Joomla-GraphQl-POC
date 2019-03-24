<?php

namespace JGraphQL\Content;  // <- namespace

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

// use for component namespace
use JGraphQL\Content\ComContentTypes;


/**
* Do not change class name?
 * Class QueryType
 * @package JGraphQL\Hikashop
*/class QueryType extends ObjectType
{
	public function __construct()
	{
		$config = [
			'name'   => 'query',
			'fields' => [
				'category' => [
					'type'    => ComContentTypes::category(),
					'args'    => [
						'id' => ['type' => Type::int()],
					]
				],
				'categories' => [
					'type'    => Type::listOf(ComContentTypes::category()),
					'args'    => [
						'parent_id' => ['type' => Type::int()],
					]
				],
				'article' => [
					'type'    => ComContentTypes::article(),
					'args'    => [
						'id' => ['type' => Type::int()],
					]
				],
				'articles' => [
					'type'    => Type::listOf(ComContentTypes::article()),
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
     * Categories
     *
     * @param $rootValue
     * @param $args
     * @return array|null
     */
    public function categories($rootValue, $args) {
        $model =  $rootValue['controller']->getModel('Categories', 'ContentModel');
        $app =  $rootValue['app'];

        // set some input values
        $id = $args['parent_id'];
        if(!$id)
            $app->input->set('id', 'root');
        else
            $app->input->set('id', $id);

        $items = $model->getItems(true);
        if ( $items )
            foreach ($items as $item) {
                $result[] = (array)$item;
            }
        else
            $result=null;


        return $result;
	}

    /**
     * @param $rootValue
     * @param $args
     * @return mixed
     */
    public function category($rootValue, $args) {
        $model =  $rootValue['controller']->getModel('Category', 'ContentModel');
        $app =  $rootValue['app'];

        // set some $input
        $app->input->set('id', $args['id']);

        $item = $model->getCategory();

        return $item;
    }
	/**
	 * @param $rootValue
	 * @param $args
	 *
	 * @return array|null
	 */
	public function article($rootValue, $args) {
		$model =  $rootValue['controller']->getModel('Article', 'ContentModel');
		$app =  $rootValue['app'];

		$item = $model->getItem($args['id']);

		// Check the view access to the article (the model has already computed the values).
		if ($item->params->get('access-view') == false && ($item->params->get('show_noauth', '0') == '0'))
		{
			$item = null;
		}
		else {
			$item = (array)$item;
		}

		return $item;
	}

	/**
	 * @param $rootValue
	 * @param $args
	 *
	 * @return array|null
	 */
	public function articles($rootValue, $args) {
		$model =  $rootValue['controller']->getModel('Category', 'ContentModel');
		$app =  $rootValue['app'];

		// Get the parent id if defined.
		$parentId = $app->input->set('id', $args['category']);

		$items = $model->getItems();
		if ( $items )
			foreach ($items as $item) {
				$result[] = (array)$item;
			}
		else
			$result=null;


		return $result;
	}


}
