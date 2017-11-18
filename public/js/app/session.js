var Session = function(){
    this.exdays = 200;
};

// JS prototype methods
// these are secured way of writing, otherwise.. user can view the passing data on browser console

Session.prototype.set     = function(cvalue) {

    var cvalue = JSON.stringify(cvalue);    // convert json object to string
    var d = new Date();
    d.setTime(d.getTime() + (this.exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie ="_auth=" + cvalue + ";" + expires + ";path=/"; // create cookie via json // "_auth" = cookie name
};

Session.prototype.get   = function() {
    var decodedCookie = decodeURIComponent(document.cookie);    // decode cookie data
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        if(ca[i].indexOf('_auth') != -1){
            var auth = ca[i].split("=")[1];
            return  JSON.parse(auth);   // convert string to json object
        }
        return null;
    }
    return null;
};