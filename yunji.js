var express = require("express");
var app = express();

var request = require("request");
var Url = require("url");
var crypto = require('crypto');
var Q = require("q");

var web3 = require('web3');
var http = require('http');
var url=require("url");
var ip = "localhost"
var port = 8543;


web3.setProvider(new web3.providers.HttpProvider('http://'+ip+':'+port));
var myContract = web3.eth.contract([{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_amount","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTxNum","outputs":[{"name":"TxNum","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"totalSupply_","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_amount","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getCloudNum","outputs":[{"name":"CloudNum","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"user","type":"address"},{"name":"value","type":"uint256"}],"name":"recharge","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"uint256"}],"name":"users","outputs":[{"name":"user_name","type":"string"},{"name":"user_address","type":"address"},{"name":"user_pwdhash","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"uint256"}],"name":"clouds","outputs":[{"name":"cid","type":"uint256"},{"name":"ctime","type":"uint256"},{"name":"jsoninfo","type":"string"},{"name":"uploader_address","type":"address"},{"name":"uploader_name","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"cid","type":"uint256"},{"name":"ctype","type":"uint256"},{"name":"tvalue","type":"uint256"}],"name":"addTx","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_amount","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"jsoninfo","type":"string"},{"name":"uploader_address","type":"address"},{"name":"uploader_name","type":"string"}],"name":"addCloud","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getUserNum","outputs":[{"name":"UserNum","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"user_name","type":"string"},{"name":"user_address","type":"address"},{"name":"user_pwdhash","type":"string"}],"name":"addUser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"uint256"}],"name":"txs","outputs":[{"name":"from_address","type":"address"},{"name":"to_address","type":"address"},{"name":"cid","type":"uint256"},{"name":"ctype","type":"uint256"},{"name":"tvalue","type":"uint256"},{"name":"ttime","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_owner","type":"address"},{"indexed":true,"name":"_spender","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[],"name":"addUserEvent","type":"event"},{"anonymous":false,"inputs":[],"name":"addCloudEvent","type":"event"},{"anonymous":false,"inputs":[],"name":"addTxEvent","type":"event"}]).at("0x5c7c22e2f7d0deb90fb08ec7d62407cb915094fc");
var owner = "0xe0890037c5b924425d82cd8d355bc17e604a12b8";

var users = [];
var clouds = [];
var cloudsbyid = {};
var txs = [];
var blocktxs = [];
var blocks_now = -1;

function updateblocktxs(callback) {
    var mubiao = web3.eth.getBlock('latest').number;
    if (blocks_now==mubiao) callback();
    var getshu=0;

    for (var i=blocks_now+1;i<=mubiao;++i) {
        getshu--;
        web3.eth.getBlock(i,1, function(err, data){
            var t  = data.transactions;
            var time = data.timestamp;

            for (j in t)
                blocktxs.push({
                    height: t[j].blockNumber,
                    time: time,
                    hash: t[j].hash,
                    index: t[j].index,
                    from: t[j].from,
                    gas: t[j].gas
                });
            console.log(blocktxs.length, getshu);
            getshu++;
            if(getshu==0) {
                blocks_now= mubiao;
                console.log("haole");
                callback();
            }
                
            return;
        });
    }
}

function updateblocktxs_loading(callback) {
    var mubiao = web3.eth.getBlock('latest').number;

    function get1000(start) {
        var end = start+1000;
        if (end>mubiao)
            end = mubiao;

        var getshu = 0;
        for (var i=start+1;i<=end;++i) {
            getshu--;
            web3.eth.getBlock(i,1, function(err, data){
                var t  = data.transactions;
                var time = data.timestamp;

                for (j in t)
                    blocktxs.push({
                        height: t[j].blockNumber,
                        time: time,
                        hash: t[j].hash,
                        index: t[j].index,
                        from: t[j].from,
                        gas: t[j].gas
                    });

                //console.log(blocktxs.length, getshu);

                getshu++;
                if(getshu==0) {
                    blocks_now = end;
                    if (blocks_now==mubiao)
                        callback();
                    else {
                        console.log(blocks_now, "blocks now");
                        get1000(blocks_now);
                    }
                }
                    
                return;
            });
        }
    }
    
    get1000(blocks_now);


}


function updateusers(callback) {
    var now = users.length;
    var mubiao = myContract.getUserNum.call();
    var getshu = 0;
    if (now==mubiao) callback();
    for (var i=now; i<mubiao;++i) {
        getshu++;
        myContract.users.call(i, function(err, data){
            users.push(data);
            getshu--;
            console.log("updateusers",getshu);
            if(getshu==0)
                callback();
        });
    }
}

