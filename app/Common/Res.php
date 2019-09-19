<?php
namespace App\Common;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Res
{
    //--------------------------------------------------------------------------正常类
    /** 通用正常 */
    const CODE_SUCCESS="00000";
    /** 找不到数据 */
    const CODE_NO_DATA="00011";
    /** 验证不通过，不返回错误 */
    const CODE_NOT_MATCH="00020";
    /** 后端返回确认提示 */
    const CODE_CONFIRM="00090";
    //--------------------------------------------------------------------------权限类
    /** 缺乏权限 */
    const CODE_PERMISSION_LACK="01001";
    /** 登录失效 */
    const CODE_PERMISSION_LOGOUTED="01002";
    /** 缺乏文件系统权限     */
    const CODE_PERMISSION_LACK_FILESYSTEM="01011";
    //--------------------------------------------------------------------------验证类
    /** 通用验证失败 */
    const CODE_VERIFY_ERR="02001";
    /** 不符合规则 */
    const CODE_VERIFY_ERR_NOTMATCH="02002";
    //--------------------------------------------------------------------------数据获取类
    /** 通用数据错误     */
    const CODE_DATA_ERR="03001";
    /** 未找到数据     */
    const CODE_DATA_ERR_NOTFIND="03002";
    /** 数据不合法     */
    const CODE_DATA_ERR_ILLEGAL="03003";
    /** 数据重复 */
    const CODE_DATA_ERR_REPEAT="03004";
    /** 数据保存失败 */
    const CODE_DATA_ERR_SAVE="03005";
    //---------------------------------------------------------------------------数据发送类
    /** 通用数据发送错误 */
    const CODE_DATA_SEND_ERR="04001";
    /** 通用目标已存在 **/
    const CODE_DATA_SEND_ERR_TARGETEXISTED="04002";
    /** 文件上传失败 */
    const CODE_DATA_SEND_ERR_FILEUPLAD="04011";
    /** 目标文件已存在 */
    const CODE_DATA_SEND_ERR_FILEEXISTED="04012";
    /** 目标目录创建失败 */
    const CODE_DATA_SEND_ERR_MAKE_DIR="04091";
    /** 目标文件移动失败 */
    const CODE_DATA_SEND_ERR_MOVE_FILE="04092";
    //---------------------------------------------------------------------------支付类
    /** 通用支付错误 */
    const CODE_PAY_ERR="05001";
    /** 下单支付错误 */
    const CODE_PAY_ORDER="05002";
    /** 查询错误 */
    const CODE_PAY_QUERY="05003";
    /** 申请退款错误 */
    const CODE_PAY_REFUND="05004";
    //---------------------------------------------------------------------------jwt权限验证类
    /** jwt验证通用错误 */
    const CODE_JWT_ERR = "06001";
    /** jwt token无效 */
    const CODE_JWT_INVALID = "06002";
    /** jwt token过期 */
    const CODE_JWT_EXPIRE = "06003";
    //---------------------------------------------------------------------------非法操作类
    /** 通用非法操作错误 */
    public const CODE_HANDLE_ILLEGAL="99001";


    /**
     * 统一api响应方法
     *
     * @param string $code 响应状态码
     * @param string $msg 响应消息
     * @param mixed $data 返回的数据
     * @return array|\Illuminate\Http\JsonResponse
     * Author : KANG
     * Date   : 2019/7/16
     * Time   : 18:54
     */
    public static function response($code = self::CODE_SUCCESS, $msg = null, $data = null)
    {
        $debug = null;
        if (config('app.APP_DEBUG')) {
            $debug = request()->all();
        }
        return ['code' => $code, 'msg' => $msg, 'data' => $data, 'debug' => $debug];
    }
}