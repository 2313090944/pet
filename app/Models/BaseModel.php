<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/* 基础模型 */

abstract class BaseModel extends Model
{

    //条件拼接抽象方法
    public abstract function scopeApplyConditions($query, array $where);

    //查询字段抽象方法
    public abstract function scopeFields($query);

    /**
     * @desc:   分页公用方法
     * @auth:   hyb
     * @date:   2017/9/4
     * @time:   16:53
     * @param:  $params
     * @return: object
     */
    public function scopePaginates($query, array $params)
    {
        $model = clone $query;
        $limit = existence($params, 'size') ? $params['size'] : $this->perPage;//返回记录数
        $params['page'] = isset($params['page']) ? $params['page'] - 1 : 0;
        $offset = $params['page'] * $limit < 0 ? 0 : $params['page'] * $limit;//当前页码
        $total = $model->selectRaw('count(*) as total')->first()['total'];//总记录数
        $data = $query->fields()->offset($offset)->limit($limit)->get();//查询
        return !empty($total) && !empty($data)?collect(compact('total', 'data')):[];
    }

    /**
     * @desc:   添加公用方法
     * @auth:   hyb
     * @date:   2017/9/4
     * @time:   17:51
     * @param:
     * @return: 返回添加id
     */
    public function insertGetId(array $attributes)
    {

        //dd($this->fill($attributes));
        return parent::insertGetId($this->fill($attributes)->toArray());
    }

    /**
     * @desc:   删除公用方法
     * @auth:   hyb
     * @date:   2017/9/4
     * @time:   18:02
     * @param:
     * @return:
     */
    public function conditionsDelete(array $where)
    {
        return $this->applyConditions($where)->delete();
    }

    /**
     * @desc:   修改公用方法
     * @auth:   hyb
     * @date:   2017/9/4
     * @time:   18:03
     * @param:
     * @return:
     */
    public function conditionsUpdate($where, $attributes)
    {
        return $this->applyConditions($where)->update($attributes);
    }
}
