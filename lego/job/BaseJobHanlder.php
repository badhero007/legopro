<?php
namespace lego\job;

use common\core\Logger;
use yii\base\Component;
use shakura\yii2\gearman\Dispatcher;
use shakura\yii2\gearman\JobWorkload;
use yii\helpers\Json;

/**
 * 发起Gearman 工作任务 基础方法类
 * Class BaseJobHandler
 * @package louli\job
 */
class BaseJobHanlder extends Component
{
    /** @var  $logger Logger */
    protected $logger;
    /** @var  $dispatcher Dispatcher */
    protected $dispatcher;
    protected $jobSign;
    public function __construct(array $config=[])
    {
        parent::__construct($config);
        $this->dispatcher = \Yii::$app->get('gearman')->getDispatcher();
        $this->logger = new Logger();
        $this->jobSign = "J|" .gethostname()
            ."|".get_current_user()
            ."|".getcwd()
            ."|".get_called_class();
    }

    /**
     * 异步执行  返回任务提交是否成功
     * @param string $name
     * @param array $params
     * @param int $priority
     * @param null $unique
     * @return bool
     */
    public function background($name, $params = [], $priority = Dispatcher::NORMAL, $unique = null)
    {
        try {
            $params['LouLiJobToken'] = "B|".$this->jobSign;
            $response = $this->dispatcher->background(strval($name), new JobWorkload([
                'params' => $params
            ]), $priority, $unique);
            $this->logger->debug("name:$name | params:".Json::encode($params)." |Response:".Json::encode($response));
            return true;
        } catch (\Exception $e) {
            $this->logger->debug('Gearman Backgroud Job Handle Exception:'.$e->getMessage().PHP_EOL.$e->getTraceAsString());
            return false;
        }
    }

    /**
     * 同步执行  返回执行结果
     * @param string $name
     * @param array $params
     * @param int $priority
     * @param null $unique
     * @return mixed
     * @throws \Exception
     */
    public function execute($name, $params = [], $priority = Dispatcher::NORMAL, $unique = null)
    {
        try {
            $params['LouLiJobToken'] = "E|".$this->jobSign;
            $response = $this->dispatcher->execute(strval($name), new JobWorkload([
                'params' => $params
            ]), $priority, $unique);
            $this->logger->debug("name:$name | params:".Json::encode($params)." |Response:".Json::encode($response));
            return $response;
        } catch (\Exception $e) {
            $this->logger->error('Gearman Execute Job Handle Exception:'.$e->getMessage().PHP_EOL.$e->getTraceAsString());
            throw $e;
        }
    }

}