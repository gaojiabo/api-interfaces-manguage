<?php
namespace gjbkafka\kafkas;
use yii\base\Component;
use yii\base\InvalidConfigException;
class Kafkac extends Component{
    public $topic_list;
    public function init(){
        parent::init();
        if(!$this->topic_list){
            throw new InvalidConfigException('请先配置topic_list');
        }
    }

    /**
     *interactive_topic
     */
    public function send($topic,$value){
        if(!$topic || !$value){
            throw new InvalidConfigException('请填写相关参数');
        }
        $config = \Kafka\ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList($this->topic_list);
        $config->setBrokerVersion('0.11.0.0');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new \Kafka\Producer();
        $result = $producer->send(array(
            array(
                'topic' => $topic,
                'value' => $value,
            ),
        ));
        if(!empty($result)){
            return true;
        }else{
            return false;
        }

    }
}