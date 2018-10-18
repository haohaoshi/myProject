<?php
/**
 * Created by PhpStorm.
 * User: Lujz
 * Date: 2018\10\12 0012
 * Time: 14:16
 */
require_once 'function.php';

$ary = array("Peter"=>"55","Ben"=>"57","Joe"=>"53");
$ary1 = array("Peter"=>"55","Ben"=>"33","Dog"=>"53");
$ary2 = array(
    'Peter'=>array("Peter"=>"35","Ben"=>"37","Joe"=>"43"),
    'Ben'=>array("Peter"=>"25","Ben"=>"27","Dog"=>"23"),
    'Joe'=>array("Peter"=>"15","Ben"=>"17","Joe"=>"13")
);
$key=array("Peter","Ben","Joe","A");
$val=array("35","37","43","Ben");
$num=array("1","2","3","4");
$a=array("A","Cat","Dog","A","Dog");


$result = array_map(function($v){
    return $v*$v;
},$num);
dump();

/**
 * 返回数组中的键名
 * array_keys(array,[value,strict]);
 * array：数组
 * value：返回指定键值的键名
 * strict：和value搭配使用，是否强制判断类型，默认false，true
 * php：4+
 */
$result = array_keys($ary1,'55',true);
dump();

/**
 * 检查键名是否存在数组之中
 * array_key_exists(key,array);
 * key：键名
 * array：数组
 * PHP：4.0.7+
 */
$result = array_key_exists('Ben',$ary2);
dump();

/**
 * 比较数组返回交集，只比较键名
 * array_intersect_assoc(array1,array2,array3...);
 * array1：一维数组
 * PHP：5.1.0+
 */
$result = array_intersect_key($ary,$ary1);
dump();

/**
 * 比较数组返回交集，比较键名和键值
 * array_intersect_assoc(array1,array2,array3...);
 * array1：一维数组
 * PHP：4.3.0+
 */
$result = array_intersect_assoc($ary,$ary1);
dump();

/**
 * 比较数组返回交集，只比较键值
 * array_intersect(array1,array2,array3...);
 * array1：一维数组
 * PHP：4.0.1+
 */
$result = array_intersect($key,$a);
dump();

/**
 * 将数组中的键值互换
 * array_flip(array);
 * array：一维数组
 * PHP：4+
 */
$result = array_flip($ary);
dump();

/**
 * 用回调函数过滤数组中的元素
 * array array_filter ( array $array [, callable $callback [, int $flag = 0 ]] )
 * array：数组
 * callback：回调函数
 * flg：是否传入建名，默认0否，1是
 * PHP：4.0.6+
 */
$result = array_filter($ary,function($key,$val){
    print_r($val);
    echo '<br>';
    print_r($key);
    if($val == 60){
        return true;
    }
},1);
dump();

/**
 * 指定键名的键值来填充数组
 * array_fill_keys(keys,value);
 * keys：一维数组
 * value：键值
 * php：5.2+
 */
$result = array_fill_keys($key,'1000');
dump();

/**
 * 给定的键值填充数组
 * array_fill(index,number,value);
 * index：起始索引（必须是整数）
 * number：生成的个数（必须大于零）
 * php：4.2+
 */
$result = array_fill(0,5,'hello');
dump();

/**
 * 比较第一个数组与其他数组的差异并且返回第一个数组的差异值，只比较键名
 * array_diff_key(array1,array2,array3...);
 * array1：一维数组
 * php：5.1+
 */
$result = array_diff_key($ary,$ary1);
dump();

/**
 * 比较第一个数组与其他数组的差异并且返回第一个数组的差异值，比较键名和键值
 * array_diff_assoc(array1,array2,array3...);
 * array1：一维数组
 * php：4.3+
 */
$result = array_diff_assoc($ary,$ary1);
dump();

/**
 * 比较第一个数组与其他数组的差异并且返回第一个数组的差异值，只比较值
 * array_diff(array1,array2,array3...);
 * array1：一维数组
 * php：4.0.1+
 */
$result = array_diff($key,$val,$a);
dump();


/**
 *统计数组中值出现的个数
 * array_count_values(array);
 * array：一维数组
 * php：4+
 */
$result = array_count_values($a);
dump();

/**
 * 合并数组，一个为键一个为值，两个个数必须相同
 * array_combine(keys,values);
 * keys：一维数组
 * values：数组
 * php：5+
 */
$result = array_combine($key,$val);
dump();

/**
 * 返回数组中对应键的值
 * array_column(array,column_key,[index_key]);
 * array：二维数组
 * column_key：需要返回值的键名
 * index_key：可以将某一个值作为键名返回
 * php：5.5+
 */
$result = array_column($ary2,'Ben','Peter');
dump();

/**
 * 拆分数组
 * array_chunk(array,size,[preserve_keys]);
 * array：数组
 * size：拆分个数
 * preserve_keys：是否保留原有键（true,false[默认]）
 * php：4.2+
 */
$result = array_chunk($ary2,2,true);
dump();

/**
 * 数组键的大小写转换
 * array_change_key_case(array,[case]);
 * array：一维数组
 * case：默认小写CASE_LOWER 或0，大写CASE_UPPER 或1
 * php：4+
 */
$result = array_change_key_case($ary,CASE_UPPER);
dump();

