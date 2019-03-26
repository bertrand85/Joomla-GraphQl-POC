<?php

namespace JGraphQL\Content\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use JGraphQL\Content\ComContentTypes;


class TagType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name'         => 'Tag',
            'description'  => 'Joomla tags',
            'fields'       => function() {
                return [
                    'type_alias' => Type::int(),
                    'id' => Type::string(),
                    'title' => [
                        'type' => Type::string(),
                        'description' => 'tag title'
                    ],
                    'alias' => [
                        'type' => Type::string(),
                        'description' => 'ag alias'
                    ]
                ];
                }

        ];
        parent::__construct($config);
    }
}
