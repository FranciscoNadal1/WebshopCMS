{"filter":false,"title":"doctrine.php","tooltip":"/settings/doctrine/doctrine.php","undoManager":{"mark":22,"position":22,"stack":[[{"start":{"row":14,"column":6},"end":{"row":14,"column":10},"action":"remove","lines":["twig"],"id":2},{"start":{"row":14,"column":6},"end":{"row":14,"column":7},"action":"insert","lines":["d"]}],[{"start":{"row":14,"column":7},"end":{"row":14,"column":8},"action":"insert","lines":["o"],"id":3}],[{"start":{"row":14,"column":8},"end":{"row":14,"column":9},"action":"insert","lines":["c"],"id":4}],[{"start":{"row":14,"column":9},"end":{"row":14,"column":10},"action":"insert","lines":["t"],"id":5}],[{"start":{"row":14,"column":10},"end":{"row":14,"column":11},"action":"insert","lines":["r"],"id":6}],[{"start":{"row":14,"column":11},"end":{"row":14,"column":12},"action":"insert","lines":["i"],"id":7}],[{"start":{"row":14,"column":12},"end":{"row":14,"column":13},"action":"insert","lines":["n"],"id":8}],[{"start":{"row":14,"column":13},"end":{"row":14,"column":14},"action":"insert","lines":["e"],"id":9}],[{"start":{"row":8,"column":19},"end":{"row":8,"column":31},"action":"remove","lines":["twigSettings"],"id":10},{"start":{"row":8,"column":19},"end":{"row":8,"column":20},"action":"insert","lines":["d"]}],[{"start":{"row":8,"column":20},"end":{"row":8,"column":21},"action":"insert","lines":["o"],"id":11}],[{"start":{"row":8,"column":21},"end":{"row":8,"column":22},"action":"insert","lines":["c"],"id":12}],[{"start":{"row":8,"column":22},"end":{"row":8,"column":23},"action":"insert","lines":["t"],"id":13}],[{"start":{"row":8,"column":23},"end":{"row":8,"column":24},"action":"insert","lines":["r"],"id":14}],[{"start":{"row":8,"column":24},"end":{"row":8,"column":25},"action":"insert","lines":["i"],"id":15}],[{"start":{"row":8,"column":25},"end":{"row":8,"column":26},"action":"insert","lines":["n"],"id":16}],[{"start":{"row":8,"column":26},"end":{"row":8,"column":27},"action":"insert","lines":["e"],"id":17}],[{"start":{"row":19,"column":0},"end":{"row":28,"column":7},"action":"remove","lines":["    $app->register(new \\Silex\\Provider\\TwigServiceProvider(), array(","","        'twig.path' => ","            [","            $_SERVER[\"DOCUMENT_ROOT\"] .  publicRoute . '/public', ","            $_SERVER[\"DOCUMENT_ROOT\"] .  publicRoute . '/common',","            $_SERVER[\"DOCUMENT_ROOT\"] .  errorHandlers . '/public',","            $_SERVER[\"DOCUMENT_ROOT\"] .  errorHandlers . '/common',","            ],","    ));"],"id":18},{"start":{"row":19,"column":0},"end":{"row":20,"column":0},"action":"insert","lines":["",""]}],[{"start":{"row":19,"column":0},"end":{"row":38,"column":2},"action":"insert","lines":["$app['db.options'] = array(","    'driver'   => 'pdo_mysql',","    'charset'  => 'utf8',","    'host'     => '127.0.0.1',","    'dbname'   => '',","    'user'     => '',","    'password' => '',",");","","$app['orm.proxies_dir'] = __DIR__.'/../cache/doctrine/proxies';","$app['orm.default_cache'] = 'array';","$app['orm.em.options'] = array(","    'mappings' => array(","        array(","            'type' => 'annotation',","            'path' => __DIR__.'/../../src',","            'namespace' => 'My\\\\Namespace\\\\To\\\\Entity',","        ),","    ),",");"],"id":19}],[{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "],"id":20},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]},{"start":{"row":22,"column":0},"end":{"row":22,"column":4},"action":"insert","lines":["    "]},{"start":{"row":23,"column":0},"end":{"row":23,"column":4},"action":"insert","lines":["    "]},{"start":{"row":24,"column":0},"end":{"row":24,"column":4},"action":"insert","lines":["    "]},{"start":{"row":25,"column":0},"end":{"row":25,"column":4},"action":"insert","lines":["    "]},{"start":{"row":26,"column":0},"end":{"row":26,"column":4},"action":"insert","lines":["    "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":4},"action":"insert","lines":["    "]},{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"insert","lines":["    "]},{"start":{"row":29,"column":0},"end":{"row":29,"column":4},"action":"insert","lines":["    "]},{"start":{"row":30,"column":0},"end":{"row":30,"column":4},"action":"insert","lines":["    "]},{"start":{"row":31,"column":0},"end":{"row":31,"column":4},"action":"insert","lines":["    "]},{"start":{"row":32,"column":0},"end":{"row":32,"column":4},"action":"insert","lines":["    "]},{"start":{"row":33,"column":0},"end":{"row":33,"column":4},"action":"insert","lines":["    "]},{"start":{"row":34,"column":0},"end":{"row":34,"column":4},"action":"insert","lines":["    "]},{"start":{"row":35,"column":0},"end":{"row":35,"column":4},"action":"insert","lines":["    "]},{"start":{"row":36,"column":0},"end":{"row":36,"column":4},"action":"insert","lines":["    "]},{"start":{"row":37,"column":0},"end":{"row":37,"column":4},"action":"insert","lines":["    "]},{"start":{"row":38,"column":0},"end":{"row":38,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "],"id":21},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]},{"start":{"row":22,"column":0},"end":{"row":22,"column":4},"action":"insert","lines":["    "]},{"start":{"row":23,"column":0},"end":{"row":23,"column":4},"action":"insert","lines":["    "]},{"start":{"row":24,"column":0},"end":{"row":24,"column":4},"action":"insert","lines":["    "]},{"start":{"row":25,"column":0},"end":{"row":25,"column":4},"action":"insert","lines":["    "]},{"start":{"row":26,"column":0},"end":{"row":26,"column":4},"action":"insert","lines":["    "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":4},"action":"insert","lines":["    "]},{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"insert","lines":["    "]},{"start":{"row":29,"column":0},"end":{"row":29,"column":4},"action":"insert","lines":["    "]},{"start":{"row":30,"column":0},"end":{"row":30,"column":4},"action":"insert","lines":["    "]},{"start":{"row":31,"column":0},"end":{"row":31,"column":4},"action":"insert","lines":["    "]},{"start":{"row":32,"column":0},"end":{"row":32,"column":4},"action":"insert","lines":["    "]},{"start":{"row":33,"column":0},"end":{"row":33,"column":4},"action":"insert","lines":["    "]},{"start":{"row":34,"column":0},"end":{"row":34,"column":4},"action":"insert","lines":["    "]},{"start":{"row":35,"column":0},"end":{"row":35,"column":4},"action":"insert","lines":["    "]},{"start":{"row":36,"column":0},"end":{"row":36,"column":4},"action":"insert","lines":["    "]},{"start":{"row":37,"column":0},"end":{"row":37,"column":4},"action":"insert","lines":["    "]},{"start":{"row":38,"column":0},"end":{"row":38,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":22,"column":27},"end":{"row":22,"column":36},"action":"remove","lines":["127.0.0.1"],"id":22},{"start":{"row":22,"column":27},"end":{"row":22,"column":51},"action":"insert","lines":["x1zk0-webshopcms-3726701"]}],[{"start":{"row":23,"column":27},"end":{"row":23,"column":28},"action":"insert","lines":["c"],"id":23}],[{"start":{"row":23,"column":28},"end":{"row":23,"column":29},"action":"insert","lines":["9"],"id":24}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":24,"column":27},"end":{"row":24,"column":27},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":7,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1473849333185,"hash":"43fa6cdf980dcf14fddbfc355c1849184edced77"}