function updateclouds(callback) {
    var now = clouds.length;
    var mubiao = myContract.getCloudNum.call();
    var getshu = 0;
    if (now==mubiao) callback();
    for (var i=now; i<mubiao;++i) {
        getshu++;
        myContract.clouds.call(i, function(err, data){
            clouds.push(data);
            cloudsbyid[data[0]] = data;
            getshu--;
            console.log("updateclouds",getshu);
            if(getshu==0)
                callback();
        });
    }
}

function updatetxs(callback) {
    var now = txs.length;
    var mubiao = myContract.getTxNum.call();
    var getshu = 0;
    if (now==mubiao) callback();
    for (var i=now; i<mubiao;++i) {
        getshu++;
        myContract.txs.call(i, function(err, data){
            txs.push(data);
            getshu--;
            console.log("updatetxs",getshu);
            if(getshu==0)
                callback();
        });
    }
}



function unlockAndSend (address, callback) {
    var contents = '{"method":"personal_unlockAccount","params":["' + address + '","",null],"id":1,"jsonrpc":"2.0"}'
    var options = {
        host: ip,
        port: port,
        path:'/',
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'Content-Length':contents.length
        }
    }
    var req = http.request(options, function(res){
        res.setEncoding('utf8');
        res.on('data',function(data){
            console.log("unlock成功 : " + data);
            callback();
        });
        res.on('error',function(error){
            console.log("error:",error);
        });
        res.on('end', function(chunk) {
            
        });
    });
    req.write(contents, function (data) {
        console.log(data);
    });
    req.end();
}



app.get("/api/signup/newAddress", (requ, resp) => {
    var contents = '{"method":"personal_newAccount","params":[""],"id":1,"jsonrpc":"2.0"}';
    var options = {
        host: ip,
        port: port,
        path:'/',
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'Content-Length':contents.length
        }
    }
    var req = http.request(options, function(res){
        res.setEncoding('utf8');
        res.on('data',function(data){
            console.log("获取data成功 : " + data);
            resp.send(data);
            console.log("申请到的用户地址为 : " + data);
        });
        res.on('error',function(error){
            console.log("error:",error);
            resp.send(error);
        });
        res.on('end', function(chunk) {
            
        });
    });
    req.write(contents, function (data) {
        console.log(data);
    });
    req.end();
})

// 创建新用户，post，提交/api/signup/newAddress中获取的地址，用户名，密码，用户名唯一
app.get("/api/signup/newAccount", (req, resp) => {
    var address = req.query.address;
    var name = req.query.name;
    name = decodeURIComponent(name);
    var password = req.query.password;
    password =  crypto.createHash('sha256').update(password).digest("hex");

    console.log("address : " + address);
    console.log("name : " + name);
    console.log("password : " + password);

    //查重
    var chongfu = 0;
    for (i in users) {
        if (users[i][0]==name) {
            chongfu = 1;
            resp.send("err");
            break;
        }
    }

    if (chongfu==0) {
        unlockAndSend(owner, function() {
            myContract.addUser.sendTransaction(name, address, password, {from:owner}, function(err,data){
                console.log("sendtransaction error : " + err);
                console.log("sendtransaction data : " + data);
                if (data)
                    resp.end(data);
                else
                    resp.end("err");
            });
        });
    }
})

//TODO
app.get("/api/check", (req, resp) => {
    var name = req.query.name;
    name = decodeURIComponent(name);
    var password = req.query.password;
    password =  crypto.createHash('sha256').update(password).digest("hex");
    
    var ok = false;
    for (i in users) {
        if (users[i][0]==name && users[i][2]==password) {
            ok=true;
            resp.send({err : 0, msg : users[i][1]});
            console.log(name + "登录成功");
            break;
        }
    }

    if(!ok) {
        console.log(name + "登录失败");
        resp.send({err : 1, msg : "密码出错"});
    }
})

app.get('/api/recharge', (req, resp) => {
    var user = req.query.ac.toString();
    var value = req.query.value;
    unlockAndSend(owner, function(){
            myContract.recharge.sendTransaction(user, value, {from:owner}, function(err,data){
                console.log(err,data);
                resp.send({
                    err: err,
                    hash: data
                });
            });
        });
})

app.get('/api/addCloud', (req, resp) => {
    var uploader_address = req.query.ac.toString();
    var uploader_name = req.query.uname;
    uploader_name=decodeURIComponent(uploader_name);

    var bandwidth = req.query.bandwidth;
    var cpu = req.query.bandwidth;
    var ip = req.query.ip;
    var hash = req.query.hash;
    var value = req.query.value;


        var cjson = {
            bandwidth: bandwidth,
            cpu: cpu,
            ip: ip,
            hash: hash,
            value: value
        };

        var jsoninfo = JSON.stringify(cjson);
        console.log(jsoninfo);

    unlockAndSend(owner, function(){
            console.log([jsoninfo, uploader_address, uploader_name]);
            myContract.addCloud.sendTransaction(jsoninfo, uploader_address, uploader_name, {from:owner}, function(err,data){
                console.log(err,data);
                resp.send({
                    err: err,
                    hash: data
                });
            });
        });
})

