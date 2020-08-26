package com.stormstudy.jiangsx;

import com.stormstudy.jiangsx.bolt.CallLogCounterBolt;
import com.stormstudy.jiangsx.bolt.CallLogCreatorBolt;
import com.stormstudy.jiangsx.spout.FakeCallLogReaderSpout;
import org.apache.storm.Config;
import org.apache.storm.LocalCluster;
import org.apache.storm.topology.TopologyBuilder;
import org.apache.storm.tuple.Fields;

import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;
import java.util.stream.IntStream;

public class Application {
    static int data = 0;
    public static void  main(String []args) {
        /*Config config = new Config();
        config.setDebug(true);

        TopologyBuilder builder = new TopologyBuilder();
        builder.setSpout("call-log-reader-spout", new FakeCallLogReaderSpout());

        builder.setBolt("call-log-creator-bolt", new CallLogCreatorBolt())
                .shuffleGrouping("call-log-reader-spout");

        builder.setBolt("call-log-counter-bolt", new CallLogCounterBolt())
                .fieldsGrouping("call-log-creator-bolt", new Fields("call"));

        LocalCluster cluster = null;
        try {
            cluster = new LocalCluster();
            cluster.submitTopology("LogAnalyserStorm", config, builder.createTopology());
            Thread.sleep(10000);
            //cluster.shutdown();
        } catch (Exception e) {
            e.printStackTrace();
        }*/

        //Stop the topology
        System.out.print("hello storm");

        // 类中定义成员变量
        Lock lock = new ReentrantLock();

        // 执行 lock() 方法加锁，执行 unlock() 方法解锁
        IntStream.range(0, 100).forEach(y -> {
            //lock.lock();
            data++;
            //lock.unlock();
        });

        System.out.print(data);
    }
}
