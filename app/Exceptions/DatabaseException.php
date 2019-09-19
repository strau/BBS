<?php
namespace App\Exceptions;

use App\Common\Res;
use Illuminate\Http\Request;

/**
 * 数据库操作异常
 */
class DatabaseException extends BaseException
{
//    protected $res = null;    //返回的数据Res::response()
//
    public function __construct($res = null)
    {
        if ($res === null) {
            $res = Res::response(Res::CODE_DATA_ERR_SAVE, '操作失败，请稍后再试或联系管理员');
        }
        parent::__construct($res);
    }
}