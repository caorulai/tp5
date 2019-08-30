<?php
/**
 * Created by PhpStorm.
 * User: buddha
 * Date: 2018/9/21 0021
 * Time: 21:18
 */

namespace app\index\controller;

use think\Controller;
use app\index\model\Users as UsersModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

class Users extends Controller
{
    /**
     * url:http://tp5.com/users
     * type:get
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function index()
    {
        try {
            return db()->select();
        } catch (DataNotFoundException $e) {
            return $e->getMessage();
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        } catch (DbException $e) {
            return $e->getMessage();
        }
    }

    /**
     * url:http://tp5.com/users
     * type:post
     * data = ['username','password','status']
     * @return array|string
     */
    public function save()
    {
        $data = $this->request->param();
        $validate = new \app\index\validate\Users();
        if (!$validate->scene('save')->check($data)) {
            return $validate->getError();
        }
        $model = new UsersModel;
        $info = $model->allowField(true)->save($data);
        if ($info) {
            return 'SUCCESS';
        }
        return 'FAILED';
    }

    /**
     * url:http://tp5.com/users/1
     * type:get
     * @param $id
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function read($id)
    {
        try {
            return db('users', [], false)->find($id);
        } catch (DataNotFoundException $e) {
            return $e->getMessage();
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        } catch (DbException $e) {
            return $e->getMessage();
        }
    }

    /**
     * url:http://tp5.com/users/1
     * type:put
     * @param $id
     * @return array|string
     */
    public function update($id)
    {
        $data = $this->request->put();
        $validate = new \app\index\validate\Users();
        if (!$validate->scene('update')->check($data)) {
            return $validate->getError();
        }
        $info = UsersModel::update($data, ['id' => $id]);
        if ($info) {
            return 'SUCCESS';
        }
        return 'FAILED';
    }

    /**
     * url:http://tp5.com/users/1
     * type:delete
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        $info = UsersModel::destroy(['id'=>$id]);
        if ($info) {
            return 'SUCCESS';
        }
        return 'FAILED';
    }
}
