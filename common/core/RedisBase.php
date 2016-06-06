<?php
namespace common\core;

class RedisBase
{
    private static $conn = array();

    function __construct($configName, $configInfo)
    {
        var_dump($configName);
        var_dump($configInfo);
        exit();
        if(isset(self::$conn[$configName]) && self::$conn[$configName]) {
            return self::$conn[$configName];
        }
        $redis = new \Redis();
        $timeOut = isset($configInfo['timeout']) ? intval($configInfo['timeout']) : 3;
        $dbIndex = isset($configInfo['db']) ? intval($configInfo['db']) : 0;
        if($redis->connect($configInfo['ip'], $configInfo['port'], $timeOut)) {
            if(isset($configInfo['pass']) && $configInfo['pass']) {
                $redis->auth($configInfo['pass']);
            }
            $redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);
            $redis->select($dbIndex);
            self::$conn[$configName] = $redis;
        } else if ($defaultRedis = self::getInstance('common')) {
            $redis = $defaultRedis;
            self::$conn[$configName] = $defaultRedis;
        } else {
            throw new \Exception("redis is down");
        }
        return $redis;
    }

    public static function getInstance($configName = 'common')
    {
        if(isset(self::$conn[$configName]) && self::$conn[$configName]) {
            return self::$conn[$configName];
        }
        if(!isset(\Yii::$app->params['redisConfig'][$configName])) {
            throw new \Exception("redis config not exists", 6000);
        }
        new self($configName, \Yii::$app->params['redisConfig'][$configName]);
        return self::$conn[$configName];
    }
}

/* Redis functions
0|public Redis->__construct()
1|public Redis->__destruct()
2|public Redis->connect()
3|public Redis->pconnect()
4|public Redis->close()
5|public Redis->ping()
6|public Redis->echo()
7|public Redis->get()
8|public Redis->set()
9|public Redis->setex()
10|public Redis->psetex()
11|public Redis->setnx()
12|public Redis->getSet()
13|public Redis->randomKey()
14|public Redis->renameKey()
15|public Redis->renameNx()
16|public Redis->getMultiple()
17|public Redis->exists()
18|public Redis->delete()
19|public Redis->incr()
20|public Redis->incrBy()
21|public Redis->incrByFloat()
22|public Redis->decr()
23|public Redis->decrBy()
24|public Redis->type()
25|public Redis->append()
26|public Redis->getRange()
27|public Redis->setRange()
28|public Redis->getBit()
29|public Redis->setBit()
30|public Redis->strlen()
31|public Redis->getKeys()
32|public Redis->sort()
33|public Redis->sortAsc()
34|public Redis->sortAscAlpha()
35|public Redis->sortDesc()
36|public Redis->sortDescAlpha()
37|public Redis->lPush()
38|public Redis->rPush()
39|public Redis->lPushx()
40|public Redis->rPushx()
41|public Redis->lPop()
42|public Redis->rPop()
43|public Redis->blPop()
44|public Redis->brPop()
45|public Redis->lSize()
46|public Redis->lRemove()
47|public Redis->listTrim()
48|public Redis->lGet()
49|public Redis->lGetRange()
50|public Redis->lSet()
51|public Redis->lInsert()
52|public Redis->sAdd()
53|public Redis->sSize()
54|public Redis->sRemove()
55|public Redis->sMove()
56|public Redis->sPop()
57|public Redis->sRandMember()
58|public Redis->sContains()
59|public Redis->sMembers()
60|public Redis->sInter()
61|public Redis->sInterStore()
62|public Redis->sUnion()
63|public Redis->sUnionStore()
64|public Redis->sDiff()
65|public Redis->sDiffStore()
66|public Redis->setTimeout()
67|public Redis->save()
68|public Redis->bgSave()
69|public Redis->lastSave()
70|public Redis->flushDB()
71|public Redis->flushAll()
72|public Redis->dbSize()
73|public Redis->auth()
74|public Redis->ttl()
75|public Redis->pttl()
76|public Redis->persist()
77|public Redis->info()
78|public Redis->resetStat()
79|public Redis->select()
80|public Redis->move()
81|public Redis->bgrewriteaof()
82|public Redis->slaveof()
83|public Redis->object()
84|public Redis->bitop()
85|public Redis->bitcount()
86|public Redis->mset()
87|public Redis->msetnx()
88|public Redis->rpoplpush()
89|public Redis->brpoplpush()
90|public Redis->zAdd()
91|public Redis->zDelete()
92|public Redis->zRange()
93|public Redis->zReverseRange()
94|public Redis->zRangeByScore()
95|public Redis->zRevRangeByScore()
96|public Redis->zCount()
97|public Redis->zDeleteRangeByScore()
98|public Redis->zDeleteRangeByRank()
99|public Redis->zCard()
100|public Redis->zScore()
101|public Redis->zRank()
102|public Redis->zRevRank()
103|public Redis->zInter()
104|public Redis->zUnion()
105|public Redis->zIncrBy()
106|public Redis->expireAt()
107|public Redis->pexpire()
108|public Redis->pexpireAt()
109|public Redis->hGet()
110|public Redis->hSet()
111|public Redis->hSetNx()
112|public Redis->hDel()
113|public Redis->hLen()
114|public Redis->hKeys()
115|public Redis->hVals()
116|public Redis->hGetAll()
117|public Redis->hExists()
118|public Redis->hIncrBy()
119|public Redis->hIncrByFloat()
120|public Redis->hMset()
121|public Redis->hMget()
122|public Redis->multi()
123|public Redis->discard()
124|public Redis->exec()
125|public Redis->pipeline()
126|public Redis->watch()
127|public Redis->unwatch()
128|public Redis->publish()
129|public Redis->subscribe()
130|public Redis->psubscribe()
131|public Redis->unsubscribe()
132|public Redis->punsubscribe()
133|public Redis->time()
134|public Redis->eval()
135|public Redis->evalsha()
136|public Redis->script()
137|public Redis->dump()
138|public Redis->restore()
139|public Redis->migrate()
140|public Redis->getLastError()
141|public Redis->clearLastError()
142|public Redis->_prefix()
143|public Redis->_unserialize()
144|public Redis->getOption()
145|public Redis->setOption()
146|public Redis->config()
147|public Redis->open()
148|public Redis->popen()
149|public Redis->lLen()
150|public Redis->sGetMembers()
151|public Redis->mget()
152|public Redis->expire()
153|public Redis->zunionstore()
154|public Redis->zinterstore()
155|public Redis->zRemove()
156|public Redis->zRem()
157|public Redis->zRemoveRangeByScore()
158|public Redis->zRemRangeByScore()
159|public Redis->zRemRangeByRank()
160|public Redis->zSize()
161|public Redis->substr()
162|public Redis->rename()
163|public Redis->del()
164|public Redis->keys()
165|public Redis->lrem()
166|public Redis->ltrim()
167|public Redis->lindex()
168|public Redis->lrange()
169|public Redis->scard()
170|public Redis->srem()
171|public Redis->sismember()
172|public Redis->zrevrange()
 */