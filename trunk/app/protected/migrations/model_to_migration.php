<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 10.08.18
 * Time: 14:52
 */

$properties = [
 'property integer $stid',
'property string $state_name',
'property string $state_code',
'property integer $country_id',
];

$modelName = '';//$argv[1];
$result = "class m150229_1059355_create_".$modelName. " extends CDbMigration\n
{\n
    public function up()\n
    {\n
        \$this->createTable('{{".$modelName."}}', [\n";
 foreach ($properties as $line) {

     $lineArr = explode(' ', $line);
     $result .= "'".substr($lineArr[2], 1)."' => '".$lineArr[1]. "',\n";
 }

 print_r($result);