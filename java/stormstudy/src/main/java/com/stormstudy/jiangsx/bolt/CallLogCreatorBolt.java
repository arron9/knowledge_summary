package com.stormstudy.jiangsx.bolt;

//import util packages
import java.util.Map;

import org.apache.storm.task.OutputCollector;
import org.apache.storm.task.TopologyContext;
import org.apache.storm.topology.IRichBolt;
import org.apache.storm.topology.OutputFieldsDeclarer;
import org.apache.storm.tuple.Fields;
import org.apache.storm.tuple.Tuple;
import org.apache.storm.tuple.Values;
import sun.misc.Unsafe;

//Create a class CallLogCreatorBolt which implement IRichBolt interface
public class CallLogCreatorBolt implements IRichBolt {
    //Create instance for OutputCollector which collects and emits tuples to produce output
    private OutputCollector collector;
    static final Unsafe theUnsafe = new Unsafe();

    @Override
    public void prepare(Map conf, TopologyContext context, OutputCollector collector) {
        this.collector = collector;
    }

    @Override
    public void execute(Tuple tuple) {
        String from = (String) tuple.getValueByField("from");
        String to = (String) tuple.getValueByField("to");
        Integer duration = tuple.getInteger(2);
        collector.emit(new Values(from + " - " + to, duration));
    }

    @Override
    public void cleanup() {}

    @Override
    public void declareOutputFields(OutputFieldsDeclarer declarer) {
        declarer.declare(new Fields("call", "duration"));
    }

    @Override
    public Map<String, Object> getComponentConfiguration() {
        return null;
    }

    public final int incrementAndGet() {
        return Unsafe.getAndAddInt(this, valueOffset, 1) + 1;
    }
}
