# Joomla-GraphQl-POC
a GraphQl integration for Joomla

Object of this repo is to make a POC for using GraphQl API for each Joomla component whit an url like 

your_joomla_url/index.php?component=com_content&task=graphql.query&query=query{article(id:2){id,title}}
or
index.php?option=com_hikashop&ctrl=graphql&task=query&query=query{products(category:2){product_id,product_name}}

and a return like 

{"data":{"articles":[{"id":2,"title":"About Us"},{"id":6,"title":"Creating Your Site"}]}}

which can be use as rest API

this POC only request for data, not for mutation for now.

This i my first contribution on Joomla developpment, Tell me if it's interesting!!!

So, I'm french with a bad English no?

# add graphQl-php in joomla libraries\vendor dir
download or clone from webonix repo in vendor/graphql-php-master dir
https://github.com/webonyx/graphql-php

# use this repo

1 - download or clone out of your Joomla site

2 - copy altylya-jgraphql dir in joomla libraries\vendor dir

3 - copy com_content dir in components/com_content

4 - idem for com_hikashop


# What's do ?

1 - altylya-jgraphql have only a base controller you can extend foreach joomla component

2 - in each joomla component, there is a new controller named graphql which extend altylya-jgraphql base component

3 - each joomla component have a new dir named grapqh where you find query type and all GraphQl Object type.


Look at grapql controller for url to call joomla graphql api for each component
or in postman collection file
