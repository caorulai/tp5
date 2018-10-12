<?php
/**
 * Created by PhpStorm.
 * User: buddha
 * Date: 2018/9/21 0021
 * Time: 21:43
 */

namespace app\index\validate;
use think\Validate;

class Users extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =   [
        'username'   => 'require|unique:users|alphaDash|min:6|max:32',
        'password'   => 'require|length:6,32',
        'status'     => 'integer|between:0,1',
    ];

    /**
     * 验证信息
     */
    protected $message  =   [

    ];

    /**
     * 验证场景
     */
    protected $scene = [
        'save'  =>  ['username', 'password', 'status'],
        'update'=>  [
            'username'  => 'unique:users|alphaDash|min:6|max:32',
            'password'  => 'length:6,32',
            'status'    => 'integer|between:0,1',
        ],
    ];
}