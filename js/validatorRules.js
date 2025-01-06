function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}


function AreAllCharactersNumber(value) {
    noPoint = (value + '').replace(/\./g, '');

    for (var i = 0, len = noPoint.length; i < len; i++) {
        if (isNumberKey(noPoint.charAt(i)) === false) {
            return false;
        }
    }

    return true;
}


/*----------*/



$.validator.addMethod('notEqualToString', function (value, element, param) {
    console.log("ne:" + value + "-" + param);
    if (value+"" === param+"") {
        return false;
    }
    else {
        return true;
    }

}, 'Value should be different');
