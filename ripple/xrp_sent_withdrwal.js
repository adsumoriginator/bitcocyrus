const RippleAPI = require('ripple-lib').RippleAPI;

const address = process.argv[2];
const secret = process.argv[3];
const toaddr = process.argv[4];
const amt = process.argv[5];
const tag = process.argv[6];


const api = new RippleAPI({
server: 'wss://s2.ripple.com', // Public rippled server

});


const payment = {
  source: {
    address: address,
    maxAmount: {
      value: amt,
      currency: 'XRP'
    }
  },
  destination: {
    address: toaddr,
    tag:parseInt(tag),
    amount: {
      value: amt,
      currency: 'XRP'
    },
  }
};

function quit(message) {
  console.log(JSON.stringify(message));
  process.exit(0);
}

function fail(message) {
  console.error(message);
  process.exit(1);
}

api.connect().then(() => {
  console.log('Connected...');
  return api.preparePayment(address, payment).then(prepared => {
    //console.log('Payment transaction prepared...');
  
    //const {signedTransaction} = api.sign(prepared.txJSON, secret);
    const signed = api.sign(prepared.txJSON, secret);
      txid = signed.id;
   // console.log('Payment transaction signed...');
    console.log(JSON.stringify({txid : txid }));
    api.submit(signed.signedTransaction).then(quit, fail);
  });
}).catch(fail);


