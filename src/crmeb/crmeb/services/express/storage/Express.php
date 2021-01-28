<?php
// +----------------------------------------------------------------------
// | CRMEB [ CRMEB赋能开发者，助力企业发展 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2020 https://www.crmeb.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed CRMEB并不是自由软件，未经许可不能去掉CRMEB相关版权
// +----------------------------------------------------------------------
// | Author: CRMEB Team <admin@crmeb.com>
// +----------------------------------------------------------------------

namespace crmeb\services\express\storage;

use crmeb\basic\BaseExpress;
use crmeb\exceptions\ApiException;
use crmeb\services\AccessTokenServeService;

/**
 * Class Express
 * @package crmeb\services\express\storage
 */
class Express extends BaseExpress
{
    /**
     * 注册服务
     */
    const EXPRESS_OPEN = 'expr/open';

    /**
     * 电子面单模版
     */
    const EXPRESS_TEMP = 'expr/temp';

    /**
     * 快递公司
     */
    const EXPRESS_LIST = 'expr/express';

    /**
     * 快递查询
     */
    const EXPRESS_QUERY = 'expr/query';

    /**
     * 面单打印
     */
    const EXPRESS_DUMP = 'expr/dump';

    /** 初始化
     * @param array $config
     * @return mixed|void
     */

    protected function initialize(array $config = [])
    {
        parent::initialize($config); // TODO: Change the autogenerated stub
    }

    /**
     * 开通物流服务
     * @return bool|mixed
     */
    public function open()
    {
        return $this->accessToken->httpRequest(self::EXPRESS_OPEN, []);
    }


    /**
     * 获取物流公司列表
     * @param int $type 快递类型：1，国内运输商；2，国际运输商；3，国际邮政
     * @return bool|mixed
     */
    public function express(int $type = 0, int $page = 0, int $limit = 20)
    {
        if ($type) {
            $param = [
                'type' => $type,
                'page' => $page,
                'limit' => $limit
            ];
        } else {
            $param = [];
        }

        return $this->accessToken->httpRequest(self::EXPRESS_LIST, $param);
    }

    /**
     * 查询物流信息
     * @param $com
     * @param $num
     * @return bool|mixed
     * @return 是否签收 ischeck
     * @return 物流状态：status 0在途，1揽收，2疑难，3签收，4退签，5派件，6退回，7转单，10待清关，11清关中，12已清关，13清关异常，14收件人拒签
     * @return 物流详情 content
     */
    public function query(string $num, string $com = '')
    {
        $param = [
            'com' => $com,
            'num' => $num
        ];
        if ($com === null) {
            unset($param['com']);
        }
        return $this->accessToken->httpRequest(self::EXPRESS_QUERY, $param);
    }

    public function dump($data)
    {
        // TODO: Implement dump() method.
    }
    public function temp(string $com)
    {
        // TODO: Implement temp() method.
    }
}