/************************ GetElement Class ************************/
var get = get || {};
get.byId = function ($elem)
{
    return document.getElementById($elem);
};
get.byClass = function ($elem)
{
    return document.getElementsByClassName($elem);
};
get.byTag = function ($elem)
{
    return document.getElementsByTagName($elem);
};
get.byName = function ($elem)
{
    return document.getElementsByName($elem);
};

/************************ AJAXRequest Class ************************/
function Request(setting, _target)
{
    var xmlHttp, _result, output = null;

    output = _target;
    this._method = setting._method;
    this._fileSystem = setting._fileSystem;
    this._async = setting._async;
    this._data = setting._data;
    this._data = JSON.stringify(this._data);
    this._headerMode_part1 = setting._headerMode_part1 || 'Content-type';
    this._headerMode_part2 = setting._headerMode_part2 || 'application/x-www-form-urlencoded';
    xmlHttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    this.check = function ()
    {
        console.log('output: '+output);
        console.log('method: '+this._method);
        console.log('filesystem: '+this._fileSystem);
        console.log('async: '+this._async);
        console.log('data: '+this._data);
        console.log('headerMode_part1: '+this._headerMode_part1);
        console.log('headerMode_part2: '+this._headerMode_part2);
    };
    this.call = function ()
    {
        if (this._method === 'POST')
        {
            if (this._async === true)
            {
                xmlHttp.open(this._method, this._fileSystem, this._async);
                xmlHttp.setRequestHeader(this._headerMode_part1,this._headerMode_part2);
                xmlHttp.onreadystatechange = function ()
                {
                    if (xmlHttp.readyState === 4 && xmlHttp.status === 200)
                    {
                        _result = xmlHttp.responseText;
                        output.innerHTML = _result;
                    }
                };
                xmlHttp.send(this._data);
            }
            else if (this._async === false)
            {
                xmlHttp.open(this._method, this._fileSystem, this._async);
                xmlHttp.send(this._data);
                _result = xmlHttp.responseText;
                output.innerHTML = _result;
            }
        }
        else if (this._method === 'GET')
        {
            xmlHttp.open(this._method, this._fileSystem, this._async);
            xmlHttp.onreadystatechange = function ()
            {
                if (this.readyState === 4 && this.status === 200)
                {
                    _result = this.responseText;
                    return _result;
                }
            };
            xmlHttp.send(null);
        }
    };
}

/************************ Create JSON Data ************************/
function createJSON()
{
    // todo: create better function and fix it
    var args = new Array(arguments.length);
    for (var i = 0; i < args.length; i++)
    {
        args[i] = arguments[i];
    }
}createJSON('sina','sara','arash');

