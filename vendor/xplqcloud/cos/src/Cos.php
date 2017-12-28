<?php
namespace xplqcloud\cos;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Cos extends Component {
    public $app_id;
    public $secret_id;
    public $secret_key;
    public $region;
    public $bucket;
    public $timeout;
    public $cos;
    public $insertOnly;
    public function init()
    {
        //\Yii::setAlias('@QCloud/Cos','@vendor/qcloud/cos');
        parent::init();
        if (!isset($this->app_id)) {
            throw new InvalidConfigException('请先配置app_id');
        }
        if (!isset($this->secret_id)) {
            throw new InvalidConfigException('请先配置secret_id');
        }
        if (!isset($this->secret_key)) {
            throw new InvalidConfigException('请先配置secret_key');
        }
        if (!isset($this->region)) {
            throw new InvalidConfigException('请先配置使用的region');
        }
        if (!isset($this->bucket)) {
            throw new InvalidConfigException('请先配置使用的bucket');
        }
        if(!isset($this->timeout)){
            $this->timeout = 60;
        }
        $this->cos = new Api([
            'app_id' => $this->app_id,
            'secret_id' => $this->secret_id,
            'secret_key' => $this->secret_key,
            'region' => $this->region,
            'bucket'=>$this->bucket,
            'timeout' => $this->timeout
        ]);
    }

    /*
     * 创建文件夹
     * @param string $folder 文件夹名称
     * @return mixed
     * */
    public function createFolder($folder){
        $ret = $this->cos->createFolder($this->bucket, $folder);
        return $ret;
    }

    /**
     * 上传文件,自动判断文件大小,如果小于20M则使用普通文件上传,大于20M则使用分片上传
     * @param  string  $bucket   bucket名称
     * @param  string  $srcPath      本地文件路径
     * @param  string  $dstPath      上传的文件路径
     * @param  string  $bizAttr      文件属性
     * @param  string  $slicesize    分片大小(512k,1m,2m,3m)，默认:1m
     * @param  string  $insertOnly   同名文件是否覆盖
     * @param [type]                [description]
     */
    public function upload($src, $dst,$bizAttr=null, $sliceSize=null, $insertOnly=null){
        $insertOnly = empty($insertOnly) ? $this->insertOnly : $insertOnly;
        $ret = $this->cos->upload($this->bucket, $src, $dst,$bizAttr,$sliceSize,$insertOnly);
        return $ret;
    }

    /*
     * 下载文件
     * @param string $folder 文件夹名称
     * @param string src 源文件地址
     * @param string dst 本地存储地址
     * @return mixed
     * */
    public function download($src, $dst){
        $ret = $this->cos->download($this->bucket, $src, $dst);
        return $ret;
    }

    /*
     * 获取目录列表
     * @param string $folder 目录名称
     * @return mixed
     * */
    public function listFolder($folder){
        $ret = $this->cos->listFolder($this->bucket, $folder);
        return $ret;
    }


    /*
     * 更新目录信息
     * @param string $folder 目录名称
     * @param string $bizAttr
     * @return mixed
     * */
    public function updateFolder($folder,$bizAttr){
        $ret = $this->cos->updateFolder($this->bucket, $folder,$bizAttr);
        return $ret;
    }
    /*
     * 上传文件,自动判断文件大小,如果小于20M则使用普通文件上传,大于20M则使用分片上传
     * @param string $bizAttr
     * @param string $authority
     * @param string $customerHeaders
     * @param string $bizAttr
     * @return mixed
     * */
    public function update($dst, $bizAttr, $authority, $customerHeaders){
        /*  $bizAttr = '';
            $authority = 'eWPrivateRPublic';
            $customerHeaders = array(
            'Cache-Control' => 'no',
            'Content-Type' => 'application/pdf',
            'Content-Language' => 'ch',
            );
         * */
        $ret = $this->cos->update($this->bucket, $dst, $bizAttr, $authority, $customerHeaders);
        return $ret;
    }
    /*
     * 获取目录列表
     * @param string $folder 目录名称
     * @return mixed
     * */
    public function statFolder($folder){
        $ret = $this->cos->statFolder($this->bucket, $folder);
        return $ret;
    }
    /*
     * 查询文件信息
     * @param string $dst 文件名称
     * @return mixed
     * */
    public function stat($dst){
        $ret = $this->cos->stat($this->bucket, $dst);
        return $ret;
    }

    /*
     * 获取目录列表
     * @param string $dst 文件名称
     * @return mixed
     * */
    public function delFile($dst){
        $ret = $this->cos->delFile($this->bucket, $dst);
        return $ret;
    }
    /*
     * 删除目录
     * @param string $folder 目录名称
     * @return mixed
     * */
    public function delFolder($folder){
        $ret = $this->cos->delFolder($this->bucket, $folder);
        return $ret;
    }
    /*
     * 获取目录列表
     * @param string $folder 目录名称
     * @param string $fromFile 源文件
     * @param string $toFile 复制到
     * @return mixed
     * */
    public function copyFile($folder,$fromFile,$toFile){
        $ret = $this->cos->copyFile($this->bucket,$fromFile,$toFile);
        return $ret;
    }

    /*
     * 移动文件
     * @param string $folder 目录名称
     * @param string $fromFile 源文件
     * @param string $toFile 移动到
     * @return mixed
     * */
    public function moveFile($folder,$fromFile,$toFile){
        $ret = $this->cos->moveFile($this->bucket, $fromFile,$toFile);
        return $ret;
    }
}