// 进行版权交易
app.get("/api/addTx", (req, resp) => {
    var address = req.query.address;
    var cid = req.query.cid;
    var ctype = req.query.ctype;
    var tvalue = req.query.tvalue;

    unlockAndSend(address, function(){
        myContract.addTx.sendTransaction(cid, ctype, tvalue, {from:address}, function(err,data){
            console.log(err,data);
            resp.send({
                err: err,
                hash: data
            });
        });
    })
})


app.get("/api/getusers", (req, resp) => {
    resp.send(users);
})

app.get("/api/getclouds", (req, resp) => {
    resp.send(clouds);
})

app.get("/api/getblocktxs", (req, resp) => {
    resp.send(blocktxs);
})

app.get("/api/gettxs", (req, resp) => {
    resp.send(txs);
})


app.get("/api/getUserInfo", (req, resp) => {
    var address = req.query.address;
    var balance;
    var txcount = 0;
    var upload = 0;
    var buy = 0;
    var all;

    balance = myContract.balanceOf.call(address);
    for (i in txs) {
        if (txs[i][0]==address || txs[i][1]==address)
            txcount++;
    }

    for (i in clouds)
        if (clouds[i][3]==address)
            upload++;

    for (i in txs)
        if (txs[i][1]==address)
            buy++;

    all = upload+buy;

    var ans = {
        balance: balance,
        txcount: txcount,
        upload: upload,
        buy: buy,
        all: all,
    }

    resp.send(ans);
})

app.get("/api/getUserUpload", (req, resp) => {
    var address = req.query.address;
    var ans = [];
    for (i in clouds)
        if (clouds[i][3]==address)
            ans.push(clouds[i]);
    resp.send(ans);
})

app.get("/api/getUserBuy", (req, resp) => {
    var address = req.query.address;
    var ans = [];
    for (i in txs)
        if (txs[i][1]==address) {
            var cid = txs[i][2];
            ans.push([cloudsbyid[cid],txs[i]]);
        }
    resp.send(ans);
})


app.get("/api/getUserTx", (req, resp) => {
    var address = req.query.address;
    var ans = [];
    for (i in txs)
        if (txs[i][0]==address || txs[i][1]==address)
            ans.push(txs[i]);
    resp.send(ans);
})

app.get("/api/getUserBlocktx", (req, resp) => {
    var address = req.query.address;
    var ans = [];
    for (i in blocktxs)
        if (blocktxs[i].from==address)
            ans.push(blocktxs[i]);
    resp.send(ans);
})


app.get("/api/getCloud", (req, resp) => {
    var cid = req.query.cid;
    resp.send(cloudsbyid[cid]);
})

app.get("/api/getOverview", (req, res) => {
    var blockTxCount = blocktxs.length;
    var nodeCount = 2;
    var cloud_num = clouds.length;
    var tx_num = txs.length;
    var blockHeight = web3.eth.getBlock('latest').number;
    var ans = {
        blockHeight:blockHeight, 
        blockTxCount:blockTxCount, 
        nodeCount:nodeCount, 
        cloud_num:cloud_num, 
        tx_num:tx_num
    };
    res.send(ans);
})

var addUserEvent = myContract.addUserEvent();
addUserEvent.watch(function(err, result) {
    if (err) {
        console.log(err);
        return;
    } else {
        console.log("addUserEvent",result);
        updateusers(function(){console.log("users", users.length);});
        updateblocktxs(function(){console.log("blocktxs", blocktxs.length);});
    }
})

var addCloudEvent = myContract.addCloudEvent();
addCloudEvent.watch(function(err, result) {
    if (err) {
        console.log(err);
        return;
    } else {
        console.log("addCloudEvent",result);
        updateclouds(function(){console.log("clouds", clouds.length);});
        updateblocktxs(function(){console.log("blocktxs", blocktxs.length);});
    }
})

var addTxEvent = myContract.addTxEvent();
addTxEvent.watch(function(err, result) {
    if (err) {
        console.log(err);
        return;
    } else {
        console.log("addTxEvent",result);
        updatetxs(function(){console.log("txs", txs.length);});
        updateblocktxs(function(){console.log("blocktxs", blocktxs.length);});
    }
})


var server = app.listen(8889, function() {
    var host = server.address().address;
    var port = server.address().port;
    console.log("应用实例，访问地址为 http://%s:%s", host, port);
    
    updateusers(function(){console.log("users", users.length);});
    updateclouds(function(){console.log("clouds", clouds.length);});
    updatetxs(function(){console.log("txs", txs.length);});
    updateblocktxs_loading(function(){blocktxs.sort(function (a,b){return a.height-b.height});  console.log("blocktxs", blocktxs.length);});
})