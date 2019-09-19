<?php
namespace App\Exceptions;

use Illuminate\Http\Request;

/**
 * 所有自定义异常的基类
 */
class BaseException extends \Exception
{
    protected $res = null;    //返回的数据Res::response()

    public function __construct(array $res)
    {
        parent::__construct();
        $this->res = $res;
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->res;
        }
        return view('errors.error', ['res' => $this->res]);
    }
}