pragma solidity ^0.4.13;

contract My {
    string public constant symbol = "YJC"; //单位
    string public constant name = "YUNJI"; //名称
    uint8 public constant decimals = 18; //小数点后的位数
    uint256 _totalSupply = 1000000; //发行总量
    address public owner;// 智能合约的所有者
    // token转移完成后出发
    event Transfer(address indexed _from, address indexed _to, uint256 _value);

    // approve(address _spender, uint256 _value)调用后触发
    event Approval(address indexed _owner, address indexed _spender, uint256 _value);
    // 每个账户的余额
    mapping(address => uint256) balances;
    // 帐户的所有者批准将金额转入另一个帐户。从上面的说明我们可以得知allowed[被转移的账户][转移钱的账户]
    mapping(address => mapping (address => uint256)) allowed;
    // 只能通过智能合约的所有者才能调用的方法
    modifier onlyOwner() {
          if (msg.sender != owner) {
              revert();
          }
          _;
    }
    function My() public{
          owner = msg.sender;
          balances[owner] = _totalSupply;

    }
    function totalSupply() constant public returns (uint256 totalSupply_) {
          totalSupply_ = _totalSupply;
    }
    // 特定账户的余额
    function balanceOf(address _owner) constant public returns (uint256 balance) {
          return balances[_owner];
    }
    // 转移余额到其他账户
    function transfer(address _to, uint256 _amount) public returns (bool success) {
          if (balances[msg.sender] >= _amount 
              && _amount > 0
              && balances[_to] + _amount > balances[_to]) {
              balances[msg.sender] -= _amount;
              balances[_to] += _amount;
              Transfer(msg.sender, _to, _amount);
              return true;
          } else {
              return false;
          }
    }
    function transferFrom(
          address _from,
          address _to,
          uint256 _amount
      ) public returns (bool success) {
          if (balances[_from] >= _amount
              && _amount > 0
              && balances[_to] + _amount > balances[_to]) {
              balances[_from] -= _amount;
              balances[_to] += _amount;
              Transfer(_from, _to, _amount);
              return true;
          } else {
              return false;
          }
    }
    //允许账户从当前用户转移余额到那个账户，多次调用会覆盖
    function approve(address _spender, uint256 _amount) public returns (bool success) {
          allowed[msg.sender][_spender] = _amount;
          Approval(msg.sender, _spender, _amount);
          return true;
    }

    //返回被允许转移的余额数量
    function allowance(address _owner, address _spender) constant public returns (uint256 remaining) {
          return allowed[_owner][_spender];
    }

    //用户
    struct oneUser {
        string user_name;
        address user_address;
        string user_pwdhash;
    }
    oneUser[] public users;
    function getUserNum() constant public returns (uint UserNum){
        return  users.length;
    }

    //版权
    struct oneCloud {
        uint cid;
        uint ctime;
        string jsoninfo;
        address uploader_address;
        string uploader_name;
    }
    oneCloud[] public clouds;
    mapping (uint=>uint) indexOf;
    function getCloudNum() constant public returns (uint CloudNum){
        return  clouds.length;
    }

    //流转
    struct oneTx {
        address from_address;
        address to_address;
        uint cid;
        uint ctype;
        uint tvalue;
        uint ttime;
    }
    oneTx[] public txs;
    function getTxNum() constant public returns (uint TxNum){
        return  txs.length;
    }

    event addUserEvent();
    function addUser(string user_name, address user_address, string user_pwdhash) public {
        users.push(oneUser(user_name, user_address, user_pwdhash));
        addUserEvent();
    }

    event addCloudEvent();
    function addCloud(string jsoninfo, address uploader_address, string uploader_name) public{
        uint ctime = now;
        uint cid = uint(keccak256(uint(keccak256(jsoninfo))%10000000000+ctime))%10000000000;
        indexOf[cid] = clouds.length;
        clouds.push(oneCloud(cid, ctime, jsoninfo, uploader_address, uploader_name));
        addCloudEvent();
    }

    //买方发起交易, 就是from:买方
    event addTxEvent();
    function addTx(uint cid, uint ctype, uint tvalue) public{
        address cloudFrom = clouds[indexOf[cid]].uploader_address;
        address cloudTo = msg.sender;
        uint ttime = now;
        require(transfer(cloudFrom, tvalue) == true);
        txs.push(oneTx(cloudFrom, cloudTo, cid, ctype, tvalue, ttime));
        addTxEvent();
    }

    function recharge(address user, uint value) {
      transferFrom(owner, user, value);
      uint cid = 0;
      uint ctype = 0;
      uint ttime = now;
      txs.push(oneTx(owner, user, cid, ctype, value, ttime));
      addTxEvent();
    }
}