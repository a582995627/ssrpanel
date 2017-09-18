<?php

namespace App\Http\Controllers;
use App\Http\Models\Config;
use App\Http\Models\SsConfig;
use App\Http\Models\User;

/**
 * 基础控制器
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{
    // 生成SS密码
    public function makeRandStr($length = 4)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijkmnpqrstuvwxyz23456789';
        $char = '@';
        for ($i = 0; $i < $length; $i++) {
            $char .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $char;
    }

    // base64加密（处理URL）
    function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    // base64解密（处理URL）
    function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    // 根据流量值自动转换单位输出
    public static function flowAutoShow($value = 0)
    {
        $kb = 1024;
        $mb = 1048576;
        $gb = 1073741824;
        $tb = $gb * 1024;
        $pb = $tb * 1024;
        if (abs($value) > $pb) {
            return round($value / $pb, 2) . "PB";
        } elseif (abs($value) > $tb) {
            return round($value / $tb, 2) . "TB";
        } elseif (abs($value) > $gb) {
            return round($value / $gb, 2) . "GB";
        } elseif (abs($value) > $mb) {
            return round($value / $mb, 2) . "MB";
        } elseif (abs($value) > $kb) {
            return round($value / $kb, 2) . "KB";
        } else {
            return round($value, 2) . "B";
        }
    }

    public static function toMB($traffic)
    {
        $mb = 1048576;
        return $traffic * $mb;
    }

    public static function toGB($traffic)
    {
        $gb = 1048576 * 1024;
        return $traffic * $gb;
    }

    public static function flowToGB($traffic)
    {
        $gb = 1048576 * 1024;
        return $traffic / $gb;
    }

    // 加密方式
    public function methodList()
    {
        return SsConfig::where('type', 1)->get();
    }

    // 协议
    public function protocolList()
    {
        return SsConfig::where('type', 2)->get();
    }

    // 混淆
    public function obfsList()
    {
        return SsConfig::where('type', 3)->get();
    }

    // 系统配置
    public function systemConfig()
    {
        $config = Config::get();
        $data = [];
        foreach ($config as $vo) {
            $data[$vo->name] = $vo->value;
        }

        return $data;
    }

    // 获取一个随机端口
    public function getRandPort()
    {
        $port = mt_rand(10000,30000);
        $exists_port = User::query()->pluck('port')->toArray();
        if (in_array($port, $exists_port)) {
            $this->getRandPort();
        }

        return $port;
    }

    // 类似Linux中的tail命令
    public function tail($file, $n, $base = 5)
    {
        $fp = fopen($file, "r+");
        assert($n > 0);
        $pos = $n + 1;
        $lines = array();
        while (count($lines) <= $n) {
            try {
                fseek($fp, -$pos, SEEK_END);
            } catch (Exception $e) {
                fseek(0);
                break;
            }

            $pos *= $base;
            while (!feof($fp)) {
                array_unshift($lines, fgets($fp));
            }
        }

        return array_slice($lines, 0, $n);
    }

    /**
     * 文件大小转换
     *
     * @param int $bytes
     * @param int $precision
     *
     * @return string
     */
    public function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
