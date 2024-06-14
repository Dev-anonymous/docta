<form action="https://api-testbed.maxicashapp.com/PayEntryPost" method="POST">
    <input type="hidden" name="PayType" value="MaxiCash">
    <input type="hidden" name="Amount" value="100">
    <input type="hidden" name="Currency" value="MaxiDollar">
    {{-- <input type="hidden" name="Telephone" value=""> --}}
    {{-- <input type="hidden" name="Email" value="{MAXICASH_EMAIL}"> --}}

    <input type="hidden" name="MerchantID" value="45ca4c2a7ef944278042c59b2fd37dde">
    <input type="hidden" name="MerchantPassword" value="890690861ca04a8fb6751ebd489511e5">
    <input type="hidden" name="Language" value="fr">
    <input type="hidden" name="Reference" value="REF-6668b00dd35aa1.68246967">
    <input type="hidden" name="accepturl" value="{{ route('pay.callback', ['_action'=> 'accept']) }}">
    <input type="hidden" name="cancelurl" value="{{ route('pay.callback', ['_action'=> 'cancel']) }}">
    <input type="hidden" name="declineurl" value="{{ route('pay.callback', ['_action'=> 'decline']) }}">
    {{-- <input type="hidden" name="notifyurl" value="https://docta-tam.com"> --}}

    {{-- {
        "PayType": "MaxiCash",
        "MerchantID": "45ca4c2a7ef944278042c59b2fd37dde",
        "MerchantPassword": "890690861ca04a8fb6751ebd489511e5",
        "Amount": "100",
        "Currency": "maxiDollar",
        "Language": "fr",
        "Reference": "ref001",
        "SuccessURL": "https://docta-tam.com",
        "FailureURL": "https://docta-tam.com",
        "CancelURL": "https://docta-tam.com"
    } --}}

    <button type="submit">Go</button>
</form>


{{-- {PayType: "MaxiCash",
    MerchantID: "45ca4c2a7ef944278042c59b2fd37dde",
    MerchantPassword: "890690861ca04a8fb6751ebd489511e5",
    Amount: "100",
    Currency: "maxiDollar",
    Language: "fr", //en or fr
    Reference: "ref001",
    SuccessURL: "https://docta-tam.com",
    FailureURL: "https://docta-tam.com",
    CancelURL: "https://docta-tam.com"
} --}}

{{-- {PayType:"MaxiCash",Amount:"100",Currency:"maxiDollar",MerchantID:"45ca4c2a7ef944278042c59b2fd37dde",MerchantPassword:"890690861ca04a8fb6751ebd489511e5",Language:"fr",Reference:"r11",Accepturl:"https://docta-tam.com",Cancelurl:"https://docta-tam.com",Declineurl:"https://docta-tam.com"} --}}
