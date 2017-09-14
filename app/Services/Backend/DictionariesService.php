<?php

namespace App\Services\Backend;

use Facades\App\Repositories\Backend\DictionariesRepository as Dictionaries;

/* 字典服务层 */
class DictionariesService
{

    /**
     * @desc:   字典类型列表
     * @auth:   hyb
     * @date:   2017/9/14
     * @time:   9:28
     * @param:
     * @return: json
     */
    public function dictionaries(array $params)
    {
        return Dictionaries::dictionaries($params);
    }

    /**
     * @desc:   添加字典配置
     * @auth:   hyb
     * @date:   2017/9/12
     * @time:   18:01
     * @param:
     * @return: array
     */
    public function dictionaryCreate($params)
    {
        $create=Dictionaries::dictionaryCreate($params);
        $dictionary=Dictionaries::dictionaryAll('dictionaryTree')->toArray();
        $fileStringNumber=create_config('dictionary.php',generateTree($dictionary));
        return $this->isCreateDictionaryFile($create,$fileStringNumber);
    }

    //判断是否添加成功和重新生成字典文件
    private function isCreateDictionaryFile($create,$dictionary){
        return array_filter([$create,$dictionary]);
    }

    /**
     * @desc:   删除字典
     * @auth:   hyb
     * @date:   2017/9/14
     * @time:   9:12
     * @param:
     * @return:
     */
    public function dictionaryDestroy($params)
    {
        return Dictionaries::dictionaryDestroy($params);
    }

    /**
     * @desc:   修改字典
     * @auth:   hyb
     * @date:   2017/9/14
     * @time:   9:12
     * @param:
     * @return:
     */
    public function dictionaryUpdate(array $params)
    {
        return Dictionaries::dictionaryUpdate($params);
    }
}