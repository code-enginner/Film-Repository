var login = get.byId('btnLogin');
login.addEventListener('mousedown', newColor);
login.addEventListener('mouseup', oldColor);
function newColor()
{
    login.style.backgroundColor = '#616161';
    login.style.color = '#fff';
}
function oldColor()
{
    login.style.backgroundColor = '#E0E0E0';
    login.style.color = '#000';
}

/************** send data to server ***************/

login.addEventListener('click', getData);
function getData()
{
    var username, password, secCode, data, newLogin, output;
    username = get.byId('username').value;
    password = get.byId('password').value;
    secCode = get.byId('secCode').value;
    output = get.byId('output');
    data = {"username":username, "password":password, "secCode":secCode};
    newLogin = new Request
    ({
        _method: 'POST',
        _fileSystem: baseURL + '/app/Controllers/ajax_adminLogin_handler.php',
        _async: true,
        _data: data,
        _headerMode_part1: 'Content-type',
        _headerMode_part2: 'application/x-www-form-urlencoded'
    }, output);
    newLogin.check();
    newLogin.call();
}
